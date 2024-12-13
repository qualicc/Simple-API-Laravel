<?php

namespace Database\Factories;

use App\Models\TeamMember;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TeamMembersFactory extends Factory
{
    protected $model = TeamMember::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'projectid' => Project::factory(),
            'name' => fake() -> name(),
        ];
    }
}