<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public function checklistItems()
    {
        return $this->hasMany(ChecklistItem::class);
    }
}
