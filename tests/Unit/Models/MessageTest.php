<?php

namespace Tests\Unit\Models;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;

class MessageTest extends TestCase
{
  use RefreshDatabase;

  public function test_message_can_be_created(): void
  {
    $message = Message::factory()->create();
    $this->assertDatabaseHas('messages', ['id' => $message->id]);
  }

  public function test_message_belongs_to_conversation(): void
  {
    $message = Message::factory()->create();
    $this->assertInstanceOf(Conversation::class, $message->conversation);
  }

  public function test_message_belongs_to_sender(): void
  {
    $message = Message::factory()->create();
    $this->assertInstanceOf(User::class, $message->sender);
  }

  public function test_message_is_not_read_by_default(): void
  {
    $message = Message::factory()->unread()->create();
    $this->assertFalse($message->is_read);
  }

  public function test_message_content_is_stored(): void
  {
    $message = Message::factory()->create(['content' => 'Bonjour, je confirme ma présence!']);
    $this->assertEquals('Bonjour, je confirme ma présence!', $message->content);
  }
}
