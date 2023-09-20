<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\ChecklistItemStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChecklistItemRequest;
use App\Http\Resources\ChecklistItemResource;
use App\Models\Checklist;
use App\Models\ChecklistItem;
use Symfony\Component\HttpFoundation\Response;

class CheckListItemController extends Controller
{
    public function index(Checklist $checklist)
    {
        $checklistItem = $checklist->checklistItems;

        return ChecklistItemResource::collection($checklistItem)->additional(['meta' => [
            'status' => Response::HTTP_OK,
            'message' => 'Getting checklist items successfully',
        ]]);
    }

    public function store(Checklist $checklist, ChecklistItemRequest $request)
    {
        $data = $checklist->checklistItems()->create([
            'content' => $request->itemName,
            'status' => ChecklistItemStatus::NotCompleted->value,
        ]);

        return ChecklistItemResource::make($data)->additional(['meta' => [
            'status' => Response::HTTP_CREATED,
            'message' => 'Checklist item created successfully',
        ]]);
    }

    public function show(ChecklistItem $checklistItem)
    {
        return ChecklistItemResource::make($checklistItem)->additional(['meta' => [
            'status' => Response::HTTP_OK,
            'message' => 'Getting checklist item successfully',
        ]]);
    }

    public function update(ChecklistItem $checklistItem)
    {
        $checklistItem->update([
            'status' => ChecklistItemStatus::Completed->value,
        ]);

        return ChecklistItemResource::make($checklistItem)->additional(['meta' => [
            'status' => Response::HTTP_OK,
            'message' => 'Update checklist item successfully',
        ]]);
    }

    public function destroy(ChecklistItem $checklistItem)
    {
        $checklistItem->delete();

        return response()->noContent();
    }

    public function rename(ChecklistItem $checklistItem, ChecklistItemRequest $request)
    {
        $checklistItem->update([
            'content' => $request->itemName,
        ]);

        return ChecklistItemResource::make($checklistItem)->additional(['meta' => [
            'status' => Response::HTTP_OK,
            'message' => 'Rename checklist item successfully',
        ]]);
    }
}
