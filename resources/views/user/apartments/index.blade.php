@extends('layouts.user_app')
@section('title', "Appartamenti")

@section('content')
    
    <div class="container">
        {{-- AVVISO IN CASO DI ELIMINAZIONE AVVENUTA CON SUCCESSO  --}}
        @if(session('delete'))
            <div class="alert alert-success" role="alert">
                {{session('delete') }} è stato eliminato con successo!
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <h2>I tuoi appartamenti</h2>
                <a href="{{route('user.apartments.create')}}">Carica un nuovo appartamento</a>
                @forelse ($apartments as $apartment)
                    <div class="card-deck">
                        <div class="card">
                            <div class="d-flex">
                                <img class="card-img-top img-fluid" style="width:300px" src="{{ $apartment->img_url ? $apartment->getImagePrefix() . $apartment->img_url : 'https://www.pianetacasafacile.it/uploads/cache/profile_mid/uploads/property_images/2018/01/property_no_photo.png' }}" alt="Appartamento">

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
                                    {{-- FORM PER ELIMINARE UN APPARTAMENTO  --}}
                                    <form method="POST" action="{{route('user.apartments.destroy', $apartment)}}" class="delete-form" data-apartment-id="{{$apartment->id}}" data-apartment-title="{{$apartment->title}}">
                                        @csrf
                                        @method('DELETE')
                                        {{-- BOTTONE CHE RICHIAMA UN 'POPUP' PER CONFERMARE DI VOLER ELIMINARE L'APPARTAMENTO  --}}
                                        <input type="submit" value="Delete" onclick="return confirm('Sei sicura/o di voler eliminare questo appartamento?');">
                                    </form> 
                                </div>
                                @if ($apartment->sponsors()->exists('sponsor_id'))
                                    @foreach ($apartment->sponsors as $sponsor)
                                        <span class="d-none">{{$myID = $sponsor->pivot->sponsor_id}} </span>
                                        @switch($myID)
                                            @case(1)
                                                <img src="https://banner2.cleanpng.com/20180701/czu/kisspng-sponsor-bronze-business-organization-silver-5b39330112f541.7032012215304752650777.jpg" class="img-fluid" alt=""  style="width: 200px; height: 200px;">
                                                @break
                                            @case(2)
                                                <img src="https://img.favpng.com/1/7/8/medal-gold-sponsor-logo-silver-png-favpng-MV15xaYwJQ3wQrK6fWu5FPHFF.jpg" class="img-fluid" alt="" style="width: 200px; height: 200px;">  
                                                @break
                                            @case(3)
                                                <img src="https://agredfoundation.com/assets/uploads/2020/10/Gold-Sponsor.png"  class="img-fluid" alt="" style="width: 200px; height: 200px;">
                                                @break
                                            @default
                                        @endswitch         
                                    @endforeach
                                @else
                                    <a class="btn" href=" {{ route('user.sponsors.show', $apartment) }} ">Sponsorizza</a>            
                                @endif                                              
                            </div>
                        </div>
                    </div>
                @empty
                    <h4>Non hai appartamenti, carica un appartamento</h4>
                @endforelse
            </div>
        </div>
    </div>
@endsection

@section('page-title')
    Apartments
@endsection