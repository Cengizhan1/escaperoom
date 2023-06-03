<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\EscapeRoom;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'escape_room_id' => 'required|exists:escape_rooms,id',
            'time_slot' => 'required|date',
        ]);

        $escapeRoom = EscapeRoom::find($validatedData['escape_room_id']);

        if (!$escapeRoom) {
            throw ValidationException::withMessages(['escape_room_id' => 'Escape room not found.']);
        }

        // Check if the escape room is available in the requested time slot
        $existingBooking = Booking::where('escape_room_id', $escapeRoom->id)
            ->where('time_slot', $validatedData['time_slot'])
            ->first();

        if ($existingBooking) {
            throw ValidationException::withMessages(['time_slot' => 'The escape room is already booked for the requested time slot.']);
        }

        // Check if the maximum number of participants is exceeded
        $bookingCount = Booking::where('escape_room_id', $escapeRoom->id)
            ->where('time_slot', $validatedData['time_slot'])
            ->count();

        if ($bookingCount >= $escapeRoom->maximum_participants) {
            throw ValidationException::withMessages(['time_slot' => 'The escape room is fully booked for the requested time slot.']);
        }

        $user = Auth::user();
        $isBirthday = $user->isBirthday(); // Assume the User model has an isBirthday() method

        $discount = $isBirthday ? 0.1 : 0;

        $booking = new Booking();
        $booking->user_id = $user->id;
        $booking->escape_room_id = $escapeRoom->id;
        $booking->time_slot = $validatedData['time_slot'];
        $booking->discount = $discount;
        $booking->save();

        return response()->json(['message' => 'Booking created successfully.']);
    }

    public function index()
    {
        $user = Auth::user();
        $bookings = Booking::where('user_id', $user->id)->get();

        return response()->json(['bookings' => $bookings]);
    }

    public function destroy($id)
    {
        $booking = Booking::find($id);

        if (!$booking) {
            throw ValidationException::withMessages(['id' => 'Booking not found.']);
        }

        $booking->delete();

        return response()->json(['message' => 'Booking canceled successfully.']);
    }
}
