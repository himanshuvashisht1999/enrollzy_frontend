<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CareerRoadmapController extends Controller
{
    public function index()
    {
        $categories = \App\Models\CareerRoadmapCategory::with(['stages' => function ($query) {
            $query->where('status', 1);
        }])->where('status', 1)->get();

        return view('pages.career-roadmap', compact('categories'));
    }

    public function getStageDetails($stageId)
    {
        $streams = \App\Models\CareerRoadmapSubModule::where('stage_id', $stageId)
            ->whereNull('parent_id')
            ->where('status', 1)
            ->get();

        return response()->json(['streams' => $streams]);
    }

    public function getStreamDetails($streamId)
    {
        $stream = \App\Models\CareerRoadmapSubModule::with(['children' => function($query) {
            $query->where('status', 1)->with(['children' => function($q) {
                $q->where('status', 1)->with(['children' => function($q2) {
                    $q2->where('status', 1);
                }]);
            }]);
        }])->where('id', $streamId)->where('status', 1)->first();

        if (!$stream) {
            return response()->json(['error' => 'Not found'], 404);
        }

        return response()->json(['stream' => $stream]);
    }
}
