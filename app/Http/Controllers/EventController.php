<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class EventController extends Controller
{
    /**
     * @var array $rules A list of validation rules for the controller
     */
    protected $rules = [
        'tickets' => 'required|integer|min:1'
    ];

    /**
     * @var array $messages A list of messages to display when validation fails
     */
    protected $messages = [
        'tickets.required' => 'The amount of tickets is required.',
        'tickets.integer' => 'The amount of tickets must be a number.',
        'tickets.min' => 'The amount of tickets must be at least 1.'
    ];

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
        return view('events.show', compact('event'));
    }

    public function order(Event $event)
    {
        return view('events.order', compact('event'));
    }

    public function reserve(Request $request, Event $event)
    {
        // Create the validator
        $validator = Validator::make($request->all(), $this->rules, $this->messages);

        // Check if the validation fails
        if ($validator->fails()) {
            return redirect()
                ->route('events.order', $event)
                ->with('error', $validator->errors())
                ->withInput();
        }

        $amount = $request->input('tickets');

        if ($amount > $event->ticketsLeft()) {
            return redirect()->route('events.order', $event)->with('error', 'Not enough tickets available.');
        }

        $user = Auth::user();

        $reservation = new Reservation();
        $reservation->user_id = $user->id;
        $reservation->event_id = $event->id;
        $reservation->save();

        // Create the tickets for the reservation
        $ticketsData = collect(range(1, $amount))->map(function () {
            return ['code' => (string) Str::uuid()];
        });

        $reservation->tickets()->createMany($ticketsData->toArray());

        return redirect()->route('dashboard.reservations.show', $reservation)->with('success', 'Your reservation has been made!');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $events = Event::where('datetime', '>=', now())
            ->where(function ($query) use ($search) {
                $query->where('title', 'like', "%$search%")
                    ->orWhere('location', 'like', "%$search%");
            })
            ->orderBy('datetime', 'asc')
            ->get()
            ->groupBy(function ($event) {
                return $event->datetime->format('Y');
            });

        return view('events.search', compact('events'));
    }
}
