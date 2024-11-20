@extends('layouts.app')
@section('content')

<div class="jumbotron p-0" style="background-color: rgba(0, 0, 0, 0.923)">
    <div class="container py-5 h-100">
        <div class="logo_laravel">
            <img src="{{ asset('images/ticket-platform-complete.jpg') }}" alt="Logo Ticket Platform" style="width: 8rem">
                <!-- Il tuo SVG qui -->
            </g>
        </div>
        <h1 class="display-5 fw-bold text-white">
            Benvenuti in TICKET-PLATFORM
        </h1>

        <p class="col-md-8 fs-4 text-white">Questa applicazione è realizzata in Laravel e consente di gestire e visualizzare i Ticket di supporto. È progettata per un'unica tipologia di utente: l'Admin, che ha accesso a tutte le funzionalità necessarie per gestire gli operatori, i ticket e le categorie assegnabili.</p>
        <a href="https://github.com/matteocalonaci/full-stack-ticket-platform" class="btn btn-primary btn-lg" type="button">Link repo</a>
    </div>
    <div class="content">
        <div class="container text-white">
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempora temporibus, dicta nemo aliquam totam nisi deserunt soluta quas voluptatum ab beatae praesentium necessitatibus minus, facilis illum rerum officiis accusamus dolores!</p>
        </div>
    </div>
</div>

@endsection

<style scoped>
    .jumbotron {
    height: calc(100vh - 6rem); /* Full viewport height minus navbar height */
    display: flex;
    flex-direction: column;
    justify-content: center; /* Center content vertically */
    align-items: center; /* Center content horizontally */
}
</style>
