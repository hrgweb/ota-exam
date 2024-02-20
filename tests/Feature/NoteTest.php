<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Note;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NoteTest extends TestCase
{
    public function test_can_add_note(): void
    {
        $body = Note::factory()->make();

        $this->postJson(route('notes.store'), $body->toArray())->assertCreated();
    }
}
