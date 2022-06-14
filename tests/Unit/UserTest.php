<?php

namespace Tests\Unit;


use App\Models\User;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }


    public function test_a_user_has_projects()
    {
        $user = User::factory()->create();

        $this->assertInstanceOf(Collection::class,$user->projects);
    }
}
