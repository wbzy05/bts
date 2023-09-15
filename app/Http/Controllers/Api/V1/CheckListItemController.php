<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChecklistItemResource;
use App\Models\Checklist;
use App\Models\ChecklistItem;
use Illuminate\Http\Request;

class CheckListItemController extends Controller
{
    public function index(Checklist $checklist)
    {
        $data = ChecklistItem::where('checklist_id', $checklist->id)->get();

        return ChecklistItemResource::collection($data);
    }

    public function store(Checklist $checklist, Request $request)
    {
        $data = CheckListItem::create([
            'checklist_id' => $checklist->id,
            'content' => $request->itemName,
            'status' => 0,
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
            'status' => 1,
        ]);

        return ChecklistItemResource::make($checklistItem);
    }

    public function destroy(ChecklistItem $checklistItem)
    {
        $checklistItem->delete();

        return response()->noContent();
    }

    public function rename(ChecklistItem $checklistItem, Request $request)
    {
        $checklistItem->update([
            'content' => $request->itemName,
        ]);

        return ChecklistItemResource::make($checklistItem);
    }
}
