@extends('layouts.user_app')
@section('title', "Modifica")

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
    <div class="card-body">

        <form action="{{route('user.apartments.update', $apartment)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group row">

                <label for="title" class="col-md-1 col-form-label ">Inserisci un titolo</label>
                <input type="text" id="title" name="title" value="{{ old('title', $apartment->title) }}">
            </div>
            <div class="form-group row">
                <label for="room" class="col-md-1 col-form-label ">Stanze:</label>
                <input type="number" min="1" id="room" name="room" value="{{ old('room', $apartment->room) }}">
            </div>
            <div class="form-group row">
                <label for="bedroom" class="col-md-1 col-form-label ">Letti:</label>
                <input type="number" min="0"  id="bedroom" name="bedroom" value="{{ old('bedroom', $apartment->bedroom) }}">
            </div>

            <div class="form-group row">
                <label for="bathroom" class="col-md-1 col-form-label ">Bagni:</label>
                <input type="number" min="0" id="bathroom" name="bathroom" value="{{ old('bathroom', $apartment->bathroom) }}">
            </div>

            <div class="form-group row">
                <label for="bed" class="col-md-1 col-form-label ">Posti letto:</label>
                <input type="number" min="0" id="bed" name="bed" value="{{ old('bed', $apartment->bed) }}">
            </div>

            <div class="form-group row">
                <label for="mq" class="col-md-1 col-form-label ">Metri quadri:</label>
                <input type="number" min="10" id="mq" name="mq" value="{{ old('mq', $apartment->mq) }}">
            </div>
            <div class="form-group row">
                {{-- aggiungere upload file --}}
                <label for="img_url" class="col-md-1 col-form-label ">Inserisci foto</label>
                <input type="file" id="img_url" name="img_url" value="{{ old('img_url', $apartment->img_url) }}">
            </div>

            <div class="form-group row">
                {{-- sezione visibilità appartamento  --}}
                <label for="visible" class="col-md-1">L'appartamento sarà:</label>
                <div>
                    <input type="radio" id="visible_true" name="visible" value=1 @if(old('visible', $apartment->visible)) checked @endif >
                    <label for="visible_true" >Visibile</label>
                
                    <input type="radio"  id="visible_false" name="visible" value=0 @if(!old('visible', $apartment->visible)) checked @endif >
                    <label for="visible_false">NON Visibile</label>
                </div>
            </div>
            <div class="form-group row">
                <label for="city" class="col-md-1 col-form-label ">Città:</label>
                <input type="text" id="city" name="city" value="{{ old('city', $apartment->city) }}">
            </div>
        
            <div class="form-group row">
                <label for="street_name" class="col-md-1 col-form-label ">Indirizzo:</label>
                <input type="text" id="street_name" name="street_name" value="{{ old('city', $apartment->street_name) }}">
            </div>
            
            <div class="form-group row">
                <label for="street_number" class="col-md-1 col-form-label ">Numero civico:</label>
                <input type="text" min="0" id="street_number" name="street_number" value="{{ old('street_number', $apartment->street_number) }}">
            </div>
            
            <div class="form-group row">
                <label for="province" class="col-md-1 col-form-label ">Provincia:</label>
                <input type="text" id="province" name="province" value="{{ old('province', $apartment->province) }}">
            </div>

            <div class="form-group row">
                <label for="postal_code" class="col-md-1 col-form-label ">C.A.P:</label>
                <input type="text" id="postal_code" name="postal_code" value="{{ old('postal_code', $apartment->postal_code) }}">
            </div>
            
            {{-- form per Services --}}

            <div class="form-check ">
                <legend class="h5">Servizi</legend>
                @foreach ($services as $service)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{$service->id}}" id="tag-{{$service->id}}" name="services[]" 
                            @if(in_array($service->id, old('services', $serviceIds ? $serviceIds : []))) checked @endif>
                        <label class="form-check-label" for="service-{{$service->id}}">{{$service->name}}</label>
                    </div>
                @endforeach
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>

</section>

@endsection

@section('page-title')
    Edit
@endsection

