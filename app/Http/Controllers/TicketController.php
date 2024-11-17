<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->role === 'admin') {
            return Ticket::with('user')->get();
        }

        return $user->tickets; 
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string']);

        $ticket = $request->user()->tickets()->create([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return response()->json($ticket, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate(['status' => 'required|string']);

        $ticket = Ticket::findOrFail($id);

        if ($request->user()->role !== 'admin') {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $ticket->update(['status' => $request->status]);

        return response()->json($ticket);
    }
}
