<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChecklistResource;
use App\Models\Checklist;
use Illuminate\Http\Request;

class CheckListController extends Controller
{
    public function index()
    {
        return ChecklistResource::collection(Checklist::all());
    }

    public function store(Request $request)
    {
        return ChecklistResource::make(Checklist::create(['title' => $request->title]));
    }

    public function destroy(Checklist $checklist)
    {
        $checklist->delete();

        return response()->noContent();
    }
}
