@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center pt-4">Dettagli del Ticket</h1>
        <div class="card mt-4">
            <div class="card-header">
                <h5>{{ $ticket->title }}</h5>
            </div>
            <div class="card-body">
                <h6>Operatore:</h6>
                <p>{{ $ticket->operator->name ?? 'N/A' }}</p>

                <h6>Categoria:</h6>
                <p>{{ $ticket->category->name ?? 'N/A' }}</p>

                <h6>Stato:</h6>
                <p>{{ $ticket->state }}</p>

                <h6>Descrizione:</h6>
                <p>{{ $ticket->description }}</p>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.tickets.index') }}" class="btn btn-secondary">Torna alla lista</a>
                    <div class="d-flex">
                        {{-- <a href="{{ route('admin.tickets.edit', $ticket->id) }}" class="btn btn-warning me-2" title="Modifica">
                            <i class="fas fa-edit text-white"></i>
                        </a> --}}
                        <form action="{{ route('admin.tickets.destroy', $ticket->id) }}" method="POST" onsubmit="event.preventDefault(); Swal.fire({
                            title: 'Elimina il ticket?',
                            text: 'Sei sicuro di eliminare il ticket {{ $ticket->title }}?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Elimina',
                            cancelButtonText: 'Annulla',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                this.submit();
                            }
                        })">
                            @csrf
                            @method('DELETE')
                            {{-- <button type="submit" class="btn btn-danger" title="Elimina">
                                <i class="fas fa-trash"></i>
                            </button> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
