@extends('layouts.user_app')
@section('title', "Email")

@section('content')
    <div class="container">
        <div class="row">
            <div class="card-deck">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Email mandata da: {{$email->name}}</h5>
                        <h6 class="card-title">Indirizzo {{$email->email_address}}</h6>
                        <h6 class="card-title">Oggetto {{$email->subject}}</h6>
                        <p class="card-title">{{$email->message}}</p>
                        
                
                        <p class="card-text"><small class="text-muted">Data: {{$email->created_at}}</small></p>
                        <form method="POST" action="{{route('user.emails.destroy', $email)}}" class="delete-form" data-email-id="{{$email->id}}" data-email-title="{{$email->subject}}">
                            @csrf
                            @method('DELETE')
                            {{-- BOTTONE CHE RICHIAMA UN 'POPUP' PER CONFERMARE DI VOLER ELIMINARE L'APPARTAMENTO  --}}
                            <input type="submit" value="Delete" onclick="return confirm('Sei sicura/o di voler eliminare questa email?');">
                        </form>
                    </div>
                </div>
            </div>
            <a href="{{route("user.emails.index")}}">Torna indietro</a>
        </div>
    </div>
@endsection