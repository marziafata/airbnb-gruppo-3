@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex align-items-center">
                    <h1 class="mt-3 mb-3">Nuova inserzione</h1>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('admin.apartments.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="titolo">Titolo</label>
                        <input type="text" required name="title" class="form-control" id="titolo" placeholder="Titolo inserzione" value="{{ old('title') }}">
                    </div>
                    <div class="form-group">
                        <label for="testo">Descrizione</label>
                        <textarea type="text" name="description" class="form-control" id="testo" placeholder="Inserisci descrizione dell'appartamento...">{{ old('description') }}</textarea>
                    </div>

                    <!-- form indirizzo -->
                    <div class="form-group">
                        <label for="form-address">Indirizzo</label>
                        <input type="search" required class="form-control" id="form-address" name="address" value="{{old('address')}}" placeholder="Inserisci il tuo indirizzo">
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="latitude" class="form-control" id="latitude" value="{{old('latitude')}}">
                        <input type="hidden" name="longitude" class="form-control" id="longitude" value="{{old('longitude')}}">
                    </div>


                    <div class="form-group">
                        <label for="numero-stanze">Numero di stanze:</label>
                        <select class="form-control" name="room" id="numero-stanze">
                            <option value="">Seleziona il numero di stanze</option>
                            @for ($i = 1; $i <= 10; $i++)
                                <option
                                value="{{ $i }}"{{ old('room')==$i ? 'selected' : '' }}>
                                {{ $i }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="numero-bagni">Numero di bagni:</label>
                        <select class="form-control" name="bath" id="numero-bagni">
                            <option value="">Seleziona il numero di bagni</option>
                            @for ($i = 1; $i <= 10; $i++)
                                <option
                                value="{{ $i }}"{{ old('bath')==$i ? 'selected' : ''}}>
                                {{ $i }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="mq">Dimensioni</label>
                        <input type="number" required min="0" name="square_meters" class="form-control" id="mq" placeholder="Inserisci le dimensioni in mq dell'appartamento..." value="{{ old('square_meters') }}">
                    </div>
                    <div class="form-group">
                        <label for="immagine">Immagine</label>
                        <input type="file" name="image" id="immagine" class="form-control-file">
                    </div>
                    <div class="form-group">
                        Servizi:
                        @foreach ($services as $service)
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input
                                        {{ in_array($service->id, old('services', [])) ? 'checked' : '' }}
                                        class="form-check-input"
                                        name="services[]"
                                        type="checkbox"
                                        value="{{ $service->id }}">
                                    {{ $service->description }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <button type="submit" class="btn bottone-pieno">Salva</button>
                    <a value="Visualizza" href="{{ route('admin.apartments.index') }}" id="my-btn" class="btn btn-outline-danger" type="button">
                        Annulla
                    </a>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('js/autocomplete.js') }}" charset="utf-8"></script>
@endsection
