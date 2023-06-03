<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEscapeRoomRequest;
use App\Models\EscapeRoom;
use App\Models\TimeSlot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EscapeRoomController extends Controller
{
    public function store(CreateEscapeRoomRequest $request): \Illuminate\Http\JsonResponse
    {
        $validatedData = $request->validated();

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
    public function index(): \Illuminate\Http\JsonResponse
    {
        $escapeRooms = EscapeRoom::with('timeSlots')->get();
        return response()->json($escapeRooms);
    }

    public function show(EscapeRoom $escapeRoom): \Illuminate\Http\JsonResponse
    {
        return response()->json($escapeRoom);
    }


    public function timeSlots(EscapeRoom $escapeRoom)
    {
        return response()->json($escapeRoom->timeSlots);
    }
}
