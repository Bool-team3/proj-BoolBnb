@extends('layouts.user_app')
@section('title', "Appartamenti")

@section('content')
    <div class="container" id="apartment-show">
        <a href="{{route('user.apartments.index')}}" class="back-to-home" title="Torna indietro">
            <i class="fas fa-long-arrow-alt-left fa-4x"></i>
        </a>
        <div class="row p-5">
            <div class="card mt-3">
                <div class="row g-0">
                <div class="col-12 col-lg-8">
                    <img src="{{ $apartment->img_url ? $apartment->getImagePrefix() . $apartment->img_url : 'https://www.pianetacasafacile.it/uploads/cache/profile_mid/uploads/property_images/2018/01/property_no_photo.png' }}" alt="Appartamento" class="img-fluid rounded-start" alt="Foto Appartamento">
                    <div class="d-flex justify-content-around p-3">
                        <p class="card-text mb-2">
                            <div class="d-flex align-items-center">
                                Visibilità:
                                @if ($apartment->visible)
                                    <i class="fas fa-eye fa-2x mx-2" title="Visibile"></i>
                                @else
                                    <i class="fas fa-eye-slash fa-2x mx-2" title="Non visibile"></i>
                                @endif
                            </div>
                        </p>
                        <p class="card-text">
                            @if ($apartment->sponsors()->exists('sponsor_id'))
                                <span class="badge badge-success p-1">Sponsorizzato</span>
                            @else
                                <span class="badge badge-danger p-1">Non Sponsorizzato</span>
                            @endif

                            @if ($apartment->sponsors()->exists('expiration_date'))
                                @foreach ($apartment->sponsors as $sponsor)
                                    <span class="text-muted"><strong>Scadenza sponsorizzazione: {{$sponsor->pivot->expiration_date}}</strong><span>
                                @endforeach
                            @endif        
                        </p>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="card-body">
                        <h5 class="card-title"><strong>{{$apartment->title}}</strong></h5>
                        <legend>Info sull'indirizzo</legend>
                        <p class="card-text">Provincia: {{$apartment->province}}</p>
                        <p class="card-text">Città: {{$apartment->city}}</p>
                        <p class="card-text">Indirizzo: {{$apartment->street_name}}</p>
                        <p class="card-text">Numero civico: {{$apartment->street_number}}</p>
                        <p class="card-text">Codice postale: {{$apartment->postal_code}}</p>
                        <legend>Info sull'appartamento</legend>
                        <p class="card-text">Numero di stanze: {{$apartment->room}}</p>
                        <p class="card-text">Numero di bagni: {{$apartment->bathroom}}</p>
                        <p class="card-text">Stanze da letto: {{$apartment->bedroom}}</p>
                        <p class="card-text">Numeri di letto: {{$apartment->bed}}</p>
                        <p class="card-text">Metri quadrati: {{$apartment->mq}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection