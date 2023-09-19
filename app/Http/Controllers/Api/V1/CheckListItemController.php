<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\ChecklistItemStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChecklistItemRequest;
use App\Http\Resources\ChecklistItemResource;
use App\Models\Checklist;
use App\Models\ChecklistItem;

class CheckListItemController extends Controller
{
    public function index(Checklist $checklist)
    {
        $checklistItem = $checklist->checklistItems;

        return ChecklistItemResource::collection($checklistItem);
    }

    public function store(Checklist $checklist, ChecklistItemRequest $request)
    {
        $data = $checklist->checklistItems()->create([
            'content' => $request->itemName,
            'status' => ChecklistItemStatus::NotCompleted->value,
        ]);

        return ChecklistItemResource::make($data);
    }

    public function show(ChecklistItem $checklistItem)
    {
        return ChecklistItemResource::make($checklistItem);
    }

    public function update(ChecklistItem $checklistItem)
    {
        $checklistItem->update([
            'status' => ChecklistItemStatus::Completed->value,
        ]);

        return ChecklistItemResource::make($checklistItem);
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

        return ChecklistItemResource::make($checklistItem);
    }
}
