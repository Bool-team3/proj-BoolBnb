@extends('layouts.app')

@section('content')   
    <div id="prova"></div>
    
    <section id="send-email">
        <div class="container">
            <form action="{{ route('email.store') }}" method="POST">
                @csrf
                <input type="hidden" name="apartment_id" value="{{$apartment->id}}"> 
                @guest
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Inserisci il tuo nome">
                    </div>
                    <div class="form-group">
                        <label for="email-address">Email address</label>
                        <input type="email" class="form-control" name="email_address" id="email-address" placeholder="nome@esempio.com">
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
                    <input type="text" class="form-control" name="subject" id="subject" placeholder="Inserisci l'oggetto della email">
                </div>
                <div class="form-group">
                    <label for="message">Messaggio</label>
                    <textarea class="form-control" name="message" id="message" rows="3"></textarea>
                </div>
                <button class="btn btn-primary" type="submit">Invia</button>
            </form>
        </div>
    </section>
    <script src="{{asset('js/back.js')}}"></script>
@endsection

@section('page-title', 'Home - Show')