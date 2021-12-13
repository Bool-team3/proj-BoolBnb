@extends('layouts.app')
@section('content')

        <div class="flex-center position-ref full-height">
            @if(Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ route('user.home') }}">Dashboard</a>
                    @endauth
                </div>
            @endif
            {{-- @if (Route::has('login'))
                    @auth
                        <a href="{{ route('user.home') }}">Home</a>
                    {{-- @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif --}}
                    @endauth
                </div>
            @endif --}}

            <div id="root">
               
            </div>
        </div>
        <script src="{{asset('js/front.js')}}"></script>
@endsection
