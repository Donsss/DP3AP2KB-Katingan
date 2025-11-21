<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    /**
     * Menampilkan halaman utama agenda untuk publik.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('user-views.agenda');
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getEvents(Request $request)
    {
        // Validasi input dari JavaScript
        $request->validate([
            'year' => 'required|integer|min:1900|max:2100',
            'month' => 'required|integer|min:1|max:12',
        ]);

        $events = Agenda::whereYear('date', $request->year)
                        ->whereMonth('date', $request->month)
                        ->orderBy('time', 'asc')
                        ->get()
                        ->groupBy(function ($event) {
                            return $event->date->format('Y-m-d');
                        });
        
        return response()->json($events);
    }
}

