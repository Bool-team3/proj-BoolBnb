@extends('layouts.app')

@section('content')
    
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>I tuoi appartamenti</h2>
                <a href="{{route('user.apartments.create')}}">Carica un nuovo appartamento</a>
                @forelse ($apartments as $apartment)
                    <div class="card-deck">
                        <div class="card">
                            <div class="d-flex">
                                <img class="card-img-top img-fluid" style="width:300px" src="{{$apartment->img_url}}" alt="Appartamento">

                                <div class="card-body">
                                    <h5 class="card-title"><a href="{{route("user.apartments.show", $apartment->id)}}">{{$apartment->title}}</a></h5>
                                    <h6 class="card-title">Stanze: {{$apartment->room}}</h6>
                                    <h6 class="card-title">Stanze da letto: {{$apartment->bedroom}}</h6>
                                    <h6 class="card-title">Posti letto: {{$apartment->bed}}</h6>
                                    <h6 class="card-title">Bagni: {{$apartment->bathroom}}</h6>
                                    <h6 class="card-title">Metri quadrati: {{$apartment->mq}}</h6>
                                    <p class="card-text">Città: {{$apartment->city}}</p>
                                    <p class="card-text"><small class="text-muted">Last updated {{$apartment->created_at}} ago</small></p>
                                    <a href="{{route('user.apartments.edit', $apartment)}}">Modifica Informazioni</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <h4>Non hai appartamenti, carica un appartamento</h4>
                    <a href="{{route("user.apartments.create")}}">Crea appartamento</a>
                @endforelse
            </div>
        </div>
    </div>
@endsection