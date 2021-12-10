@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <a href="{{route('user.home')}}">Torna alla dashboard</a>
            <h2>I tuoi messaggi</h2>
            <div class="card-deck">
                <div class="card">
                    <div class="d-flex">    
                        <div class="card-body">
                            @forelse ($emails as $email)
                                <h5 class="card-title"><a href="{{route("user.emails.show", $email->id)}}">{{$email->subject}}</a></h5>

                                <h6 class="card-title">Nome: {{$email->name}}</h6>
                                <h6 class="card-title">Indirizzo email: {{$email->email_address}}</h6>
                                <p class="card-text"><small class="text-muted">Ricevuta il:{{$email->created_at}} ago</small></p>

                                {{-- FORM PER ELIMINARE UN APPARTAMENTO  --}}
                                <form method="POST" action="{{route('user.emails.destroy', $email)}}" class="delete-form" data-email-id="{{$email->id}}" data-email-subject="{{$email->subject}}">
                                @csrf
                                @method('DELETE') 
                                    {{-- BOTTONE CHE RICHIAMA UN 'POPUP' PER CONFERMARE DI VOLER ELIMINARE L'APPARTAMENTO  --}}
                                    <input type="submit" value="Delete" onclick="return confirm('Sei sicura/o di voler eliminare questa email?');">
                                </form>
                            @empty
                                <div class="d-flex justify-content-center align-items-center">
                                    <h4>Non hai messaggi</h4>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection