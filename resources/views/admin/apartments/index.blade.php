@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class=" col-sm-11">
                <h1>Lista Appartamenti</h1>

            </div>
            <div class="col-sm-1 d-flex align-items-center justify-content-end">
                <a class="" href="
                {{ route('admin.apartments.create')}}
                "><i class="fas fa-plus fa-2x"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="container lista-cards">
        <div class="row">
            @forelse ($apartments as $apartment)
            <div class="col-12 d-flex rounded border border-color-grey py-2">
                <div class="col-4  immagine">
                    <img class="rounded img-fluid" src="{{$apartment->image_url}}" alt="foto-appartamento">
                </div>
                <div class="text-left col-8 py-4 d-flex flex-column justify-content-between">
                    <div class="testo">
                        <h3>{{$apartment->title}}</h3>
                        <p>{{$apartment->description}}</p>
                        <p>{{$apartment->address}}</p>
                        @forelse ($apartment->services as $service)
                             {{ $service->description }}{{ $loop->last ? '' : ', '}}
                        @empty
                           -
                        @endforelse
                    </div>
                        <div class="buttons">
                            <a class=" btn btn-outline-primary" value="Dettagli" href="
                            {{ route('admin.apartments.show',['apartment'=> $apartment->id])}}
                            "><i class="fas fa-search"></i></a>

                            <a class="btn btn-outline-success" value="Modifica"  href="
                            {{ route('admin.apartments.edit',['apartment'=> $apartment->id])}}
                            "
                            ><i class="fas fa-pencil-alt"></i></a>

                            <form class="d-inline" action="
                            {{ route('admin.apartments.destroy', ['apartment' => $apartment->id]) }}
                            "
                            method="post">
                            @csrf
                            @method('DELETE')
                            <input class="btn btn-outline-danger" type="submit" value="&#xf12d;">

                            </form>
                        </div>
                </div>
            </div>
         @empty
            <p>AGGIUNGI IL TUO PRIMO APPARTAMENTO</p>
         @endforelse
        </div>
    </div>
@endsection
