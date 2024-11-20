@extends('layouts.app')

@section('content')
    <div class="container" >
        <h1 class="text-center pt-4">Catalogo ticket</h1>
        <div class="d-flex flex-wrap justify-content-end align-items-center p-4">
            <button class="btn-add-ticket btn btn-primary mt-3" type="button" onclick="window.location.href='{{ route('admin.tickets.create') }}'">
                Aggiungi un nuovo ticket
            </button>

        </div>
        <div class=" search-bar mb-1 mt-2 d-flex justify-content-end mx-2 mx-md-4">
            <form method="GET" action="{{ route('admin.tickets.index') }}" class="w-100">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cerca un ticket..." value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary" style="background-color: white; color:black" type="submit">Cerca</button>
                </div>
            </form>
        </div>

        <div class="table-responsive p-4">
            @if ($tickets->count() > 0)
                <table class="table table-sm table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Operatore</th>
                            <th>Categoria</th>
                            <th>Stato</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    <tbody id="ticketTableBody">
                        @foreach ($tickets as $ticket)
                            <tr>

                                <td data-label="Nome">{{ $ticket->title }}</td>
                                {{-- <td data-label="Operatore">{{ $ticket->operator->name }}</td> --}}
                                <td data-label="Operatore">Operatore</td>
                                <td data-label="Operatore">Categoria</td>
                                <td data-label="Stato">{{$ticket->state}}</td>
                                <td data-label="Azioni">
                                    <div class="d-flex flex-column flex-sm-row justify-content-between">
                                        <a href="{{ route('admin.tickets.edit', $ticket->id) }}" class="btn btn-warning flex-grow-1 mb-2 btn-custom">Modifica</a>
                                        <form action="{{ route('admin.tickets.destroy', $ticket->id) }}" method="POST" class="flex-grow-1"
                                            onsubmit="event.preventDefault(); Swal.fire({
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
                                            <button type="submit" class="btn btn-danger w-100 btn-custom">Elimina</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex flex-wrap justify-content-between align-items-center mt-3">
                        <div class="px-3 px-md-5">
                            Mostra
                            <strong>{{ $tickets->firstItem() }}</strong> a
                            <strong>{{ $tickets->lastItem() }}</strong> di
                            <strong>{{ $tickets->total() }}</strong> risultati
                        </div>
                        <div class="mt-2 mt-md-0">
                            <div style="white-space: nowrap;">
                                {{ $tickets->links('vendor.pagination.bootstrap-4') }}
                            </div>
                        </div>
                </div>

            @else
            <p class="text-center">Il menù attualmente è vuoto.</p>
            @endif
        </div>

    </div>
@endsection

<style scoped>


    .btn-custom {
    height: 2rem; /* Imposta l'altezza desiderata */
    min-width: 5rem; /* Imposta una larghezza minima per entrambi i bottoni */
    margin-right: 0.5rem
}

    .container {
        height: auto; /* Mantieni l'altezza auto per adattarsi al contenuto */
    }

    .table-responsive {
        padding: 0; /* Rimuove il padding per una migliore visualizzazione */
    }

    .table {
        width: 100%; /* Imposta la larghezza della tabella al 100% */
        border-collapse: collapse; /* Rimuove gli spazi tra le celle */
    }

    .table-sm th, .table-sm td {
        white-space: nowrap; /* Impedisce il ritorno a capo del testo nelle celle */
        overflow: hidden; /* Nasconde il contenuto in eccesso */
        text-overflow: ellipsis; /* Mostra i puntini di sospensione se il testo è troppo lungo */
    }
    .btn-add-ticket{
        width: 20rem
    }

    @media (max-width: 576px) {
        .table-responsive {
            overflow-x: auto; /* Consente lo scroll orizzontale su schermi piccoli */
        }

        .table-sm {
            width: 100%; /* Imposta la larghezza della tabella al 100% */
            margin: 0 auto; /* Centra la tabella orizzontalmente */
        }

        .table-sm thead {
            display: none; /* Nasconde l'intestazione della tabella per schermi piccoli */
        }

        .table-sm tr {
            display: block; /* Rende ogni riga della tabella un blocco */
            margin-bottom: 20px; /* Aggiunge margine tra le righe */
            border-bottom: 2px solid #ccc; /* Aggiunge una linea di separazione */
        }

        .table-sm td {
            display: block; /* Rende ogni cella un blocco */
            width: 100%; /* Imposta la larghezza delle celle al 100% */
            padding: 10px; /* Aggiunge padding alle celle */
            border: none; /* Rimuove i bordi */
            border-bottom: 1px solid #ccc; /* Aggiunge un bordo inferiore */
        }

        .table-sm td:before {
            content: attr(data-label); /* Mostra l'etichetta della cella */
            font-weight: bold; /* Rende il testo in grassetto */
            margin-right: 10px; /* Aggiunge margine a destra */
        }

        .table-sm tr:not(:last-child) {
            margin-bottom: 20px; /* Aggiunge margine solo alle righe che non sono ultime */
        }
        .btn-custom {
        height: 2rem; /* Imposta l'altezza desiderata */
        min-width: 5rem; /* Imposta una larghezza minima per entrambi i bottoni */
        margin-right: 0
        }
        .btn-add-ticket{
            width: 100%;
        }
        .search-bar{
            padding-left: 1rem;
            padding-right: 1rem;
        }

    }
</style>
