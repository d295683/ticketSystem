<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Auth::user()->reservations;

        $reservationsByStatus = [
            'Toekomstig' => $reservations->filter(fn ($reservation) => $reservation->getStatus() === 'Toekomstig'),
            'Historisch' => $reservations->filter(fn ($reservation) => $reservation->getStatus() === 'Historisch'),
            'Verlopen' => $reservations->filter(fn ($reservation) => $reservation->getStatus() === 'Verlopen'),
        ];

        return view('dashboard.reservations.index', compact('reservationsByStatus'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        if (Auth::id() !== $reservation->user_id) {
            abort(403);
        }

        $event = $reservation->event;
        $tickets = $reservation->tickets()->paginate(5);

        return view('dashboard.reservations.show', compact('event', 'reservation', 'tickets'));
    }
}
