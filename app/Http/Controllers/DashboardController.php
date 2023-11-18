<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $reservationsByStatus = $this->getReservationsByStatus();

        return view('dashboard.reservations.index', compact('reservationsByStatus'));
    }

    private function getReservationsByStatus()
    {
        $reservations = Auth::user()->reservations;

        return [
            'Toekomstig' => $reservations->filter(fn($reservation) => $reservation->getStatus() === 'Toekomstig'),
            'Historisch' => $reservations->filter(fn($reservation) => $reservation->getStatus() === 'Historisch'),
            'Verlopen' => $reservations->filter(fn($reservation) => $reservation->getStatus() === 'Verlopen'),
        ];
    }
}
