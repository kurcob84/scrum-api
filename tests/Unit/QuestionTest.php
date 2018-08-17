<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class QuestionTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function questionReadTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    
    public function questionCreateTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    
    public function questionUpdateTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    
    public function questionDeleteTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}