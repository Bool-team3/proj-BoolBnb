@extends('layouts.app')
@section('content')

        <div class="flex-center position-ref full-height">
            
            @if (Route::has('login'))
                    @auth
                        <a href="{{ route('user.home') }}">Home</a>
                    @endauth
                </div>
            @endif

            <div id="root">
               
            </div>
        </div>
        <script src="{{asset('js/front.js')}}"></script>
@endsection
