<?php

namespace Database\Factories;

use App\Enums\ChecklistItemStatus;
use App\Models\ChecklistItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ChecklistItem>
 */
class ChecklistItemFactory extends Factory
{
    protected $model = ChecklistItem::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'content' => fake()->realText(50),
            'status' => ChecklistItemStatus::NotCompleted->value,
        ];
    }

    public function completed(): Factory
    {
        return $this->state(fn (array $attributes) => [
            'status' => ChecklistItemStatus::Completed->value,
        ]);
    }
}
