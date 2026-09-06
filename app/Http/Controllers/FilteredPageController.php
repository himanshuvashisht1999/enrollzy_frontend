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
        }

        return view('filtered-campuses', compact('filteredPage', 'campuses'));
    }
}
