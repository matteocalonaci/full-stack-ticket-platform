<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\Operator;
use App\Models\Category;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Mostra il modulo per creare un nuovo ticket.
     */
    public function index(Request $request)
    {
        // Inizializza la query
        $query = Ticket::with(['operators', 'categories']);

        // Aggiungi la logica di ricerca
        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Recupera i ticket paginati
        $tickets = $query->paginate(5);

        return view('admin.tickets.index', compact('tickets'));
    }

    public function create()
    {
        // Recupera tutte le categorie e operatori per il modulo
        $categories = Category::all();
        $operators = Operator::all();
        $states = ['assegnato', 'in lavorazione', 'chiuso'];


        return view('admin.tickets.create', compact('categories', 'operators', 'states'));
    }

    /**
     * Memorizza un nuovo ticket.
     */
    public function store(Request $request)
    {
        // Validazione dei dati del ticket
        $request->validate([
            'title' => 'required|string|max:255',
            'state' => 'required|string|max:50',
            'date' => 'required|date',
            'description' => 'required|string',
            'operator_id' => 'required|exists:operators,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Crea il ticket
        Ticket::create($request->all());

        // Reindirizza a una pagina di successo o alla lista dei ticket
        return redirect()->route('admin.tickets.index')->with('success', 'Ticket creato con successo!');
    }

    /**
     * Mostra tutti i ticket.
     */

    /**
     * Mostra i dettagli di un ticket specifico.
     */
    public function show(Ticket $ticket)
    {
        // Recupera il ticket con le relazioni
        $ticket->load(['operators', 'categories']);

        return view('admin.tickets.show', compact('ticket'));
    }

    /**
     * Mostra il modulo per modificare un ticket.
     */
    public function edit($id)
    {
        $ticket = Ticket::with(['operators', 'categories'])->findOrFail($id);
        $categories = Category::all();
        $operators = Operator::all();
        $states = ['assegnato', 'in lavorazione', 'chiuso'];


        return view('admin.tickets.edit', compact('ticket', 'categories', 'operators', 'states'));
    }
    /**
     * Aggiorna un ticket esistente.
     */
    public function update(Request $request, Ticket $ticket)
    {
        // Validazione dei dati del ticket
        $request->validate([
            'title' => 'required|string|max:255',
            'state' => 'required|string|max:50',
            'date' => 'required|date',
            'description' => 'required|string',
            'operator_id' => 'required|exists:operators,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Aggiorna il ticket
        $ticket->update($request->all());

        // Reindirizza a una pagina di successo o alla lista dei ticket
        return redirect()->route('admin.tickets.index')->with('success', 'Ticket aggiornato con successo!');
    }

    /**
     * Elimina un ticket.
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->route('admin.tickets.index')->with('success', 'Ticket eliminato con successo!');
    }
}
