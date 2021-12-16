@extends('layouts.app')

@section('content')   
    <div id="prova">
        
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h4>Invia un messaggio</h4>
                <form action={{'user.emails.store'}} method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    @guest
                        
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nome</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Inserisci il tuo nome">
                        </div>
                        <div class="form-group">
                        <label for="exampleFormControlInput1">Email address</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="nome@esempio.com">
                        </div>
                    @else
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nome</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" value="{{Auth::user()->name}}" readonly>
                        </div>
                        <div class="form-group">
                        <label for="exampleFormControlInput1">Email address</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1" value="{{Auth::user()->email}}" readonly>
                        </div>
                    @endguest

                    <div class="form-group">
                        <label for="exampleFormControlInput1">Oggetto della email</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Inserisci l'oggetto della email">
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlTextarea1">Example textarea</label>
                      <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <button class="btn btn-primary" type="submit">Invia</button>
                  </form>
            </div>
        </div>
    </div>

    <script src="{{asset('js/back.js')}}"></script>
@endsection