@extends('layouts.app')
@section('content')

    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
            <div class="top-right links">
                @auth
                    <a href="{{ route('user.home') }}">Home</a>
                {{-- @else
                    <a href="{{ route('login') }}">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif --}}
                @endauth
            </div>
        @endif
        @if (session('message-success'))
            <div class="alert alert-success">
                {{ session('message-success') }}
                <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times"></i></button>
            </div>
        @endif
        <div id="root">
            
        </div>
    </div>
    <script src="{{asset('js/front.js')}}"></script>

@endsection
