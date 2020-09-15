@extends('layouts.dashboard')

@section('content')

{{-- DETTAGLI APPARTAMENTO ADMIN --}}


<div class="content-wrap">
    {{-- sezione immagine --}}
    <div class="container immagine px-0 mt-3">
        <div class="row intestazione">
            <div class="col-10 offset-lg-1 col-lg-10">
                <h1 class="h2 d-block mb-0">{{$apartment->title}}</h1>
                <p class="h6 mt-2 mb-3 address">{{$apartment->address}}</p>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-lg-8">
                <div>
                    @if ($apartment->image_url)
                        <img class="img-fluid img-appartamento" src="{{asset('storage/' . $apartment->image_url)}}"  alt="foto appartamento">
                    @else
                        <img class="img-fluid img-appartamento" src="https://www.vogelwarte.ch/elements/snippets/vds/static/assets/images/error.jpg"  alt="immagine mancante">
                    @endif
                </div>
            </div>
            <div class="col-12 col-lg-2">
                <div class="dettagli-camera d-flex align-items-center flex-lg-column h-100 w-100 p-2 mt-2 mt-lg-0">
                    <h2 class="text-center h5 mt-4 mb-4 d-none d-md-block">Dettagli</h2>
                    <ul class="list-unstyled d-flex flex-lg-column justify-content-around mb-0 h-75 w-100">
                        <li class="text-center">
                            <i class="fas fa-ruler fa-2x"></i>
                            <p class="mb-0">{{$apartment->square_meters . " m²"}}</p>
                        </li>
                        <li class="text-center">
                            <i class="fas fa-bed fa-2x"></i>
                            <p class="mb-0">{{$apartment->room . " stanze"}}</p>
                        </li>
                        <li class="text-center">
                            <i class="fas fa-bath fa-2x"></i>
                            <p class="mb-0">{{$apartment->bath . " bagni"}}</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- sezione descrizione --}}
    <div class="container px-0 mt-3">
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="pt-4 mt-4" id="descrizione-appartamento">
                    <p class="text-justify">{{$apartment->description}}</p>
                </div>
            </div>
            <div class="col-12 col-lg-2 mt-4">
                <div class="dettagli-servizi d-flex align-items-center align-items-lg-start flex-lg-column pl-4 h-50 w-100 p-2 mt-2 mt-lg-0">
                    <h2 class="h4 mb-4 mt-3 d-none d-lg-block">Servizi</h2>
                    <div class="tags">
                        <ul class="list-unstyled d-flex flex-wrap flex-md-nowrap flex-lg-column mb-0 w-100">
                            @forelse ($apartment->services as $service)
                            <li class="mt-3">
                                <nobr class="tag-servizi mt-1">{{ $service->description }}</nobr>
                            </li>
                            @empty
                                -
                            @endforelse
                        </ul>
                    </div>
                </div>
                <div class="statistiche d-flex align-items-center flex-lg-column pl-4 w-100 p-2 mt-2 mt-lg-0">
                    <h2 class="h4 mb-4 mt-3 d-none d-lg-block">Statistiche</h2>
                    <div class="">
                        <div class="mb-3">
                            <img class="img-fluid rounded border border-color-grey" src="https://d1whtlypfis84e.cloudfront.net/guides/wp-content/uploads/2018/12/24160114/LOSDOS1-1024x767.png" alt="grafici">
                        </div>
                        <a class="bottone" href="{{Route('admin.statistics', ['apartment' => $apartment->id])}}">Le tue statistiche</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

        {{-- promozioni --}}
    <div class="container promozioni py-3">
        <div class="row">
            <div class=" col-12 col-lg-10 offset-lg-1">
                <h3 class="h4 text-center">Sponsorizza il tuo appartamento</h3>
            </div>
        </div>

        @foreach ($sponsors as $sponsor)
            <div class="row ">
                <div class="col-12 col-lg-10 offset-lg-1">
                    <div class="promozione rounded border border-color-grey py-2 mt-1 mb-1 text-center bg-info">
                        <h5>Prezzo: {{$sponsor->price}}</h5>
                        <span>Metti in evidenza il tuo appartamento per {{$sponsor->description}} ore</span>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
