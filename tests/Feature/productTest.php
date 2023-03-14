<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class productTest extends TestCase
{
   use RefreshDatabase;

   private $product;
   private $user;

   public function setup(): void{
      
      parent::setup();

      $this->product =Product::factory()->create();

      $this->user = User::factory()->create(['is_admin'=> 1]);


   }
 
    /**
     * A basic feature test example.
     *
     * @return void
     */
   
     // to check if the link is active 

     public function test_check_if_link_is_active(){
        $response = $this->get('/product');

        $response->assertStatus(200);
     }

     //next thing is to check if it can read the content of poducts->index.php

     public function test_check_to_see_if_it_can_read_the_content() {
        $response = $this->get('/product');

        $response->assertSee('no product');
        $response->assertStatus(200);
     }

     //next thing is to test if the product has name 

     public function test_to_see_if_name_exist(){
       
      $this->assertNotEmpty($this->product->name);
     }

     //this test is to check if product is empty 

   //   public function test_to_see_if_product_is_empty(){
   //    $product = $this->get('/product');
   //    $product->assertSee('No product');

   //   }

     //this test is to check if product isnot  empty 

     public function test_to_See_if_product_is_not_empty(){
    
      $response = $this->get('/product');
      $response->assertSee($this->product->name);
     }

     //test by creating product

     public function test_to_create_product(){
     
      $response = $this->get('/product');
      $response->assertStatus(200);
     }


     //new test to check if user is authenticated and can see the buy product 

     public function test_auth_user_can_see_buy_product(){
      $user = User::factory()->create();
      $response = $this->actingAs($user)->get('/product');
      $response->assertSee('buy product');
     }

     //new test to check if unauthenticated user can see the buy button

     public function test_unauth_user_can_see_buy_product(){
      $response = $this->get('/product');

      $response->assertDontSee('buy product');
     }
     
     //new test to check if auth user can see the create link 

     public function test_auth_user_to_see_create_link(){

      $response = $this->actingAs($this->user)->get('/product');
      $response->assertSee('create');
      
     }

      //new test to check if auth user can see the create link 

      public function test_unauth_user_to_see_create_link(){

         $response = $this->get('/product');
         $response->assertDontSee('create');
         
        }

        //test to see if the auth user can visit link page 

        public function test_if_auth_user_can_visit_link_page(){
         
         $response = $this->actingAs($this->user)->get('/product/create');
         $response->assertStatus(200);
        }

         //test to see if the unauth user can visit link page 

         public function test_if_unauth_user_can_visit_link_page(){
         
            $response = $this->get('/product/create');
            $response->assertStatus(403);
          
           }
    

}
