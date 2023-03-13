<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

     use RefreshDatabase;
     //test to create new user 
     public function test_create_new_user(){
        User::factory()->create([
            'email'=>'testing@gmail.com',
            'password'=>bcrypt('password')
        ]);

        $response = $this->post('/login',[
            'email' => 'testing@gmail.com',
            'password' => 'password'
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/dashboard');
     }

    //test to check if authenticated user can access database 
     public function test_if_authenticated_user_can_access_dashboard(){
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
     }
//testing if unauthorized user can access database 

public function test_if_unauthorized_user_can_access_dashboard() {
    $response = $this->get('/dashboard');

    $response->assertStatus(302);
    $response->assertRedirect('/login');
}

//test to check if name exists in the database 

public function test_user_has_name_attribute(){
    $user = User::factory()->create([
        'name'=>'test',
        'email'=> 'test@gmail.com',
        'password'=>bcrypt('password')
    ]);

    $this->assertEquals('test',$user->name);
}

//    public function test_auth_user_can_access_dashboard()
//    {
//     $user = User::factory()->create();

//      $response = $this->actingAs($user)->get('/dashboard');

//      $response->assertStatus(200);
//    }

//    public function test_unauthorized_user(){
    
//     $response = $this->get('/dashboard');

//     $response->assertStatus(302);
//     $response->assertRedirect('/login');
//    }
}
