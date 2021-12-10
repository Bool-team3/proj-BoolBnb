@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        {{-- <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div> --}}
    </div>
    <a href="{{route('user.apartments.index')}}">I tuoi appartamenti</a>
    <a href="{{route('user.emails.index')}}">I tuoi messaggi</a>
</div>

@endsection

@section('page-title')
    Dashboard
@endsection
