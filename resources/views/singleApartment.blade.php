@extends('layouts.app')
@section('title', 'Home - Show')

@section('content')   
    <div id="prova"></div>
    {{-- error catch --}}
    @if ($errors->any())
    <div class="alert alert-danger error-message">
        <ul>
            @foreach ($errors->all() as $error)
            <div class="d-flex align-items-center mb-2">
                <i class="fas fa-exclamation-triangle"></i><li>{{ $error }}</li>
            </div>
            @endforeach
        </ul>
    </div>        
    @endif
    
    <section id="send-email" class="mb-3">
        <div class="container">
            <h3>Contattaci</h3>
            <form action="{{ route('email.store') }}" method="POST">
                @csrf
                <input type="hidden" name="apartment_id" value="{{$apartment->id}}"> 
                @guest
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}" placeholder="Inserisci il tuo nome">
                    </div>
                    <div class="form-group">
                        <label for="email-address">Email address</label>
                        <input type="email" class="form-control" name="email_address" id="email-address" value="{{old('email_address')}}" placeholder="nome@esempio.com">
                    </div>
                @else
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{Auth::user()->name}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="email-address">Email address</label>
                        <input type="email" class="form-control" name="email_address" id="email-address" value="{{Auth::user()->email}}" readonly>
                    </div>
                @endguest
                <div class="form-group">
                    <label for="subject">Oggetto della email</label>
                    <input type="text" class="form-control" name="subject" id="subject" placeholder="Inserisci l'oggetto della email" value="{{old('subject')}}">
                </div>
                <div class="form-group">
                    <label for="message">Messaggio</label>
                    <textarea class="form-control" name="message" id="message" rows="3" >{{old('message')}}</textarea>
                </div>
                <button class="btn btn-primary" type="submit">Invia</button>
            </form>
        </div>
    </section>
    <script src="{{asset('js/back.js')}}"></script>
@endsection
