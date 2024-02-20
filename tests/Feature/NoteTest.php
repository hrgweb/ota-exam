<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Note;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NoteTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_add_note(): void
    {
        $body = Note::factory()->make();

        $this->postJson(route('notes.store'), $body->toArray())->assertCreated();
    }

    public function test_can_upate_note(): void
    {
        $note = Note::factory()->create();

        $this->putJson(route('notes.update', ['note' => $note->id]), [
            'note' => 'updated note',
            'description' => 'updated desc'
        ])
            ->assertOk()
            ->assertJson(['success' => true]);
    }
}
