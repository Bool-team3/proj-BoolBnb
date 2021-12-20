<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://js.braintreegateway.com/web/dropin/1.32.1/js/dropin.min.js"></script>
    <link rel="icon" href="{{ asset('storage/public/logo/logo_small_icon_only.png') }}">
    <title>Bool b&b | Sponsor</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <section id="sponsor-section">
        <a href="{{route('user.apartments.index')}}" class="back-to-home" title="Torna indietro">
            <i class="fas fa-long-arrow-alt-left fa-4x"></i>
        </a>
        <div class="container-fluid">
            <div class="row">
                @forelse ($sponsors as $sponsor)  
                    <div class="col-12 col-md-4">
                        <div class="card text-white mb-3">
                            <div class="card-header"><h3>{{ $sponsor->name }}</h3></div>
                            <div class="card-body">

                                <form action="{{ route('user.sponsors.store')}}"  method="POST" class="confirmSponsor">
                                @csrf
                                    <h6 class="card-title"> Prezzo: {{ $sponsor->price }} &euro; </h6>
                                    <input class="d-none" type="text" name="sponsor_id" value="{{ $sponsor->id }}" readonly id="sponsor_id">
                                    <input class="d-none" type="text" name="apartment_id" value="{{ $apartment }}" readonly >
                                    <h6 class="card-title"> Durata: {{ $sponsor->time }} giorni </h6>
                                    <button type="submit" class="btn btn-success">Compra</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <h3>Non ci sono sponsor al momento</h3>
                @endforelse
            </div>

            <div id="bg-braintree" class="d-none">
                <div id="container-braintree">
                    <div id="dropin-container" class="col-12 p-0 d-none"></div>
                    <button type="submit" class="btn btn-primary btn-compra d-none" id="purchase">Compra</button>
                    <button type="submit" class="btn btn-danger btn-compra d-none" id="cancel">Annulla</button>
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript">
        
        const confirmSponsor = document.querySelectorAll('.confirmSponsor');
            confirmSponsor.forEach(element => {

            element.addEventListener("submit", function(event){
                //stoppa l'evento
                event.preventDefault();

                //apre il box di conferma
                let confirm = document.querySelector('#dropin-container');
                let bg_confirm = document.querySelector('#bg-braintree');
                confirm.classList.remove("d-none");
                bg_confirm.classList.remove('d-none');

                //prende il valore dei bottoni del box di conferma
                const buttonPurchase = document.querySelector('#purchase');
                buttonPurchase.classList.remove("d-none");

                const buttonCancel = document.querySelector('#cancel');
                buttonCancel.classList.remove("d-none");

                buttonPurchase.addEventListener("click", function(){
                    element.submit();
                    confirm.classList.add("d-none");
                    bg_confirm.classList.add('d-none');
                })

                buttonCancel.addEventListener("click", function(){
                    confirm.classList.add("d-none");
                    bg_confirm.classList.add('d-none');
                })

            });

        });
        var button = document.getElementById('purchase');

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
</body>
</html>
