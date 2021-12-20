<template>
    <div class="container">
        <Loading v-if="loading"/>
        <div class="row">
            <div class="col-12">
                <h2 class="text-center">{{apartment.title}}</h2>
            </div>
        </div>
        <div class="row">
            <div class="card-body col-6">
                <picture>
                    <img v-if="!apartment.img_url" src="https://www.pianetacasafacile.it/uploads/cache/profile_mid/uploads/property_images/2018/01/property_no_photo.png" alt="">
                    <img v-else :src="`http://127.0.0.1:8000/storage/${apartment.img_url}`" alt="">   
                </picture>
                <div>
                    <ol>
                        <li v-if="apartment.room == 1">{{apartment.room}} stanza</li>
                        <li v-else>{{apartment.room}} stanze</li>
                        <li v-if="apartment.bedroom == 1">{{apartment.bedroom}} letto</li>
                        <li v-else>{{apartment.bedroom}} letti</li>
                        <li v-if="apartment.bathroom == 1">{{apartment.bathroom}} bagno</li>
                        <li v-else>{{apartment.bathroom}} bagni</li>
                        <li>{{apartment.mq}} mq</li>
                    </ol>
                </div>
                <div>
                    <h5>Host: {{user.name}}</h5>
                    <h6>contact mail: {{user.email}}</h6>
                </div>
            </div>
            <div class="col-3 d-flex justify-content-center align-items-center">
                <ul>
                    <li v-for="(element, index) in apartment.services" :key="index">

                        <h2 v-if="element.id == 1">
                            <i class="fas fa-wifi"></i>
                            {{element.name}}
                        </h2>
                        <h2 v-else-if="element.id == 2">
                            <i class="fas fa-water"></i>
                            {{element.name}}
                        </h2>
                        <h2 v-else-if="element.id == 3">
                            <i class="fas fa-swimming-pool"></i>
                            {{element.name}}
                        </h2>
                        <h2 v-else-if="element.id == 4">
                            <i class="fas fa-parking"></i>
                            {{element.name}}
                        </h2>
                        <h2 v-else-if="element.id == 5">
                            <i class="fas fa-concierge-bell"></i>
                            {{element.name}}
                        </h2>
                        <h2 v-else-if="element.id == 6">
                            <i class="fas fa-hot-tub"></i>
                            {{element.name}}
                        </h2>
                    </li>
                </ul>
            </div>
            <div class="col-3">
                <h5>{{apartment.city}}</h5>
                <h5>{{apartment.street_name}}</h5>
                <h5>{{apartment.street_number}}</h5>
            </div>
        </div>
        <div id="map" class="mb-3">

        </div>
    </div>
</template>

<script>
import Loading from "./Loading.vue";

export default {
    name: "Show",
    data() {
        return {
            apartment: [],
            user: [],
            // services: [],
            apID : '',
            loading: true,  
        }      
    },
    components:{           
        Loading,
    },
    methods: {
        getIDfromURL(){
            var urlPreso = window.location.pathname;

            var parts = urlPreso.split("/");
            
            var lp = parts[parts.length - 1];
            
            if(lp === '') lp = parts[parts.length - 2];
            
            this.apID = lp;
        },
        getApartmentDetails(){
            axios.get(`/api/apartments/${this.apID}`)       
            .then((response) => {         
                //riempio apartment
                this.apartment = response.data.apartment;    
                //riempio user
                this.user = response.data.user;
                console.log(this.apartment);
                // mappa
                var map = tt.map({
                    key : 'cYyxBH2UYfaHsG6A0diGa8DtWRABbSR4',
                    container: 'map',
                    center: [12, 41],
                    zoom: 4
                });
                map.addControl(new tt.FullscreenControl());
                map.addControl(new tt.NavigationControl());
                // Poi Details Settings
                var popupOffsets = {
                    top: [0, 0],
                    bottom: [0, -70],
                    'bottom-right': [0, -70],
                    'bottom-left': [0, -70],
                    left: [25, -35],
                    right: [-25, -35]
                }

                // var markerCustom = document.createElement('div');
                // markerCustom.id = 'marker-show';

                var marker = new tt.Marker().setLngLat([this.apartment.lon, this.apartment.lat]).addTo(map);

                // POI Details Popup
                var popup = new tt.Popup({offset: popupOffsets}).setHTML(`<strong>${this.apartment.title}</strong> <br> <p>${this.apartment.street_name} ${this.apartment.street_number}, ${this.apartment.city}</p>`);
                marker.setPopup(popup);

                map.setCenter([this.apartment.lon, this.apartment.lat]);
                map.setZoom(9.5);
            
                // this.services = response.data.services;    
                
            }).catch( (error) =>{
                console.log(error);
            }).then( () =>{
                this.loading = false;
            });
        },
    },
    created(){
        this.getIDfromURL();
        this.getApartmentDetails();
    }
    
}
</script>


<style scoped lang="scss">


.card{
    flex-direction: row;
}
.card-body{
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
ol{
    padding: 0;
}
li{
    list-style-type: none;
    display: inline;
    margin-right: 10px;
}
#map{
    position: -webkit-sticky;
    position: sticky;
    top: 125px;
    border-radius: 25px;
    height: 400px;
    max-width: 100%;
}

@media screen and (max-width: 860px) {
    #map{
        height: 300px;
        width: 350px;
    }
}

// #marker-show{
//     background-image: url('https://i.pinimg.com/originals/6c/e9/12/6ce9124ba178121ec828d8e2e566c1f4.png');
//     filter: invert(37%) sepia(37%) saturate(1831%) hue-rotate(218deg) brightness(87%) contrast(90%);
//     background-size: contain;
//     background-repeat: no-repeat;
//     width: 55px;
//     height: 75px;
// }


</style>
