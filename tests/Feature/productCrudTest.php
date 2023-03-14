<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class productCrudTest extends TestCase
{
     use RefreshDatabase;
    private $user;
    private $product;
    
    

    public function setup(): void{
        parent::setup();
        $this->user = User::factory()->create(['is_admin'=>1]);
        $this->product = Product::factory()->create();
    }
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

    //writing a test for user to create a product 
    public function test_user_with_auth_can__add_product(){
        $response = $this->actingAs($this->user)->post('/product/create',[
            'name'=>'pineapple',
            'type' => 'fruit',
            'price'=>300.00,
        ]);
        $response->assertRedirect('/product/create');
    }

     //writing a test if a row has the product you are looking for 
     public function test_product_table_if_it_as_a_record(){
        $response = $this->actingAs($this->user)->post('/product/create',[
            'name'=>'pineapple',
            'type' => 'fruit',
            'price'=>300.00,
        ]);
        $response->assertRedirect('product/create');
        $this->assertCount(2,Product::all());
        $this->assertDatabaseHas('products',['name'=>'pineapple','type'=>'fruit','price'=>300.00]); //product is the name of table 
        

       

    }
    //test to see that you can get a product by id 
    public function test_to_see_a_product_by_id(){
        
        $response = $this->actingAs($this->user)->get('/product/'. $this->product->id.'/edit');
        $response->assertStatus(200);
    }

    //test to check if admin can update product
    public function test_admin_can_update_a_product(){
        $this->assertCount(1, Product::all());
        $this->product->first();
        $response = $this->actingAs($this->user)->put('/product/'.$this->product->id,[
            'name'=>'michael',
            'type' => 'human',
            'price'=>300.00, 
        ]);

        $response->assertSessionHasNoErrors();
       
    }
    
    //test to check if admin can delete a product
    public function test_if_admin_can_delete_product(){
        $this->assertCount(1, Product::all());
        $response = $this->actingAs($this->user)->delete('/product/'.$this->product->id);
        $response->assertStatus(200);
        $this->assertEquals(0,Product::count());

    }
}
