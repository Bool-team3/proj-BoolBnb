@extends('layouts.user_app')
@section('title', "Email")

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="wrapper-mail">
                    <legend>{{$email->subject}}</legend>
                    <p>{{$email->message}}</p>
                    <br>
                    <p>da {{$email->name}}</p>

                    <div class="text-center">
                        <p class="card-text"><small class="text-muted">Inviata da 
                            {{$email->email_address}} il {{$email->created_at}}</small></p>

                        <p class="card-text">
                            <small class="text-muted">
                                Appartamento: 
                                <strong>{{$email->apartment->title}}</strong>
                            </small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{route('user.emails.index')}}" class="back-to-home" title="Torna indietro">
            <i class="fas fa-long-arrow-alt-left fa-4x"></i>
        </a>
    </div>
@endsection