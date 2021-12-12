@extends('layouts.user_app')
@section('title', "Appartamenti")
    
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="card-deck">
                <div class="card">
                    <img class="card-img-top img-fluid" style="width:300px" src="{{ $apartment->img_url ? $apartment->getImagePrefix() . $apartment->img_url : 'https://www.pianetacasafacile.it/uploads/cache/profile_mid/uploads/property_images/2018/01/property_no_photo.png' }}" alt="Appartamento">
                    <div class="card-body">
                        <h5 class="card-title">{{$apartment->title}}</h5>
                        <h6 class="card-title">Stanze: {{$apartment->room}}</h6>
                        <h6 class="card-title">Stanze da letto: {{$apartment->bedroom}}</h6>
                        <h6 class="card-title">Posti letto: {{$apartment->bed}}</h6>
                        <h6 class="card-title">Bagni: {{$apartment->bathroom}}</h6>
                        <h6 class="card-title">Metri quadrati: {{$apartment->mq}}</h6>
                        <p class="card-text">Città: {{$apartment->city}}</p>
                        <legend>Servizi:</legend>
                        <ul>
                            @forelse ($apartment->services as $service)
                                <li>{{$service->name}}</li>
                            @empty
                                nessun servizio aggiuntivo
                            @endforelse
                        </ul>
                        <p class="card-text"><small class="text-muted">Last updated {{$apartment->created_at}} ago</small></p>
                        <a href="{{route('user.apartments.edit', $apartment)}}">Modifica Informazioni</a>
                        <form method="POST" action="{{route('user.apartments.destroy', $apartment)}}" class="delete-form" data-apartment-id="{{$apartment->id}}" data-apartment-title="{{$apartment->title}}">
                            @csrf
                            @method('DELETE')
                            {{-- BOTTONE CHE RICHIAMA UN 'POPUP' PER CONFERMARE DI VOLER ELIMINARE L'APPARTAMENTO  --}}
                            <input type="submit" value="Delete" onclick="return confirm('Sei sicura/o di voler eliminare questo appartamento?');">
                        </form>
                    </div>
                </div>
            </div>
            <a href="{{route("user.apartments.index")}}">Torna indietro</a>
        </div>
    </div>
@endsection

@section('page-title')
    Show
@endsection