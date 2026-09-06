<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campus;
use App\Models\Course;
use Illuminate\Support\Facades\DB;

class FilteredPageController extends Controller
{
    public function show($slug)
    {
        $filteredPage = DB::table('filtered_pages')->where('slug', $slug)->first();

        if (!$filteredPage) {
            abort(404);
        }

        if (!empty($filteredPage->course_id)) {
            $course = Course::find($filteredPage->course_id);
            if ($course) {
                $filteredPage->course_name = $course->name;
            }
        }

        $campuses = collect();

        if ($filteredPage->category === 'School') {
            $query = Campus::with('organisation')
                ->whereHas('organisation', function($q) use ($filteredPage) {
                    // Filter that parent organisation type is school (ID 4 based on OrganisationType)
                    $q->where('organisation_type_id', 4);

                    if ($filteredPage->ownership_type) {
                        $q->where('ownership_type', $filteredPage->ownership_type);
                    }
                    if ($filteredPage->curriculum) {
                        $q->whereJsonContains('education_boards_supported', $filteredPage->curriculum);
                    }
                });

            if ($filteredPage->state) {
                $query->where(function($sq) use ($filteredPage) {
                    $sq->where('state', 'like', '%' . trim($filteredPage->state) . '%')
                       ->orWhereHas('organisation', function($oq) use ($filteredPage) {
                           $oq->whereJsonContains('states_present_in', $filteredPage->state);
                       });
                });
            }
            if ($filteredPage->city) {
                $query->where(function($cq) use ($filteredPage) {
                    $cq->where('city', 'like', '%' . trim($filteredPage->city) . '%')
                       ->orWhereHas('organisation', function($oq) use ($filteredPage) {
                           $oq->whereJsonContains('cities_present_in', $filteredPage->city);
                       });
                });
            }

            if ($filteredPage->school_type_id) {
                $query->whereJsonContains('campus_type_new_id', (string)$filteredPage->school_type_id);
            }

            if (!empty($filteredPage->course_id)) {
                $query->where(function($cq) use ($filteredPage) {
                    $cq->whereHas('courses', function($sub) use ($filteredPage) {
                        $sub->where('course_id', $filteredPage->course_id);
                    })->orWhereHas('departments.courses', function($sub) use ($filteredPage) {
                        $sub->where('course_id', $filteredPage->course_id);
                    })->orWhereHas('organisation.courses', function($sub) use ($filteredPage) {
                        $sub->where('course_id', $filteredPage->course_id);
                    });
                });
            }

            $campuses = $query->orderBy('sort_order', 'asc')->orderBy('campus_name', 'asc')->paginate(20);
            
            return view('filtered-campuses', compact('filteredPage', 'campuses'));

        } else if ($filteredPage->category === 'University') {
            $query = Campus::with('organisation')
                ->whereHas('organisation', function($q) use ($filteredPage) {
                    // Filter that parent organisation type is University (ID 1)
                    $q->where('organisation_type_id', 1);

                    if ($filteredPage->university_type) {
                        $q->where('university_type', $filteredPage->university_type);
                    }
                    
                    if ($filteredPage->degree) {
                        // Browse by Degree maps to levels_offered in organisation
                        $q->whereJsonContains('levels_offered', $filteredPage->degree);
                    }
                });

            if ($filteredPage->state) {
                $query->where(function($sq) use ($filteredPage) {
                    $sq->where('state', 'like', '%' . trim($filteredPage->state) . '%')
                       ->orWhereHas('organisation', function($oq) use ($filteredPage) {
                           $oq->whereJsonContains('states_present_in', $filteredPage->state);
                       });
                });
            }
            if ($filteredPage->city) {
                $query->where(function($cq) use ($filteredPage) {
                    $cq->where('city', 'like', '%' . trim($filteredPage->city) . '%')
                       ->orWhereHas('organisation', function($oq) use ($filteredPage) {
                           $oq->whereJsonContains('cities_present_in', $filteredPage->city);
                       });
                });
            }

            if (!empty($filteredPage->stream_id)) {
                $query->where(function($cq) use ($filteredPage) {
                    $cq->whereHas('courses', function($sub) use ($filteredPage) {
                        $sub->where('stream_offered_id', $filteredPage->stream_id);
                    })->orWhereHas('departments.courses', function($sub) use ($filteredPage) {
                        $sub->where('stream_offered_id', $filteredPage->stream_id);
                    });
                });
            }

            if (!empty($filteredPage->course_id)) {
                $query->where(function($cq) use ($filteredPage) {
                    $cq->whereHas('courses', function($sub) use ($filteredPage) {
                        $sub->where('course_id', $filteredPage->course_id);
                    })->orWhereHas('departments.courses', function($sub) use ($filteredPage) {
                        $sub->where('course_id', $filteredPage->course_id);
                    })->orWhereHas('organisation.courses', function($sub) use ($filteredPage) {
                        $sub->where('course_id', $filteredPage->course_id);
                    });
                });
            }

            $campuses = $query->orderBy('sort_order', 'asc')->orderBy('campus_name', 'asc')->paginate(20);
            
            return view('filtered-campuses', compact('filteredPage', 'campuses'));
        } else if ($filteredPage->category === 'Coaching') {
            $query = Campus::with('organisation')
                ->whereHas('organisation', function($q) use ($filteredPage) {
                    // Filter that parent organisation type is Institute (ID 3)
                    $q->where('organisation_type_id', 3);
                });

            if ($filteredPage->state) {
                $query->where(function($sq) use ($filteredPage) {
                    $sq->where('state', 'like', '%' . trim($filteredPage->state) . '%')
                       ->orWhereHas('organisation', function($oq) use ($filteredPage) {
                           $oq->whereJsonContains('states_present_in', $filteredPage->state);
                       });
                });
            }
            if ($filteredPage->city) {
                $query->where(function($cq) use ($filteredPage) {
                    $cq->where('city', 'like', '%' . trim($filteredPage->city) . '%')
                       ->orWhereHas('organisation', function($oq) use ($filteredPage) {
                           $oq->whereJsonContains('cities_present_in', $filteredPage->city);
                       });
                });
            }

            if ($filteredPage->coaching_category_id) {
                $query->where(function($q) use ($filteredPage) {
                    $q->whereJsonContains('coaching_category_ids', (string)$filteredPage->coaching_category_id)
                      ->orWhereJsonContains('coaching_category_ids', (int)$filteredPage->coaching_category_id);
                });
                
                $cc = DB::table('coaching_categories')->where('id', $filteredPage->coaching_category_id)->first();
                if($cc) {
                    $filteredPage->coaching_category_name = $cc->title;
                }
            }

            if (isset($filteredPage->program_type_id) && $filteredPage->program_type_id) {
                $query->whereHas('courses.course.programTypes', function($q) use ($filteredPage) {
                    $q->where('program_types.id', $filteredPage->program_type_id);
                });
                
                $pt = DB::table('program_types')->where('id', $filteredPage->program_type_id)->first();
                if($pt) {
                    $filteredPage->program_type_name = $pt->title;
                }
            }

            if (!empty($filteredPage->course_id)) {
                $query->where(function($cq) use ($filteredPage) {
                    $cq->whereHas('courses', function($sub) use ($filteredPage) {
                        $sub->where('course_id', $filteredPage->course_id);
                    })->orWhereHas('departments.courses', function($sub) use ($filteredPage) {
                        $sub->where('course_id', $filteredPage->course_id);
                    })->orWhereHas('organisation.courses', function($sub) use ($filteredPage) {
                        $sub->where('course_id', $filteredPage->course_id);
                    });
                });
            }

            $campuses = $query->orderBy('sort_order', 'asc')->orderBy('campus_name', 'asc')->paginate(20);
            
            return view('filtered-campuses', compact('filteredPage', 'campuses'));
        } else if ($filteredPage->category === 'Exam') {
            $query = \App\Models\DynamicExam::where('status', 'Active');

            $slug = strtolower($filteredPage->slug);
            $title = strtolower($filteredPage->title);

            // Apply base preset filters based on slug/title or explicit fields
            if (isset($filteredPage->exam_frequency) && !empty($filteredPage->exam_frequency)) {
                $query->where('exam_frequency', 'like', '%' . $filteredPage->exam_frequency . '%');
            } elseif (str_contains($slug, 'twice-a-year') || str_contains($title, 'twice a year')) {
                $query->where('exam_frequency', 'like', '%Twice a Year%');
            } elseif (str_contains($slug, 'once-a-year') || str_contains($title, 'once a year')) {
                $query->where('exam_frequency', 'like', '%Once a Year%');
            } elseif (str_contains($slug, 'multiple-times') || str_contains($title, 'multiple times')) {
                $query->where(function($q) {
                    $q->where('exam_frequency', 'like', '%Multiple%')
                      ->orWhere('exam_frequency', 'like', '%Twice%');
                });
            } elseif (str_contains($slug, 'vacancy') || str_contains($title, 'vacancy')) {
                $query->where(function($q) {
                    $q->where('exam_frequency', 'like', '%Vacancy%')
                      ->orWhere('exam_frequency', 'like', '%Other%')
                      ->orWhere('name', 'like', '%recruitment%')
                      ->orWhere('name', 'like', '%clerk%')
                      ->orWhere('name', 'like', '%officer%')
                      ->orWhere('name', 'like', '%grade%')
                      ->orWhere('name', 'like', '%railway%')
                      ->orWhere('name', 'like', '%staff selection%')
                      ->orWhere('name', 'like', '%defence%')
                      ->orWhere('name', 'like', '%commission%');
                });
            } elseif (str_contains($slug, 'cbt') || str_contains($slug, 'computerbased') || str_contains($title, 'computer-based') || str_contains($title, 'cbt')) {
                $query->where(function($q) {
                    $q->where('name', 'like', '%cbt%')
                      ->orWhere('about_exam', 'like', '%computer-based%')
                      ->orWhere('about_exam', 'like', '%cbt%')
                      ->orWhere('about_exam', 'like', '%online%');
                });
            } elseif (str_contains($slug, 'pen-paper') || str_contains($title, 'pen & paper')) {
                $query->where(function($q) {
                    $q->where('about_exam', 'like', '%pen%')
                      ->orWhere('about_exam', 'like', '%offline%')
                      ->orWhere('about_exam', 'like', '%omr%');
                });
            } elseif (str_contains($slug, 'online') || str_contains($title, 'online')) {
                $query->where(function($q) {
                    $q->where('about_exam', 'like', '%online%')
                      ->orWhere('about_exam', 'like', '%computer%');
                });
            } elseif (str_contains($slug, 'offline') || str_contains($title, 'offline')) {
                $query->where(function($q) {
                    $q->where('about_exam', 'like', '%offline%')
                      ->orWhere('about_exam', 'like', '%pen%');
                });
            }

            if (isset($filteredPage->exam_type) && !empty($filteredPage->exam_type)) {
                $query->where('exam_type', $filteredPage->exam_type);
            }
            if (isset($filteredPage->conducting_body_type) && !empty($filteredPage->conducting_body_type)) {
                $query->where('conducting_body_type', $filteredPage->conducting_body_type);
            }
            if (isset($filteredPage->exam_category) && !empty($filteredPage->exam_category)) {
                $query->where(function($q) use ($filteredPage) {
                    $q->whereJsonContains('exam_category', $filteredPage->exam_category)
                      ->orWhere('exam_category', 'like', '%"' . $filteredPage->exam_category . '"%');
                });
            }

            // Interactive query filters on page
            $request = request();
            if ($request->filled('search')) {
                $search = trim($request->search);
                $query->where(function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('short_name', 'like', "%{$search}%")
                      ->orWhere('conducting_authority_name', 'like', "%{$search}%");
                });
            }

            if ($request->filled('category')) {
                $categories = array_filter((array) $request->category);
                if (!empty($categories)) {
                    $query->where(function($q) use ($categories) {
                        foreach ($categories as $cat) {
                            $q->orWhereJsonContains('exam_category', $cat)
                              ->orWhere('exam_category', 'like', '%"' . $cat . '"%');
                        }
                    });
                }
            }

            if ($request->filled('exam_type')) {
                $query->where('exam_type', $request->exam_type);
            }

            if ($request->filled('conducting_body_type')) {
                $query->where('conducting_body_type', $request->conducting_body_type);
            }

            if ($request->boolean('featured')) {
                $query->where('featured_exam', true);
            }

            // Sorting
            $sort = $request->get('sort', 'latest');
            if ($sort === 'name') {
                $query->orderBy('name', 'asc');
            } elseif ($sort === 'featured') {
                $query->orderByDesc('featured_exam')->orderBy('sort_order', 'asc')->orderBy('name', 'asc');
            } else {
                $query->orderBy('sort_order', 'asc')->orderBy('id', 'desc');
            }

            $exams = $query->paginate(12)->withQueryString();

            // Filter options for sidebar
            $allCategories = \App\Models\DynamicExam::where('status', 'Active')
                ->whereNotNull('exam_category')
                ->pluck('exam_category')
                ->flatten()
                ->unique()
                ->filter()
                ->sort()
                ->values();

            $allExamTypes = \App\Models\DynamicExam::where('status', 'Active')
                ->whereNotNull('exam_type')
                ->distinct()
                ->pluck('exam_type')
                ->sort()
                ->values();

            $allConductingBodyTypes = \App\Models\DynamicExam::where('status', 'Active')
                ->whereNotNull('conducting_body_type')
                ->distinct()
                ->pluck('conducting_body_type')
                ->sort()
                ->values();

            return view('filtered-exams', compact('filteredPage', 'exams', 'allCategories', 'allExamTypes', 'allConductingBodyTypes'));
        }

        $campuses = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 20);
        return view('filtered-campuses', compact('filteredPage', 'campuses'));
    }
}
