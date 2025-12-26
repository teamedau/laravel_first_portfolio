<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectApiTest extends TestCase
{
    use RefreshDatabase;

    /** POST @test */
    public function it_creates_a_project_via_api()
    {
        $response = $this->postJson('/api/projects', [
            'title' => 'Proyecto de prueba',
            'description' => 'Creado desde test',
            'tech' => 'Laravel',
            'status' => 'mvp',
            'progress' => 50,
        ]);

        $response
            ->assertStatus(201)
            ->assertJsonFragment([
                'title' => 'Proyecto de prueba',
                'status' => 'mvp',
                'progress' => 50,
            ]);

        $this->assertDatabaseHas('projects', [
            'title' => 'Proyecto de prueba',
        ]);
    }
    /** GET @test */
    public function it_lists_projects_via_api()
    {
        Project::create([
            'title' => 'Proyecto existente',
            'description' => 'Desde test',
            'tech' => 'Laravel',
            'status' => 'mvp',
            'progress' => 20,
        ]);
        $response = $this->getJson('/api/projects');

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'title' => 'Proyecto existente',
                'status' => 'mvp',
                'progress' => 20,
            ]);
    }
}

