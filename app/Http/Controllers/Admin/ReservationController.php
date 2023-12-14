<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $reservations = Reservation::query()
            ->where('id', 'LIKE', "%{$search}%")
            ->orWhereHas('event', function ($query) use ($search) {
                $query->where('title', 'LIKE', "%{$search}%");
            })
            ->orWhereHas('user', function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%");
            })
            ->paginate();


        return view('admin.reservations.index', compact('reservations'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        $reservation->load('tickets', 'user', 'event');
        return view('admin.reservations.edit', compact('reservation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        $tickets = $request->get('tickets');

        foreach ($tickets as $ticketId => $ticketData) {
            $ticket = $reservation->tickets()->find($ticketId);

            $ticket->update([
                'used' => $ticketData['used'],
            ]);
        }

        return redirect()->back()->with('success', 'Tickets updated successfully');
    }

    /**
     * Reset the specified resource in storage.
     */
    public function reset(Reservation $reservation)
    {
        $reservation->tickets()->update([
            'used' => false,
        ]);

        return redirect()->back()->with('success', 'Tickets reset successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->tickets()->delete();
        $reservation->delete();

        return redirect()->route('admin.reservations.index')->with('success', 'Reservation deleted successfully');
    }

    public function tickets(Reservation $reservation)
    {
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
}
