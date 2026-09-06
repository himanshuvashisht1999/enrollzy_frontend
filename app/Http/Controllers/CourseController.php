<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\ProgramLevel;
use App\Models\StreamOffered;
use App\Models\Discipline;
use App\Models\CourseType;
use App\Models\ProgramType;
use App\Models\DynamicExam;
use App\Models\Specialization;
use App\Models\Organisation;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::with(['programLevel', 'streamOffered', 'discipline', 'courseType', 'programTypes'])
            ->where('status', 1)
            ->where('is_show_on_website', 1);

        // 1. Search Query
        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%")
                  ->orWhere('full_form', 'like', "%{$search}%")
                  ->orWhere('overview', 'like', "%{$search}%");
            });
        }

        // 2. Program Level Filter
        if ($request->filled('level')) {
            $levels = (array) $request->level;
            $query->where(function($q) use ($levels) {
                $q->whereIn('program_level_id', $levels)
                  ->orWhereHas('programLevel', function($lq) use ($levels) {
                      $lq->whereIn('id', $levels)->orWhere(function($sub) use ($levels) {
                          foreach ($levels as $lvl) {
                              $sub->orWhere('title', 'like', "%{$lvl}%");
                          }
                      });
                  });
            });
        }

        // 3. Stream Filter
        if ($request->filled('stream')) {
            $streams = (array) $request->stream;
            $query->where(function($q) use ($streams) {
                $q->whereIn('stream_offered_id', $streams)
                  ->orWhereHas('streamOffered', function($sq) use ($streams) {
                      $sq->whereIn('id', $streams)->orWhere(function($sub) use ($streams) {
                          foreach ($streams as $st) {
                              $sub->orWhere('title', 'like', "%{$st}%");
                          }
                      });
                  });
            });
        }

        // 4. Discipline Filter
        if ($request->filled('discipline')) {
            $disciplines = (array) $request->discipline;
            $query->where(function($q) use ($disciplines) {
                $q->whereIn('discipline_id', $disciplines)
                  ->orWhereHas('discipline', function($dq) use ($disciplines) {
                      $dq->whereIn('id', $disciplines)->orWhere(function($sub) use ($disciplines) {
                          foreach ($disciplines as $disc) {
                              $sub->orWhere('title', 'like', "%{$disc}%");
                          }
                      });
                  });
            });
        }

        // 5. Course Type Filter
        if ($request->filled('course_type')) {
            $courseTypes = (array) $request->course_type;
            $query->where(function($q) use ($courseTypes) {
                $q->whereIn('course_type_id', $courseTypes)
                  ->orWhereHas('courseType', function($ctq) use ($courseTypes) {
                      $ctq->whereIn('id', $courseTypes)->orWhere(function($sub) use ($courseTypes) {
                          foreach ($courseTypes as $ct) {
                              $sub->orWhere('title', 'like', "%{$ct}%");
                          }
                      });
                  });
            });
        }

        // 6. Study Mode Filter
        if ($request->filled('mode')) {
            $modes = (array) $request->mode;
            $query->where(function($q) use ($modes) {
                $q->whereHas('programTypes', function($pq) use ($modes) {
                    $pq->whereIn('program_types.id', $modes)
                       ->orWhere(function($sub) use ($modes) {
                           foreach ($modes as $m) {
                               $sub->orWhere('title', 'like', "%{$m}%");
                           }
                       });
                });
                foreach ($modes as $m) {
                    $q->orWhereJsonContains('available_modes', $m)
                      ->orWhere('available_modes', 'like', "%{$m}%");
                }
            });
        }

        // 7. Duration Filter
        if ($request->filled('duration')) {
            $durations = (array) $request->duration;
            $query->where(function($q) use ($durations) {
                foreach ($durations as $dur) {
                    $q->orWhere('duration', 'like', "%{$dur}%");
                }
            });
        }

        // 8. Sorting
        $sort = $request->get('sort', 'latest');
        if ($sort === 'name') {
            $query->orderBy('name', 'asc');
        } elseif ($sort === 'name_desc') {
            $query->orderBy('name', 'desc');
        } elseif ($sort === 'duration') {
            $query->orderBy('duration', 'asc');
        } else {
            $query->orderBy('sort_order', 'asc')->orderBy('id', 'desc');
        }

        $query->withCount('organisationCourses');
        $courses = $query->paginate(12)->withQueryString();

        $allProgramLevels = ProgramLevel::where('status', 1)->orderBy('sort_order')->get();
        $allStreams = StreamOffered::where('status', 1)->orderBy('sort_order')->orderBy('title')->get();
        $allDisciplines = Discipline::where('status', 1)->orderBy('sort_order')->orderBy('title')->get();
        $allCourseTypes = CourseType::where('status', 1)->orderBy('sort_order')->get();
        $allProgramTypes = ProgramType::where('status', 1)->orderBy('sort_order')->get();
        
        $allDurations = Course::whereNotNull('duration')
            ->where('duration', '!=', '')
            ->select('duration')
            ->distinct()
            ->pluck('duration')
            ->sort()
            ->values();

        return view('courses', compact(
            'courses',
            'allProgramLevels',
            'allStreams',
            'allDisciplines',
            'allCourseTypes',
            'allProgramTypes',
            'allDurations'
        ));
    }

    public function show($slug)
    {
        $course = Course::with([
            'programLevel',
            'streamOffered',
            'discipline',
            'courseType',
            'programTypes',
            'organisationCourses.organisation',
            'organisationCourses.campus',
            'organisationCourses.department'
        ])
        ->where(function($q) use ($slug) {
            $q->where('slug', $slug)->orWhere('id', $slug);
        })
        ->firstOrFail();

        $offeringColleges = $course->organisationCourses
            ->filter(fn($oc) => !empty($oc->organisation))
            ->map(function($oc) {
                return [
                    'organisation' => $oc->organisation,
                    'campus' => $oc->campus,
                    'department' => $oc->department,
                    'fees' => $oc->fees ?: $oc->total_fees,
                    'duration' => $oc->duration,
                    'mode' => $oc->mode ?: $oc->delivery_mode,
                ];
            })
            ->unique(fn($item) => $item['organisation']->id)
            ->values();

        if ($offeringColleges->isEmpty()) {
            $recommendedUnivs = Organisation::where('organisation_type_id', 1)
                ->where('status', 1)
                ->orderBy('sort_order', 'asc')
                ->orderBy('name', 'asc')
                ->take(4)
                ->get();
        } else {
            $recommendedUnivs = collect();
        }

        $examIdsOrNames = is_array($course->common_entrance_exams)
            ? $course->common_entrance_exams
            : (json_decode($course->common_entrance_exams ?? '[]', true) ?: []);
        
        $entranceExams = collect();
        if (!empty($examIdsOrNames)) {
            $entranceExams = DynamicExam::where(function($q) use ($examIdsOrNames) {
                $q->whereIn('id', $examIdsOrNames)
                  ->orWhereIn('name', $examIdsOrNames)
                  ->orWhereIn('short_name', $examIdsOrNames);
            })->where('status', 'Active')->orderBy('sort_order', 'asc')->orderBy('name', 'asc')->get();
        }

        if ($entranceExams->isEmpty()) {
            $entranceExams = DynamicExam::where('status', 'Active')->orderBy('sort_order', 'asc')->orderBy('name', 'asc')->take(4)->get();
        }

        $specializationIdsOrNames = is_array($course->common_specializations)
            ? $course->common_specializations
            : (json_decode($course->common_specializations ?? '[]', true) ?: []);

        $specializations = collect();
        if (!empty($specializationIdsOrNames)) {
            $specializations = Specialization::whereIn('id', $specializationIdsOrNames)->orderBy('sort_order', 'asc')->get();
        }

        $relatedCourses = Course::where('id', '!=', $course->id)
            ->where('status', 1)
            ->where(function($q) use ($course) {
                if ($course->stream_offered_id) {
                    $q->where('stream_offered_id', $course->stream_offered_id);
                } elseif ($course->discipline_id) {
                    $q->where('discipline_id', $course->discipline_id);
                } elseif ($course->program_level_id) {
                    $q->where('program_level_id', $course->program_level_id);
                }
            })
            ->with(['programLevel', 'discipline', 'streamOffered'])
            ->orderBy('sort_order', 'asc')
            ->orderBy('name', 'asc')
            ->take(5)
            ->get();

        return view('course-detail', compact(
            'course',
            'offeringColleges',
            'recommendedUnivs',
            'entranceExams',
            'specializations',
            'relatedCourses'
        ));
    }
}