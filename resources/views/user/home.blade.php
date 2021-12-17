@extends('layouts.user_app')
@section('title', "Dashboard")

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            Benvenuto {{Auth::user()->email}}
                        </div>
                    </div>
                  </div>
            </div>
        </div>
        <a href="{{route('user.apartments.index')}}">I tuoi appartamenti</a>
        <a href="{{route('user.emails.index')}}">I tuoi messaggi</a>
    </div>

@endsection

@section('page-title')
    Dashboard
@endsection
