<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\EscapeRoom;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class EscapeRoomTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate');
    }

    public function testEscapeRoomListing()
    {
        $escapeRoomCount = 2;
        EscapeRoom::factory()->count($escapeRoomCount)->create();
        $response = $this->get('/api/escape-rooms');
        $response->assertStatus(200);
        $response->assertJsonCount($escapeRoomCount, 'data');
    }

    public function testCreateBooking()
    {
        $escapeRoom = EscapeRoom::factory()->create();
        $user = User::factory()->create();
        $bookingData = [
            'escape_room_id' => $escapeRoom->id,
            'time_slot' => Carbon::now()->format('Y-m-d H:i'),
        ];
        $response = $this->actingAs($user)->post('/api/bookings', $bookingData);
        $response->assertStatus(200);
        $this->assertDatabaseHas('bookings', [
            'user_id' => $user->id,
            'escape_room_id' => $escapeRoom->id,
            'time_slot' => $bookingData['time_slot'],
        ]);
    }

    public function testCancelBooking()
    {
        $booking = Booking::factory()->create();
        $response = $this->actingAs($booking->user)->delete('/api/bookings/'.$booking->id);
        $response->assertStatus(200);
        $this->assertDeleted($booking);
    }
}
