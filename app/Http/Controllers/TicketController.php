<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Ticket;
use Barryvdh\DomPDF\Facade\Pdf;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Reservation $reservation)
    {
        // only allow the user to view their own tickets
        if ($reservation->user_id !== auth()->id()) {
            abort(403);
        }

        // show all tickets in the pdf, each ticket on a new page
        $reservation->load('tickets', 'user', 'event');

        // Load the view with necessary data
        $view = view('pdf.tickets', [
            'reservation' => $reservation,
            'tickets' => $reservation->tickets,
            'event' => $reservation->event,
            'user' => $reservation->user,
        ]);

        // Convert the view to PDF
        $pdf = Pdf::loadHTML($view->render());

        // Return the PDF response
        return $pdf->stream('tickets.pdf');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation, Ticket $ticket)
    {
        // only allow the user to view their own tickets
        if ($reservation->user_id !== auth()->id()) {
            abort(403);
        }

        // show a single ticket in the pdf
        $reservation->load('user', 'event');

        // Load the view with necessary data
        $view = view('pdf.ticket', [
            'ticket' => $ticket,
            'event' => $reservation->event,
            'user' => $reservation->user,
        ]);

        // Convert the view to PDF
        $pdf = Pdf::loadHTML($view->render());

        // Return the PDF response
        return $pdf->stream('ticket.pdf');
    }
}
