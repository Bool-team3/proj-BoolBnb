@extends('layouts.app')
@section('content')

    <div class="flex-center position-ref full-height">
        @if (session('message-success'))
            <div class="alert alert-success">
                {{ session('message-success') }}
                <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times"></i></button>
            </div>
        @endif

        <div id="root"></div>
    </div>
    <script src="{{asset('js/front.js')}}"></script>

@endsection
@section('page-title', 'Home')
