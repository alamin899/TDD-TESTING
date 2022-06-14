<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
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

    /** @test
     * this @test comment must otherwise code will not work another way metod name
     * like test_a_user_can_create_a_post
     */

    public function a_user_can_create_a_post()
    {
        $this->withoutExceptionHandling();

        $attributes = Project::factory()->raw();

        /* route for store project */
        //$this->post('/projects', $attributes); //this is only store data
        $this->post('/projects', $attributes)->assertRedirect('/projects'); //after post expect redirect

        /* doing expect that has table name in db is projects with data */
        $this->assertDatabaseHas('projects', $attributes);

        /* this means that projects route theke je value pabe setir
         * modde attribteer vale thakte hobe thakte hobe
         */
        $this->get('/projects')->assertSee($attributes);
    }


    /** @test */

    public function a_project_requires_a_title()
    {
        $attributes = Project::factory()->raw(['title' => '']); //raw() method send object like form data

        /* ai code er mane hosse jodi error validation a title thake tahole success
        amra ai khetre http method a data empty diyesi so ati error validation fail korbe and test pass hobe
        */
        $this->post('/projects', $attributes)->assertSessionHasErrors('title');

        /** ati fail hobe karon validation error pabe na cause title dewa hoise but amader test
         *  expect(assert) kortese je validation fail korbe t
         */
//        $this->post('/projects', ['title' => "test title"])->assertSessionHasErrors('title');
    }

    /** @test */

    public function a_project_requires_a_description()
    {
        $attributes = Project::factory()->raw(['description' => '']);//raw() method send object like form data

        $this->post('/projects', $attributes)->assertSessionHasErrors('description'); //test success
        //  $this->post('/projects', ['description'=>"test desc"])->assertSessionHasErrors('description'); //test failed
    }


    /** @test */
    public function a_user_can_view_a_project()
    {
        $this->withoutExceptionHandling();

        $project = Project::factory()->create();

        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);
    }
    /** @test */
    public function a_project_required_an_owner()
    {
        $attribute = Project::factory()->raw(['owner_id' => '']);

        $this->post('/projects', $attribute)->assertSessionHasErrors('owner_id');
    }


    /** @test */
    public function athenticate_user_can_create_project()
    {
        $this->actingAs(User::factory()->create());

        $attribute = Project::factory()->raw(['owner_id' => '']);

        $this->post('/projects', $attribute)->assertSessionHasErrors('owner_id');
    }
}
