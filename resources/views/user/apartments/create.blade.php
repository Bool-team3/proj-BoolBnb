
@extends('layouts.app')

@section('content')


<section id="apartment_form">

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>        
    @endif

    @if (session('error'))
        <div class="alert alert-warning">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{route('user.apartments.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="title">Inserisci un titolo</label>
        <input type="text" id="title" name="title" value="{{ old('title', $apartment->title) }}">
        
        <label for="room">Stanze:</label>
        <input type="number" min="1" id="room" name="room" value="{{ old('room', $apartment->room) }}">

        <label for="bedroom">Letti:</label>
        <input type="number" min="0"  id="bedroom" name="bedroom" value="{{ old('bedroom', $apartment->bedroom) }}">

        <label for="bathroom">Bagni:</label>
        <input type="number" min="0" id="bathroom" name="bathroom" value="{{ old('bathroom', $apartment->bathroom) }}">

        <label for="bed">Posti letto:</label>
        <input type="number" min="0" id="bed" name="bed" value="{{ old('bed', $apartment->bed) }}">

        <label for="mq">Metri quadri:</label>
        <input type="number" min="10" id="mq" name="mq" value="{{ old('mq', $apartment->mq) }}">
        {{-- aggiungere upload file --}}
        <label for="img_url">Inserisci foto:</label>
        <input type="file" id="img" name="img" value="{{ old('img', $apartment->img_url) }}">
        
        {{-- sezione visibilità appartamento  --}}
        <label for="visible">L'appartamento sarà:</label>

        <input type="radio" id="visible_true" name="visible" value=1>
        <label for="visible_true">Visibile</label>
        
        <input type="radio"  id="visible_false" name="visible" value=0>
        <label for="visible_false">NON Visibile</label>
    
        <label for="city">Città:</label>
        <input type="text" id="city" name="city" value="{{ old('city', $apartment->city) }}">

        <label for="street_name">Indirizzo:</label>
        <input type="text" id="street_name" name="street_name" value="{{ old('city', $apartment->street_name) }}">

        <label for="street_number">Numero civico:</label>
        <input type="text" min="0" id="street_number" name="street_number" value="{{ old('street_number', $apartment->street_number) }}">

        <label for="province">Provincia:</label>
        <input type="text" id="province" name="province" value="{{ old('province', $apartment->province) }}">

        <label for="postal_code">C.A.P:</label>
        <input type="text" id="postal_code" name="postal_code" value="{{ old('postal_code', $apartment->postal_code) }}">

        
        {{-- form per Services --}}

        <div class="form-check form-check-inline">
            <legend class="h5">Servizi</legend>
            @foreach ($services as $service)
                <input type="checkbox" class="form-check-input" id="service-{{$service->id}}" value="{{$service->id}}" name="services[]">
                
                <label class="form-check-label px-2" for="service-{{$service->id}}">
                    {{$service->name}}
                </label>
            @endforeach
        </div>

        <button type="submit">Submit</button>
    </form>

</section>

@endsection



