@extends('layouts.user_app')
@section('title', "Appartamenti")

@section('content')
    
    <div class="container" id="index-apartment">
        {{-- AVVISO IN CASO DI ELIMINAZIONE AVVENUTA CON SUCCESSO  --}}
        @if(session('delete'))
            <div class="alert alert-success" role="alert">
                {{session('delete') }} è stato eliminato con successo!
                <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times"></i></button>
            </div>
        @endif

        <div id="confirm" class="d-none">
            <div class="display-overlay"></div>
            <div class="box-confirm text-center p-3">
                <div>
                    <div class="mb-3">
                        <div class="circle">
                            <div class="line"></div>
                            <div class="dot"></div>
                        </div>
                        <h3>
                            Sei sicuro?
                        </h3>
                        <h6>
                            Vuoi davvero cancellare l'appartamento? <br>
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
            <div class="col-12 p-3">
                <h2 class="mb-3">I tuoi appartamenti</h2>
                <h4>Appartamenti totali: {{count($apartments)}}</h4>
                <a href="{{route('user.apartments.create')}}">
                    <img id="add-house" src="{{ asset('storage/public/add.png') }}" alt="add house">
                    Carica un nuovo appartamento
                </a>
                @forelse ($apartments as $apartment)
                    <div class="card w-75 mb-2">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5 class="card-title"><strong>Appartamento: </strong>{{$apartment->title}}</h5>

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
                                    </p>
                        
                                    <p class="card-text"><small class="text-muted">Ultima modifica: {{$apartment->created_at}}</small></p>
                                    <a type="button" class="btn btn-outline-info" href="{{route("user.apartments.show", $apartment->id)}}">Apri appartamento</a>
                                </div>

                                <div class="edit-delete-sponsor"> 
                                    <div class="d-flex">
                                        <div class="mr-3">
                                            <a href="{{route('user.apartments.edit', $apartment)}}">
                                                <i class="fas fa-edit btn btn-primary"  title="Modifica"></i>
                                            </a>
                                        </div>     
                                        <div>
                                            <form method="POST" action="{{route('user.apartments.destroy', $apartment)}}" class="delete-appartment" data-apartment-id="{{$apartment->id}}" data-apartment-title="{{$apartment->title}}">
                                                @csrf
                                                @method('DELETE')
                                                {{-- BOTTONE CHE RICHIAMA UN 'POPUP' PER CONFERMARE DI VOLER ELIMINARE L'APPARTAMENTO  --}}
                                                <button class="btn btn-danger" title="Elimina">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                <div>
                                @if ($apartment->sponsors()->exists('sponsor_id'))
                                    @foreach ($apartment->sponsors as $sponsor)
                                        <span class="d-none">{{$myID = $sponsor->pivot->sponsor_id}}</span>
                                        @switch($myID)
                                            @case(1)
                                            <img src="{{ asset('storage/public/sponsor/basic.png') }}" alt="basic sponsor"> 
                                                @break
                                            @case(2)
                                                <img src="{{ asset('storage/public/sponsor/premium.png') }}" alt="premium sponsor">  
                                                @break
                                            @case(3)
                                            <img src="{{ asset('storage/public/sponsor/business.png') }}" alt="business sponsor"> 
                                                @break
                                            @default
                                        @endswitch         
                                    @endforeach
                                @else
                                    <a class="btn btn-primary" id="myBtn" href=" {{ route('user.sponsors.show', $apartment) }} ">Sponsorizza</a>            
                                @endif
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                @empty
                    <h4>Non hai appartamenti, carica un appartamento</h4>
                @endforelse
            </div>
        </div>
        {{ $apartments->links() }}

        <script>
            
            const deleteConfirm = document.querySelectorAll('.delete-appartment');
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

