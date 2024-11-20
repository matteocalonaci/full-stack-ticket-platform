@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center p-4">{{ $manga->title }}</h1>

        <div class="text-end mt-1">
            <a href="{{ route('admin.mangas.index') }}" class="btn btn-secondary mb-1">Torna alla lista</a>
        </div>

        <div class="row">
            <div class="col-md-4">
                <h3>Copertina</h3>
                <div class="text-center">
                    @if (Str::startsWith($manga->cover_image, 'http'))
                        <img src="{{ $manga->cover_image }}" alt="{{ $manga->title }}" class="img-fluid" style="width: 100%; height: auto; object-fit: cover;">
                    @else
                        <img src="{{ asset('storage/' . $manga->cover_image) }}" alt="{{ $manga->title }}" class="img-fluid" style="width: 100%; height: auto; object-fit: cover;">
                    @endif
                </div>
            </div>
            <div class="col-md-8">
                <h3>Dettagli</h3>
                <div class="detail-item">
                    <strong>Nome:</strong> {{ $manga->title }}
                </div>
                <div class="detail-item">
                    <strong>Autore:</strong> {{ $manga->author->name ?? 'Non disponibile' }}
                </div>
                <div class="detail-item">
                    <strong>Volume:</strong> {{ $manga->volume }}
                </div>
                <div class="detail-item">
                    <strong>Prezzo:</strong> {{ number_format($manga->price, 2, ',', '.') }} €
                </div>
                <div class="detail-item">
                    <strong>Disponibilità:</strong> {{ $manga->availability ? 'Disponibile' : 'Non disponibile' }}
                </div>
                <div class="detail-item">
                    <strong>In Corso:</strong> {{ $manga->in_progress ? 'Sì' : 'No' }}
                </div>
                <div class="detail-item">
                    <strong>Anno di Pubblicazione:</strong> {{ $manga->year }}
                </div>
                <div class="detail-item">
                    <strong>Genere:</strong>
                    @foreach ($manga->genres as $genre)
                        {{ $genre->name }}@if (!$loop->last), @endif
                    @endforeach
                </div>
                <div class="detail-item">
                    <strong>Categoria:</strong> {{ $manga->categories->name ?? 'Non disponibile' }}
                </div>
                <div class="detail-item">
                    <strong>Editore:</strong> {{ $manga->editors->name ?? 'Non disponibile' }}
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <h3>Descrizione</h3>
                <div class="description">
                    {!! nl2br(e($manga->description)) !!}
                </div>
            </div>
        </div>

    </div>
@endsection

<style scoped>
    .detail-item {
        margin-bottom: 10px;
        padding: 10px;
        border: 1px solid #ddd; /* Aggiungi un bordo per distinguere i dettagli */
        border-radius: 5px; /* Rendi gli angoli arrotondati */
        background-color: #f9f9f9; /* Colore di sfondo leggero */
    }

    .description {
        padding: 15px;
        border: 1px solid #ddd; /* Aggiungi un bordo per la descrizione */
        border-radius: 5px; /* Rendi gli angoli arrotondati */
        background-color: #f9f9f9; /* Colore di sfondo leggero */
        margin: 20px 0; /* Margine superiore per separare dalla sezione superiore */
    }

    @media (max-width: 768px) {
        .detail-item {
            padding: 15px; /* Maggiore padding per schermi più piccoli */
        }
    }
</style>
