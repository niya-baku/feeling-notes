<?php

namespace Tests\Feature;

use App\Note;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
//use Illuminate\Support\Carbon;

class NoteApiTest extends TestCase
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
    public function should_ノートを投稿することができる(){
        $response = $this->actingAs($this->user)
            ->json('POST', route('note.create'), [
                'record' => "2020-09-01",
                'wake_uptime' => "07:32",
                'bedtime' => "23:32",
                'iconId_1' => 5,
                'iconId_2' => 4,
                'iconId_3' => 2,
                'body' => 'これはテストです'
        ]);

    // レスポンスが201(CREATED)であること
    $response->assertStatus(201);
    $note = Note::first();
    }

    /**
     * @test
     */
    public function should_ノートバリデーションエラー(){
        $response = $this->actingAs($this->user)
            ->json('POST', route('note.create'), [
                'record' => '',
                'wake_uptime' => '',
                'bedtime' => '',
                'am_image' => 5,
                'pm_image' => 4,
                'night_image' => 2,
                'body' => 'これはテストです'
        ]);

    // レスポンスが201(CREATED)であること
    $response->assertStatus(422);
    $note = Note::first();
    }
}
