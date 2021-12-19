@extends('layouts.user_app')
@section('title', "Email")

@section('content')

<div class="container">
    {{-- AVVISO IN CASO DI ELIMINAZIONE AVVENUTA CON SUCCESSO  --}}
    @if(session('delete'))
        <div class="alert alert-success" role="alert">
            {{session('delete') }} è stato eliminato con successo!
            <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times"></i></button>
        </div>
    @endif

    {{-- box di conferma --}}
    <div id="confirm" class="d-none">
        <div class="display-overlay"></div>
        <div class="box-confirm text-center p-3">
            <div>
                <div class="mb-3">
                    <h3>
                        Sei sicuro?
                    </h3>
                    <h6>
                        Vuoi davvero cancellare il messaggio. <br>
                        Una volta cancellato non potrai tornare indietro
                    </h6>
                </div>
                <form class="formConfirm" method="GET" class="p-2">
                    <input value="Cancella" class="btn btn-danger myBtn-confirm" type="button">
                    <input value="Annulla" id="myBtn" class="btn btn-info myBtn-confirm" type="button">
                </form>
            </div>
        </div>
    </div>

    
    <div class="row">
        <div class="col-12">
            <h2>I tuoi messaggi</h2>
            @if ($allEmail == 1)
                <h4>Hai {{$allEmail}} messaggio</h4>
            @else
                <h4>Hai {{$allEmail}} messaggi in totale</h4>
            @endif
            {{-- filtro per email --}}
            <form class="filtered-mex" action="{{ route('user.emails.index')}}" method="GET" enctype="multipart/form-data">
                <legend>Filtra messaggi per appartamenti</legend>
                <label for="apartments">Appartamento</label>

                <select name="apartments[]" id="apartments">
                    <option value="{{null}}">--</option>
                    @foreach ($apartments as $apartment)
                        <option value="{{$apartment->id}}">{{$apartment->title}}</option>
                    @endforeach
                </select>
                <button class="btn" id="myBtn" type="submit">Invia</button>
            </form>
            @forelse ($emails as $email)
                <div class="card-deck email w-75">
                    <div class="card">
                        <div class="d-flex">
                            <div class="card-body">
                                <h4 class="card-title">Appartamento: {{$email->apartment->title}}</h4>
                                {{-- <h5 class="card-title"><a class="stretched-link" href="{{route("user.emails.show", $email->id)}}">Oggetto: {{$email->subject}}</a></h5> --}}
                                <h6 class="card-title">Nome: {{$email->name}}</h6>
                                <h6 class="card-title">Indirizzo email: {{$email->email_address}}</h6>
                                <p class="card-text"><small class="text-muted">Ricevuta il:{{$email->created_at}}</small></p>

                                {{-- FORM PER ELIMINARE UN APPARTAMENTO  --}}
                                <form class="delete-mex" method="POST" action="{{route('user.emails.destroy', $email)}}" data-email-id="{{$email->id}}" data-email-subject="{{$email->subject}}">
                                @csrf
                                @method('DELETE') 
                                    {{-- BOTTONE CHE RICHIAMA UN 'POPUP' PER CONFERMARE DI VOLER ELIMINARE L'APPARTAMENTO  --}}
                                    <button class="btn btn-danger" title="Elimina">
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
    <script>

        const deleteConfirm = document.querySelectorAll('.delete-mex');
        deleteConfirm.forEach(element => {

            element.addEventListener("submit", function(event){
                //stoppa l'evento
                event.preventDefault();

                //apre il box di conferma
                let confirm = document.querySelector('#confirm');
                confirm.classList.remove("d-none");

                //prende il valore dei bottoni del box di conferma
                const formConfirm = document.querySelector('.formConfirm');

                formConfirm.elements[0].addEventListener("click", function(){
                    element.submit();
                    confirm.classList.add("d-none");
                })

                formConfirm.elements[1].addEventListener("click", function(){
                    confirm.classList.add("d-none");
                })
                
            });

        });
    </script>
</div>


@endsection