<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_create_post()
    {
        $formData=[
            'title'=>'test',
            'body'=>'test'
        ];
        $this->post(route('posts.store'),$formData)
        ->assertStatus(200);
    }
    public function test_can_update_post(){

        $formData=[
            'title'=>'test',
            'body'=>'test'
        ];
        $this->PUT(route('posts.update',1),$formData)
            ->assertStatus(200);

    }
    public function test_can_delete_post(){


        $this->DELETE(route('posts.destroy',1))
            ->assertStatus(200);

    }
}
