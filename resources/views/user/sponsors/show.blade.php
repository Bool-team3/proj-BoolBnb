@extends('layouts.app')

@section('content')
    
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>I nostri sponsor:</h2>
                <a href="{{route('user.apartments.index')}}">Torna ai tuoi appartamenti</a>
                
                <div class="d-flex">
                    @forelse ($sponsors as $sponsor)
                    
                        <form action="{{ route('user.sponsors.store') }}"  method="POST">
                            @csrf

                            <div class="card" style="width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title" > {{ $sponsor->name }} </h5>
                                    <h6 class="card-title"> Prezzo: {{ $sponsor->price }} &euro; </h6>
                                    <input class="d-none" type="text" name="sponsor_id" value="{{ $sponsor->id }}" readonly >
                                    <input class="d-none" type="text" name="apartment_id" value="{{ $id }}" readonly >
                                    <h6 class="card-title"> Durata: {{ $sponsor->time }} giorni </h6>
                                    <button type="submit" class="btn btn-primary" >Compra</button>
                                </div>
                            </div>
                            
                        </form>
                        
                    @empty
                        <h6>Non ci sono sponsor disponibili.</h6>
                    @endforelse
                </div>
                    
                
            </div>
        </div>
    </div>
@endsection