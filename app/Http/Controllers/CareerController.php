<?php

namespace App\Http\Controllers;

use App\Support\Career\CareerContent;
use App\Support\Career\CareerData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * Career roadmap page (client design "Career roadmap redesign") on the Career Roadmap module's data:
 * /career-roadmap?class=class-10&group=378 (a class and one of its groups). Forms on the page create leads (table
 * leads, subject "Career roadmap · …"); the student's name and number are remembered in the session, so later
 * buttons need one tap.
 */
class CareerController extends Controller
{
    private const SOURCES = ['hero' => 'Hero form', 'roadmap' => 'Roadmap box', 'card' => 'Roadmap card', 'band' => 'Counselling band', 'nudge' => 'Save-roadmap prompt',
        'sticky' => 'Phone bar', 'quiz' => 'Stream quiz', 'ask' => 'Question box', 'pdf' => 'PDF download', 'search' => 'Search (no match)'];

    public const CLASSES = ['Class 5', 'Class 6', 'Class 7', 'Class 8', 'Class 9', 'Class 10', 'Class 11', 'Class 12', 'Graduation', 'Post graduation', 'Parent'];

    public const STATES = ['Andhra Pradesh', 'Arunachal Pradesh', 'Assam', 'Bihar', 'Chandigarh', 'Chhattisgarh', 'Delhi', 'Goa', 'Gujarat', 'Haryana', 'Himachal Pradesh',
        'Jammu & Kashmir', 'Jharkhand', 'Karnataka', 'Kerala', 'Ladakh', 'Madhya Pradesh', 'Maharashtra', 'Manipur', 'Meghalaya', 'Mizoram', 'Nagaland', 'Odisha',
        'Puducherry', 'Punjab', 'Rajasthan', 'Sikkim', 'Tamil Nadu', 'Telangana', 'Tripura', 'Uttar Pradesh', 'Uttarakhand', 'West Bengal', 'Outside India'];

    public function index(Request $request)
    {
        $c = CareerContent::load();
        $d = CareerData::build($c);
        $groups = collect($d['groups']);

        // the choice in the address: a group alone picks its class; a class alone its first group; nothing: Class 10
        $group = $groups->firstWhere('id', (int) $request->query('group'));
        $cls = $group['cls'] ?? collect($d['classes'])->firstWhere('slug', (string) $request->query('class'))['id']
            ?? collect($d['classes'])->firstWhere('slug', 'class-10')['id'] ?? ($groups->first()['cls'] ?? null);
        if (!$group || $group['cls'] !== $cls) $group = $groups->firstWhere('cls', $cls);
        $state = ['cls' => $cls, 'group' => $group['id'] ?? null];

        $lead = session('career_lead');
        return view('career.index', [
            'c' => $c, 'd' => $d, 'state' => $state,
            'tree' => $group ? ($d['trees'][$group['id']] ?? []) : [],
            'lead' => $lead ? ['name' => Str::before($lead['name'], ' '), 'mobile' => $lead['mobile']] : null,
        ]);
    }

    /** One group's roadmap (its items), when the student opens another group. */
    public function group(int $id)
    {
        $d = CareerData::build(CareerContent::load());
        abort_unless(isset($d['trees'][$id]), 404);
        return response()->json(['steps' => $d['trees'][$id]]);
    }

    /** A form on the page: name + mobile (or the ones remembered in the session) and what the student asked for. */
    public function lead(Request $request)
    {
        $remembered = session('career_lead');
        $typed = $request->filled('mobile');   // a form the student filled in; else a one-tap with the remembered details
        if ($remembered && !$typed) $request->merge(['name' => $remembered['name'], 'mobile' => $remembered['mobile']]);
        $request->merge(['mobile' => substr(preg_replace('/\D/', '', (string) $request->input('mobile')), -10)]);

        $v = $request->validate([
            'name' => 'required|string|min:2|max:80',
            'mobile' => ['required', 'regex:/^[6-9]\d{9}$/'],
            'cls' => 'nullable|string|max:40',
            'state' => 'nullable|string|max:60',
            'group' => 'nullable|integer',
            'source' => 'required|string|max:20',
            'question' => 'nullable|string|max:500',
            'result' => 'nullable|string|max:120',
            'wa' => 'nullable|boolean',
            'utm' => 'nullable|string|max:300',
            'page' => 'nullable|string|max:300',
            'website' => 'nullable|max:0',   // honeypot
        ], ['mobile.regex' => 'Please enter a valid 10-digit mobile number.', 'name.min' => 'Please enter your name.', 'website.max' => 'Please try again.']);
        $v += array_fill_keys(['cls', 'state', 'group', 'question', 'result', 'wa', 'utm', 'page'], null);   // empty fields are not sent
        $wa = $typed ? !empty($v['wa']) : !empty($remembered['wa']);

        $source = self::SOURCES[$v['source']] ?? 'Career roadmap page';
        // the roadmap asked for: "Class 10 · Stream Selection"
        $roadmap = $v['group'] ? DB::table('career_roadmap_sub_modules as m')->join('career_roadmap_stages as s', 's.id', '=', 'm.stage_id')
            ->where('m.id', $v['group'])->selectRaw("concat(s.title, ' · ', m.title) as t")->value('t') : null;
        $subject = Str::limit(implode(' · ', array_filter(['Career roadmap', $source, $roadmap])), 250, '');
        $cls = $v['cls'] ?: ($remembered['cls'] ?? null);
        $state = $v['state'] ?: ($remembered['state'] ?? null);
        $lines = array_filter([
            $cls ? 'Class: ' . $cls : null,
            $state ? 'State: ' . $state : null,
            $roadmap ? 'Roadmap: ' . $roadmap : null,
            $v['result'] ? 'Stream quiz result: ' . $v['result'] : null,
            $v['question'] ? 'Question: ' . $v['question'] : null,
            'WhatsApp updates: ' . ($wa ? 'yes' : 'no'),
            'Asked from: ' . $source . ' on the career roadmap page',
            $v['utm'] ? 'Campaign: ' . $v['utm'] : null,
            $v['page'] ? 'Page: ' . $v['page'] : null,
        ]);

        // the same request twice within ten minutes (double click, back and forth) is one lead
        $dup = DB::table('leads')->where('phone', '+91' . $v['mobile'])->where('subject', $subject)->where('created_at', '>=', now()->subMinutes(10))->exists();
        if (!$dup) {
            DB::table('leads')->insert(['name' => trim($v['name']), 'phone' => '+91' . $v['mobile'], 'email' => '', 'subject' => $subject, 'type' => 'Student',
                'message' => implode("\n", $lines), 'status' => 'New', 'created_at' => now(), 'updated_at' => now()]);
        }

        session(['career_lead' => ['name' => trim($v['name']), 'mobile' => $v['mobile'], 'cls' => $cls, 'state' => $state, 'wa' => $wa]]);
        return response()->json(['ok' => true, 'name' => Str::before(trim($v['name']), ' '), 'mobile' => $v['mobile']]);
    }
}
