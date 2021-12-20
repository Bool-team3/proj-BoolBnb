@extends('layouts.app')

@section('content')
    
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>I nostri sponsor:</h2>
                <a href="{{route('user.apartments.index')}}">Torna ai tuoi appartamenti</a>
                
                <div class="d-flex justify-content-between">
                    @forelse ($sponsors as $sponsor)
                    
                        <form action="{{ route('user.sponsors.store')}}"  method="POST" class="confirmSponsor">
                            @csrf

                            <div class="card" style="width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title" > {{ $sponsor->name }} </h5>
                                    <h6 class="card-title"> Prezzo: {{ $sponsor->price }} &euro; </h6>
                                    <input class="d-none" type="text" name="sponsor_id" value="{{ $sponsor->id }}" readonly id="sponsor_id">
                                    <input class="d-none" type="text" name="apartment_id" value="{{ $apartment }}" readonly >
                                    <h6 class="card-title"> Durata: {{ $sponsor->time }} giorni </h6>
                                    {{-- <a href="" class="stretched-link"></a> --}}
                                </div>
                            </div>       
                            <button type="" class="btn btn-success">Compra</button>

                        </form>
                    @empty
                        <h6>Non ci sono sponsor disponibili.</h6>
                    @endforelse
                </div>
                <div id="dropin-container" class="col-12 p-0 d-none"></div>  
                <button type="submit" class="btn btn-primary btn-compra d-none" id="gg">Compra</button>

            </div>
        </div>
    </div>
    <script type="text/javascript">
        // var card = document.getElementsByClass('card'):

        // card.addEventListener('click' =>{

        // });
        const confirmSponsor = document.querySelectorAll('.confirmSponsor');
            confirmSponsor.forEach(element => {

                element.addEventListener("submit", function(event){
                    //stoppa l'evento
                    event.preventDefault();

                    //apre il box di conferma
                    let confirm = document.querySelector('#dropin-container');
                    confirm.classList.remove("d-none");

                    //prende il valore dei bottoni del box di conferma
                    const buttonPurchase = document.querySelector('#gg');
                    buttonPurchase.classList.remove("d-none");
                

                    buttonPurchase.addEventListener("click", function(){
                        element.submit();
                        confirm.classList.add("d-none");
                    })

                    
                });

            });
       var button = document.getElementById('gg');

        braintree.dropin.create({
        authorization: 'sandbox_g42y39zw_348pk9cgf3bgyw2b',
        selector: '#dropin-container'
        }, function (err, instance) {
            button.addEventListener('click', function () {
                instance.requestPaymentMethod(function (err, payload) {
                // Submit payload.nonce to your server
                });
            })
        });
    </script>
@endsection