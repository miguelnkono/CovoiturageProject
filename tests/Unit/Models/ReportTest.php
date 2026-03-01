<?php

namespace Tests\Unit\Models;

use App\Models\Report;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;


class ReportTest extends TestCase
{
  use RefreshDatabase;

  public function test_report_can_be_created(): void
  {
    $report = Report::factory()->create();
    $this->assertDatabaseHas('reports', ['id' => $report->id]);
  }

  public function test_report_has_reporter_and_reported_user(): void
  {
    $report = Report::factory()->create();

    $this->assertInstanceOf(User::class, $report->reporter);
    $this->assertInstanceOf(User::class, $report->reportedUser);
  }

  public function test_report_default_status_is_pending(): void
  {
    $report = Report::factory()->pending()->create();
    $this->assertEquals('pending', $report->status);
  }

  public function test_report_ride_is_optional(): void
  {
    $report = Report::factory()->create(['ride_id' => null]);
    $this->assertNull($report->ride_id);
  }
}
