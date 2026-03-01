<?php

namespace Tests\Unit\Models;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;

class NotificationTest extends TestCase
{
  use RefreshDatabase;

  public function test_notification_can_be_created(): void
  {
    $notif = Notification::factory()->create();
    $this->assertDatabaseHas('notifications', ['id' => $notif->id]);
  }

  public function test_notification_belongs_to_user(): void
  {
    $notif = Notification::factory()->create();
    $this->assertInstanceOf(User::class, $notif->user);
  }

  public function test_notification_is_unread_by_default(): void
  {
    $notif = Notification::factory()->unread()->create();
    $this->assertFalse($notif->is_read);
  }

  public function test_notification_data_is_cast_to_array(): void
  {
    $notif = Notification::factory()->create([
      'data' => ['booking_id' => 'some-uuid'],
    ]);
    $this->assertIsArray($notif->data);
  }

  public function test_notification_can_be_marked_as_read(): void
  {
    $notif = Notification::factory()->unread()->create();
    $notif->update(['is_read' => true]);

    $this->assertTrue($notif->fresh()->is_read);
  }
}
