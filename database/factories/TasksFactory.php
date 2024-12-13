<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TasksFactory extends Factory
{
    protected $model = Task::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'projectid' => Project::factory(),
            'name' => fake() -> text(5),
            'piority' => fake() -> numberBetween(1, 5),
            'deadline' => fake() -> dateTimeBetween('now', '+1 year'),
        ];
    }
}
