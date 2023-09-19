<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChecklistRequest;
use App\Http\Resources\ChecklistResource;
use App\Models\Checklist;

class CheckListController extends Controller
{
    public function index()
    {
        return ChecklistResource::collection(Checklist::with('checklistItems')->get());
    }

    public function store(ChecklistRequest $request)
    {
        return ChecklistResource::make(Checklist::create($request->validated()));
    }

    public function destroy(Checklist $checklist)
    {
        $checklist->delete();

        return response()->noContent();
    }
}
