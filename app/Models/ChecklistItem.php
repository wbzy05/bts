<?php

namespace App\Models;

use App\Enums\ChecklistItemStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChecklistItem extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'status', 'checklist_id'];

    protected $casts = [
        'status' => ChecklistItemStatus::class,
    ];

    public function checklist()
    {
        return $this->belongsTo(Checklist::class);
    }
}
