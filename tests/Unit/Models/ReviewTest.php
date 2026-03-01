<?php

namespace Tests\Unit\Models;

use App\Models\Booking;
use App\Models\Review;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;

class ReviewTest extends TestCase
{
  use RefreshDatabase;

  public function test_review_can_be_created(): void
  {
    $review = Review::factory()->create();
    $this->assertDatabaseHas('reviews', ['id' => $review->id]);
  }

  public function test_review_belongs_to_booking(): void
  {
    $review = Review::factory()->create();
    $this->assertInstanceOf(Booking::class, $review->booking);
  }

  public function test_review_has_reviewer_and_reviewee(): void
  {
    $review = Review::factory()->create();

    $this->assertInstanceOf(User::class, $review->reviewer);
    $this->assertInstanceOf(User::class, $review->reviewee);
  }

  public function test_review_rating_is_between_1_and_5(): void
  {
    for ($i = 0; $i < 10; $i++) {
      $review = Review::factory()->create();
      $this->assertGreaterThanOrEqual(1, $review->rating);
      $this->assertLessThanOrEqual(5, $review->rating);
    }
  }

  public function test_review_type_is_valid(): void
  {
    $review = Review::factory()->create(['type' => 'passenger_to_driver']);
    $this->assertEquals('passenger_to_driver', $review->type);
  }
}
