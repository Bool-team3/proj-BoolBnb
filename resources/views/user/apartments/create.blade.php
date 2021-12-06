
@extends('layouts.app')

@section('content')

    <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="title">Inserisci un titolo</label>
        <input type="text" id="title" name="title" value="{{ old('title', $apartment->title) }}">
        
        <label for="room">Inserisci il numero di stanze</label>
        <input type="number" min="0" id="room" name="room" value="{{ old('room', $apartment->room) }}">

        <label for="bedroom">Inserisci il numero di stanze</label>
        <input type="number" min="0"  id="bedroom" name="bedroom" value="{{ old('bedroom', $apartment->bedroom) }}">

        <label for="bathroom">Inserisci il numero di stanze</label>
        <input type="number" min="0" id="bathroom" name="bathroom" value="{{ old('bathroom', $apartment->bathroom) }}">

        <label for="bed">Inserisci il numero di stanze</label>
        <input type="number" min="0" id="bed" name="bed" value="{{ old('bed', $apartment->bed) }}">

        <label for="mq">Inserisci il numero di stanze</label>
        <input type="number" min="10" id="mq" name="mq" value="{{ old('mq', $apartment->mq) }}">
        {{-- aggiungere upload file --}}
        <label for="img_url">Inserisci il numero di stanze</label>
        <input type="url" min="10" id="img_url" name="img_url" value="{{ old('img_url', $apartment->img_url) }}">
        
        {{-- sezione visibilità appartamento  --}}
        
        <input type="radio" id="visible_true" name="visible" value="true">
        <label for="visible_true">Visibile</label>
        
        <input type="radio"  id="visible_false" name="visible" value="false">
        <label for="visible_false">NON Visibile</label>
    
        <label for="city">Inserisci il numero di stanze</label>
        <input type="url" min="10" id="city" name="city" value="{{ old('city', $apartment->city) }}">
     

    </form>
@endsection


