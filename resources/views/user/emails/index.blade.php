@extends('layouts.user_app')
@section('title', "Email")

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
            <h2>I tuoi messaggi</h2>
            <h4>Hai {{$allEmail}} messaggi in totale</h4>

            {{-- filtro per email --}}
            <form action="{{ route('user.emails.index')}}" method="GET" enctype="multipart/form-data">
            @csrf
                <legend>Filtra messaggi per appartamenti</legend>
                <label for="apartments">Appartamento</label>

                <select name="apartments[]" id="apartments">
                    <option value="{{null}}">--</option>
                    @foreach ($apartments as $apartment)
                        <option value="{{$apartment->id}}">{{$apartment->title}}</option>
                    @endforeach
                </select>
                <button class="btn btn-outline-primary" type="submit">Invia</button>
            </form>
            @forelse ($emails as $email)
                <div class="card-deck email">
                    <div class="card">
                        <div class="d-flex">
                            <div class="card-body">
                                <h4 class="card-title">Appartamento: {{$allApp[($email->apartment_id) - 2]->title}}</h4>
                                <h5 class="card-title"><a class="stretched-link" href="{{route("user.emails.show", $email->id)}}">Oggetto: {{$email->subject}}</a></h5>

                                <h6 class="card-title">Nome: {{$email->name}}</h6>
                                <h6 class="card-title">Indirizzo email: {{$email->email_address}}</h6>
                                <p class="card-text"><small class="text-muted">Ricevuta il:{{$email->created_at}}</small></p>

                                {{-- FORM PER ELIMINARE UN APPARTAMENTO  --}}
                                <form method="POST" action="{{route('user.emails.destroy', $email)}}" class="delete-form" data-email-id="{{$email->id}}" data-email-subject="{{$email->subject}}">
                                @csrf
                                @method('DELETE') 
                                    {{-- BOTTONE CHE RICHIAMA UN 'POPUP' PER CONFERMARE DI VOLER ELIMINARE L'APPARTAMENTO  --}}
                                    <button class="btn btn-danger" onclick="return confirm('Sei sicura/o di voler eliminare questo appartamento?')" title="Elimina">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <h4>Non hai messaggi</h4>
            @endforelse
        </div>
        {{ $emails->links() }}
    </div>
</div>


@endsection