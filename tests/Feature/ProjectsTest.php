<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /** @test */

    public function a_user_can_create_a_post()
    {
        $this->withoutExceptionHandling();

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
        ];

        /* route for store project */
//        $this->post('/projects', $attributes); //this is only store data
        $this->post('/projects', $attributes)->assertRedirect('/projects'); //after post expect redirect

        /* doing expect that has table name in db is projects with data */
        $this->assertDatabaseHas('projects', $attributes);

        /* this means that projects route theke je value pabe setir
         * modde attribteer vale thakte hobe thakte hobe
         */
        $this->get('/projects')->assertSee($attributes);
    }
}
