<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::where('datetime', '>=', now())
            ->orderBy('datetime', 'asc')
            ->get()
            ->groupBy(function ($event) {
                return $event->datetime->format('Y');
            });

        return view('events.index', compact('events'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        // Get the event from the database
        $event = Event::findOrFail($event->id);

        return view('events.show', compact('event'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }
}
