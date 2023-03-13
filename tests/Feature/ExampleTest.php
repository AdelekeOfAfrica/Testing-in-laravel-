<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */


     // rewrtiting the test from scratch 

     public function test_from_scratch (){
        $response = $this->get('/');

        $response->assertStatus(200);
     }

     //next is to see if there exist a word in a page 

      public function test_word_check(){
        $response = $this->get('/about');
        $response -> assertSee('about');
        $response->assertStatus(200);
      }

    public function test_the_application_returns_a_successful_response()
    {
        $response = $this->get('/');
        
        $response->assertSee(['Documentation','laracast']);

        $response->assertStatus(200);
    }

    // running my own test 

    public function test_the_route(){
        $about = $this->get('/about');

        $about->assertSeeTextInOrder(['about','us']);

        $about->assertStatus(200);
    }


}
