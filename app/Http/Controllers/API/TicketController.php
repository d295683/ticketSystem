<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TicketController extends Controller
{

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request) : JsonResponse
    {
        // validate request
        $request->validate([
            'code' => 'required|string',
        ]);

        // update ticket used status
        $ticket = Ticket::where('code', $request->code)->first();

        // check if ticket exists
        if (!$ticket) {
            return response()->json([], 404);
        }

        // check if ticket is already used
        if ($ticket->used) {
            return response()->json([], 204);
        }

        // update ticket
        $ticket->used = !$ticket->used;

        // save ticket
        $ticket->save();

        // return the ticket
        return response()->json($ticket, 200);

    }

}
