@extends('layouts.user_app')
@section('title', "Dashboard")

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card m-5">
                    <div class="card-body">
                        <div class="card-title">
                            <h1>Benvenuto '{{Auth::user()->name}}'</h1>
                            <legend>Info Utente</legend>
                            <h5 class="card-text">Email: {{Auth::user()->email}}</h5>
                            <h5 class="card-text">Cognome: {{Auth::user()->surname}}</h5>
                            <h5 class="card-text">Nome: {{Auth::user()->name}}</h5>
                            <h5 class="card-text">Numero di telefono: {{Auth::user()->telephone}}</h5>
                            <h5 class="card-text">Città: {{Auth::user()->country}}</h5>
                            <h5 class="card-text">Data di nascita: {{Auth::user()->date_of_birth}}</h5>
                        </div>
                    </div>
                </div>
                <form method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{Auth::user()->name}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="email-address">Email address</label>
                        <input type="email" class="form-control" name="email_address" id="email-address" value="{{Auth::user()->email}}" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label for="telephone">Numero di telefono</label>
                        <input type="number" class="form-control" name="telephone" id="telephone" placeholder="Inserisci numero di telefono">
                    </div>
                    <div class="form-group">
                        <label for="country">Paese</label>
                        <input type="text" class="form-control" name="country" id="country" placeholder="Inserisci il paese">
                    </div>
                    <div class="form-group">
                        <label for="date_of_birth">Data di nascita</label>
                        <input type="date" class="form-control" name="date_of_birth" id="date_of_birth" placeholder="Inserisci la tua data di nascita">
                    </div>
                    <button class="btn btn-primary" type="submit">Invia</button>
                </form>
            </div>
        </div>
    </div>

@endsection
