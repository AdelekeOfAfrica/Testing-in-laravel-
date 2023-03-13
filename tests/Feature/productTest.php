<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class productTest extends TestCase
{
   use RefreshDatabase;
 
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
      $product = Product::factory()->create();
      $this->assertNotEmpty($product->name);
     }

     //this test is to check if product is empty 

     public function test_to_see_if_product_is_empty(){
      $product = $this->get('/product');
      $product->assertSee('No product');

     }

     //this test is to check if product isnot  empty 

     public function test_to_See_if_product_is_not_empty(){
      $product = Product::factory()->create();
      $response = $this->get('/product');
      $response->assertSee($product->name);
     }

     //test by creating product

     public function test_to_create_product(){
      $product= Product::factory()->create();
      $response = $this->get('/product');
      $response->assertStatus(200);
     }

}
