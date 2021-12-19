@extends('layouts.user_app')

@section('content')

    <section id="apartment_form">
        <a href="{{route('user.apartments.index')}}" class="back-to-home" title="Torna indietro">
            <i class="fas fa-long-arrow-alt-left fa-4x"></i>
        </a>
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
        @if (session('error'))
            <div class="alert alert-warning">
                {{ session('error') }}
            </div>
        @endif
        <div class="card-body p-5">
            <h2>Modifica appartamento</h2>
            <form action="{{ $request->routeIs('user.apartments.edit') ? 
            route('user.apartments.update', $apartment) : route('user.apartments.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @if($request->routeIs('user.apartments.edit'))
                    @method('PATCH')
                @endif
                <div class="row">

                    <div class="col-12 col-lg-6">
                        <div class="form-group w-50">
                            {{-- aggiungere upload file --}}
                            <label for="img_url">
                                <img class="img-fluid" src="{{ $apartment->img_url ? $apartment->getImagePrefix() . $apartment->img_url : 'https://www.pianetacasafacile.it/uploads/cache/profile_mid/uploads/property_images/2018/01/property_no_photo.png' }}">
                            </label>
                            <input type="file" id="img_url" name="img_url" value="{{ old('img_url', $apartment->img_url) }}">
                        </div>
        
                        <div class="form-group w-50">
                            <label for="title">Inserisci un nome all'appartamento</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $apartment->title) }}">
                        </div>
        
                        <div class="form-group w-50">
                            <label for="room">Stanze totali dell'appartamento:</label>
                            <input type="number" class="form-control" min="1" id="room" name="room" value="{{ old('room', $apartment->room) }}">
                        </div>
        
                        <div class="form-group w-50">
                            <label for="bedroom">Letti:</label>
                            <input type="number" class="form-control" min="0"  id="bedroom" name="bedroom" value="{{ old('bedroom', $apartment->bedroom) }}">
                        </div>
        
                        <div class="form-group w-50">
                            <label for="bathroom">Bagni:</label>
                            <input type="number" class="form-control" min="0" id="bathroom" name="bathroom" value="{{ old('bathroom', $apartment->bathroom) }}">
                        </div>
        
                        <div class="form-group w-50">
                            <label for="bed">Stanze da letto:</label>
                            <input type="number" class="form-control" min="0" id="bed" name="bed" value="{{ old('bed', $apartment->bed) }}">
                        </div>
        
                        <div class="form-group w-50">
                            <label for="mq">Metri quadri:</label>
                            <input type="number" class="form-control" min="10" id="mq" name="mq" value="{{ old('mq', $apartment->mq) }}">
                        </div>
                    </div>
    
                    <div class="col-12 col-lg-6">
                        {{-- sezione visibilità appartamento  --}}
                        <div id="radio-button-custom">
                            <legend>Visibilità:</legend>
                            <fieldset class="radio-switch">
                                <div class="radio-switch__inner">
                                    <input type="radio" id="visible_true" name="visible" value=1 @if(old('visible', $apartment->visible)) checked @endif>
                                    <label for="visible_true" >SI</label>
                                
                                    <input type="radio"  id="visible_false" name="visible" value=0 @if(!old('visible', $apartment->visible)) checked @endif>
                                    <label for="visible_false">No</label>
                                </div>
                            </fieldset>
                        </div>

                        <div class="form-group w-50">
                            <label for="city">Città:</label>
                            <input type="text" class="form-control" id="city" name="city" value="{{ old('city', $apartment->city) }}">
                        </div>
                    
                        <div class="form-group w-50">
                            <label for="street_name">Indirizzo:</label>
                            <input type="text" class="form-control" id="street_name" name="street_name" value="{{ old('city', $apartment->street_name) }}">
                        </div>
                        
                        <div class="form-group w-50">
                            <label for="street_number">Numero civico:</label>
                            <input type="text" class="form-control" min="0" id="street_number" name="street_number" value="{{ old('street_number', $apartment->street_number) }}">
                        </div>
                        
                        <div class="form-group w-50">
                            <label for="province">Provincia:</label>
                            <input type="text" class="form-control" id="province" name="province" value="{{ old('province', $apartment->province) }}">
                        </div>
        
                        <div class="form-group w-50">
                            <label for="postal_code">Codice Postale: </label>
                            <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{ old('postal_code', $apartment->postal_code) }}">
                        </div>
                        
                        {{-- form per Services --}}
                        <div class="form-check">
                            <legend class="h5">Servizi</legend>
                            @foreach ($services as $service)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{$service->id}}" id="service-{{$service->id}}" name="services[]" 
                                        @if(in_array($service->id, old('services', $serviceIds ? $serviceIds : []))) checked @endif>
                                    <label class="form-check-label" for="service-{{$service->id}}">{{$service->name}}</label>
                                </div>
                            @endforeach
                        </div>
                        
                    </div>
                </div>
                <button class="btn" id="myBtn" type="submit">Salva</button>
            </form>
        </div>

    </section>
@endsection
