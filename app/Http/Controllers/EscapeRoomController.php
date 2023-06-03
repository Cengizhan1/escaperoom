<?php

namespace App\Http\Controllers;

use App\Models\EscapeRoom;
use App\Models\TimeSlot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EscapeRoomController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'theme' => 'required|string',
            'maximum_participants' => 'required|integer',
            'time_slots' => 'required|array',
            'time_slots.*.start_time' => 'required|date_format:H:i',
            'time_slots.*.end_time' => 'required|date_format:H:i',
            'time_slots.*.max_participants' => 'required|integer',
        ]);

        try {
            DB::beginTransaction();

            $escapeRoom = EscapeRoom::create([
                'theme' => $validatedData['theme'],
                'maximum_participants' => $validatedData['maximum_participants'],
            ]);

            $timeSlots = [];
            foreach ($validatedData['time_slots'] as $timeSlotData) {
                $timeSlots[] = new TimeSlot([
                    'start_time' => $timeSlotData['start_time'],
                    'end_time' => $timeSlotData['end_time'],
                    'max_participants' => $timeSlotData['max_participants'],
                ]);
            }

            $escapeRoom->timeSlots()->saveMany($timeSlots);

            DB::commit();

            return response()->json($escapeRoom, 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Escape room creation failed'], 500);
        }
    }
    public function index()
    {
        $escapeRooms = EscapeRoom::with('timeSlots')->get();

        return response()->json($escapeRooms);
    }

    public function show($id)
    {
        $escapeRoom = EscapeRoom::find($id);

        if (!$escapeRoom) {
            return response()->json(['error' => 'Escape room not found'], 404);
        }

        return response()->json($escapeRoom);
    }

    public function timeSlots($id)
    {
        $escapeRoom = EscapeRoom::find($id);

        if (!$escapeRoom) {
            return response()->json(['error' => 'Escape room not found'], 404);
        }

        $timeSlots = $escapeRoom->timeSlots;

        return response()->json($timeSlots);
    }
}
