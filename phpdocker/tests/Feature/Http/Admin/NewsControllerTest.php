<?php

namespace Tests\Feature\Http\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class NewsControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_News_List_Success(): void
    {
        $response = $this->get(route('admin.news.index'));

        $response->assertSeeText('Список новостей');
        $response->assertStatus(200);
    }

    public function test_News_Store_Success(): void
    {
        $postData = [
            'title' => 'title',
            'author' => 'Alex',
            'status' => 'draft',
            'description' => '1111',
        ];
        $response = $this->post(route('admin.news.store'), $postData);

        $response->assertStatus(302);
        //$response->assertJson($postData);
    }
}
