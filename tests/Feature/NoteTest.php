<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Note;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NoteTest extends TestCase
{
    use RefreshDatabase;

    public function test_fetch_all_notes(): void
    {
        // create 2 notes
        Note::factory(2)->create();

        $response = $this->getJson(route('notes.index'))->assertOk();

        $this->assertEquals(2, count($response->json()));
    }

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

    public function test_can_remove_note(): void
    {
        $note = Note::factory()->create();

        $this->deleteJson(route('notes.destroy', ['note' => $note->id]))
            ->assertNoContent();
    }
}
