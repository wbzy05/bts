<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChecklistRequest;
use App\Http\Resources\ChecklistResource;
use App\Models\Checklist;
use Symfony\Component\HttpFoundation\Response;

class CheckListController extends Controller
{
    public function index()
    {
        return ChecklistResource::collection(Checklist::with('checklistItems')->get())->additional(['meta' => [
            'status' => Response::HTTP_OK,
            'message' => 'Getting checklists successfully',
        ]]);
    }

    public function store(ChecklistRequest $request)
    {
        return ChecklistResource::make(Checklist::create($request->validated()))
            ->additional(['meta' => [
                'status' => Response::HTTP_CREATED,
                'message' => 'Checklist created successfully',
            ]]);
    }

    public function destroy(Checklist $checklist)
    {
        $checklist->delete();

        return response()->noContent();
    }
}
