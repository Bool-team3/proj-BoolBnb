<div class="container">
    <div class="row">
        <div class="card-deck">
            <div class="card">
                <img class="card-img-top" src="{{$apartment->img_url}}" alt="Appartamento">
                <div class="card-body">
                    <h5 class="card-title"><a href="{{route("user.apartments.show", $apartment->id)}}">{{$apartment->title}}</a></h5>
                    <h6 class="card-title">Stanze: {{$apartment->room}}</h6>
                    <h6 class="card-title">Stanze da letto: {{$apartment->bedroom}}</h6>
                    <h6 class="card-title">Posti letto: {{$apartment->bed}}</h6>
                    <h6 class="card-title">Bagni: {{$apartment->bathroom}}</h6>
                    <h6 class="card-title">Metri quadrati: {{$apartment->mq}}</h6>
                    <p class="card-text">Città: {{$apartment->city}}</p>
                    <p class="card-text"><small class="text-muted">Last updated {{$apartment->created_at}} ago</small></p>
                </div>
            </div>
        </div>
        <a href="{{route("user.apartments.index")}}">Torna indietro</a>
    </div>
</div>