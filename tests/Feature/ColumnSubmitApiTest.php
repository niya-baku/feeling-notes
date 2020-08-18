<?php

namespace Tests\Feature;

use App\Column;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ColumnSubmitApiTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    /**
     * @test
     */
    public function should_コラムを投稿することができる()
    {


        $response = $this->actingAs($this->user)
            ->json('POST', route('column.create'), [
                'situation' => '状況',
                'feeling' => 'その日の気分',
                'think' => 'その時の考え',
                'another_think' => '別の考え',
                'another_feeling' => '別の気分',
                'another_situation' => '対策'
        ]);

        // レスポンスが201(CREATED)であること
        $response->assertStatus(201);
        $column = Column::first();
    }

        /**
     * @test
     */
    public function should_コラムバリデーションエラー()
    {


        $response = $this->actingAs($this->user)
            ->json('POST', route('column.create'), [
                'situation' => '',
                'feeling' => '',
                'think' => '',
                'another_think' => '別の考え',
                'another_feeling' => '別の気分',
                'another_situation' => '対策'
        ]);

        $response->assertStatus(422);
        $column = Column::first();
    }
}
