@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row pb-5 pt-3">
            <div class="col-12">
                <h1 class="text-center">Crea un Ticket</h1>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8 col-sm-10 col-12">
                <form method="POST" action="{{ route('admin.tickets.store') }}" enctype="multipart/form-data">
                    @csrf

                    {{-- Nome --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nome del Ticket *</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    {{-- Descrizione --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Descrizione *</label>
                        <textarea class="form-control" id="description" name="description" required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Stato --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Stato *</label>
                        <select class="form-control" id="state" name="state" required>
                            <option value="" disabled selected>Seleziona uno stato</option>
                            @foreach ($states as $state)
                                <option value="{{ $state }}" {{ old('state') == $state ? 'selected' : '' }}>{{ ucfirst($state) }}</option>
                            @endforeach
                        </select>
                        @error('state')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    {{-- Data --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Data *</label>
                        <input type="date" class="form-control" id="date" name="date" value="{{ old('date') }}" required>
                        @error('date')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    {{-- Operatore --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Operatore *</label>
                        <select class="form-control select2" id="oprator_id" name="oprator_id" required>
                            @foreach ($operators as $operator)
                                <option value="{{ $operator->id }}" @if (old('oprator_id') == $operator->id) selected @endif>{{ $operator->name }}</option>
                            @endforeach
                        </select>
                        @error('oprator_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Categoria --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Categoria *</label>
                        <select class="form-control select2" id="category_id" name="category_id" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if (old('category_id') == $category->id) selected @endif>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="mt-3" style="color: gray">I campi contenenti <b style="color: black">*</b> sono obbligatori </div>

                    <button type="submit" id="submit" class="btn btn-primary mt-3 mb-5">Crea Ticket</button>
                </form>
            </div>
        </div>
    </div>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="{{ asset('js/search.js')}}"></script>
    <script src="{{ asset('js/validate_tickets_create.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endsection
