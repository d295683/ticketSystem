<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Support\Facades\Validator;
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
            ->paginate(10);


        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'title.required' => 'Title is required',
            'title.string' => 'Title must be a string',
            'description.required' => 'Description is required',
            'description.string' => 'Description must be a string',
            'date.required' => 'Date and time is required',
            'date.datetime' => 'Date and time must be a valid datetime',
            'location.required' => 'Location is required',
            'location.string' => 'Location must be a string',
            'price.required' => 'Price is required',
            'price.numeric' => 'Price must be a number',
            'image_url.required' => 'Image URL is required',
            'image_url.string' => 'Image URL must be a string',
            'tickets.required' => 'Tickets is required',
            'tickets.integer' => 'Tickets must be an integer',
        ];

        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'datetime' => 'required|date',
            'location' => 'required|string',
            'price' => 'required|numeric',
            'image_url' => 'required|string',
            'tickets' => 'required|integer',
        ], $messages);

        if ($validator->fails()) {
            return redirect()
                ->route('admin.events.create')
                ->with('error', $validator->errors()->first())
                ->withInput();
        }

        // create event
        $event = new Event();
        $event->title = $request->input('title');
        $event->description = $request->input('description');
        $event->datetime = $request->input('datetime');
        $event->location = $request->input('location');
        $event->price = $request->input('price');
        $event->image_url = $request->input('image_url');
        $event->tickets = $request->input('tickets');

        // save event
        $event->save();

        return redirect()->route('admin.events.index')->with('success', 'Event created successfully');
        // return redirect()->route('events.show', ['event' => $event->id])->with('success', 'Event created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        $event = Event::findOrFail($event->id);

        return view('admin.events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $messages = [
            'title.required' => 'Title is required',
            'title.string' => 'Title must be a string',
            'description.required' => 'Description is required',
            'description.string' => 'Description must be a string',
            'date.required' => 'Date and time is required',
            'date.datetime' => 'Date and time must be a valid datetime',
            'location.required' => 'Location is required',
            'location.string' => 'Location must be a string',
            'price.required' => 'Price is required',
            'price.numeric' => 'Price must be a number',
            'image_url.required' => 'Image URL is required',
            'image_url.string' => 'Image URL must be a string',
            'tickets.required' => 'Tickets is required',
            'tickets.integer' => 'Tickets must be an integer',
        ];

        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'datetime' => 'required|date',
            'location' => 'required|string',
            'price' => 'required|numeric',
            'image_url' => 'required|string',
            'tickets' => 'required|integer',
        ], $messages);

        if ($validator->fails()) {
            return redirect()
                ->route('admin.events.edit', ['event' => $event->id])
                ->with('error', $validator->errors()->first())
                ->withInput();
        }

        // update user
        $event = Event::findOrFail($event->id);
        $event->title = $request->input('title');
        $event->description = $request->input('description');
        $event->datetime = $request->input('datetime');
        $event->location = $request->input('location');
        $event->price = $request->input('price');
        $event->image_url = $request->input('image_url');
        $event->tickets = $request->input('tickets');

        // save user
        $event->save();

        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event = Event::findOrFail($event->id);

        // delete user
        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully');
    }
}
