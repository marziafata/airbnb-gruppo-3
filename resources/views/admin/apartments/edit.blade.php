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
            <form action="{{ route('admin.apartments.update', ['apartment' => $apartment->id] )}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="titolo">Titolo</label>
                    <input type="text" name="title" class="form-control" id="titolo" placeholder="Titolo inserzione" value="{{ old('title', $apartment->title) }}">
                </div>
                <div class="form-group">
                    <label for="descrizione">Descrizione</label>
                    <textarea type="text" name="description" class="form-control" id="descrizione" placeholder="Inserisci descrizione dell'appartamento...">{{ old('description', $apartment->description) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="indirizzo">Indirizzo</label>
                    <input type="text" name="address" class="form-control" id="indirizzo" placeholder="Indirizzo" value="{{ old('address', $apartment->address) }}">
                </div>
                <div class="form-group">
                    <label for="numero-stanze">Numero di stanze:</label>
                    <select class="form-control" name="room" id="numero-stanze">
                        {{-- <option value="">Seleziona il numero di stanze</option> --}}
                        @for ($i = 1; $i <= 10; $i++)
                            {{-- <option value="{{$i}}"
            
                            > --}}
                            <option value='{{$i}}' {{ old('room',$apartment->room)==$i ? 'selected' : ''  }}>{{$i}}</option>

                            {{-- {{ old('category_id'), ($post->category->id ?? '') == $category->id ? 'selected' : ''}}> --}}
                            {{-- {{ $i }}
                            </option> --}}

                            
                        @endfor
                    </select>
                </div>
                <div class="form-group">
                    <label for="numero-bagni">Numero di bagni:</label>
                    <select class="form-control" name="bath" id="numero-bagni">
                        {{-- <option value="">Seleziona il numero di bagni</option> --}}
                        @for ($i = 1; $i <= 10; $i++)
                            
                            <option value='{{$i}}' {{ old('bath',$apartment->bath)==$i ? 'selected' : ''  }}>{{$i}}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group">
                    <label for="mq">Dimensioni</label>
                    <input type="number" name="square_meters" class="form-control" id="mq" placeholder="Inserisci le dimensioni in mq dell'appartamento..." value="{{ old('square_meters', $apartment->square_meters) }}">
                </div>
                {{-- <div class="form-group">
                    <label for="immagine">Immagine</label>
                    <input type="file" name="image" class="form-control-file">
                </div> --}}
                <div class="form-group">
                    Servizi:
                    @foreach ($services as $service)
                        <div class="form-check">
                            <label class="form-check-label">
                                <input
                                    @if ($errors->any())
                                        {{ in_array($service->id, old('services', [])) ? 'checked' : '' }}
                                    @else
                                        {{ $apartment->services->contains($service) ? 'checked' : '' }}
                                    @endif
                                    class="form-check-input"
                                    name="services[]"
                                    type="checkbox"
                                    value="{{ $service->id }}">
                                {{ $service->description }}
                            </label>
                        </div>
                    @endforeach
                </div>
                <button type="submit" class="btn btn-primary">Salva</button>
            </form>
        </div>
    </div>
</div>
@endsection
