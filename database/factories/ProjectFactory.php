<?php

namespace Database\Factories;

use App\Enums\ProjectStatus;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        return [
            'title'       => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'tagline'     => $this->faker->sentence(),
            'status'      => $this->faker->randomElement(ProjectStatus::cases()),
            'progress'    => $this->faker->numberBetween(0, 100),
            'votes'       => $this->faker->numberBetween(0, 50),
            'featured'    => false,
        ];
    }
}
