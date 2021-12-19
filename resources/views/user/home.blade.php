@extends('layouts.user_app')
@section('title', "Dashboard")

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <div class="card mt-5">
                    <div class="card-body">
                        <div class="card-title">
                            <h1>Benvenuto '{{Auth::user()->name}}'</h1>
                            <legend>Info Utente</legend>
                            <h5 class="card-text">Email: {{Auth::user()->email}}</h5>
                            <h5 class="card-text">Cognome: {{Auth::user()->surname}}</h5>
                            <h5 class="card-text">Nome: {{Auth::user()->name}}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
