<template>
    <div class="container-fluid">
        <div class="row">
            <Loading v-if="this.loading"/>
            <div v-else class="col-12 p-0">
                <div id="jumbotron">
                    <div>
                        <h1>I migliori appartamenti nella tua zona!</h1>
                        <div class="jumbotron-content"></div>
                        <legend>Be smart, use Bool bnb</legend>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <h3>Usa la ricerca per trovare l'appartamento che desideri</h3>
            </div>

            <div class="col-12 col-md-6">
                <nav class="navbar navbar-light bg-light">
                    <input id="search-bar" class="form-control mr-sm-2" v-model.trim="search" @keyup.enter="searchApartment(search)" type="search" placeholder="Cerca" aria-label="Search">
                    <button id="myBtn" class="btn btn-outline-success my-2 my-sm-0" type="submit"  @click.left="searchApartment(search)">Cerca</button>
                </nav> 
            </div>
            
            <div class="col-12 col-md-6">
                <div class="filter-navbar">
                    <div class="input-filter">
                        <label for="radius">Km area di ricerca</label>
                        <input type="number" class="form-control form-width" id="radius" min="1" v-model="radius">
                    </div>
                    
                    <div class="input-filter">
                        <label for="room">Numero di stanze:</label>
                        <input type="number" class="form-control form-width" id="room" min="1" v-model="room">
                    </div>
                    
                    <div class="input-filter">
                        <label for="bed">Numero letti:</label>
                        <input type="number" class="form-control form-width" id="bed" min="1" v-model="bed">
                    </div>
                </div>
            </div>
            
            <div class="col-12">
                <div id="checkbox_service" class="form-check form-check-inline" v-for="service in serviceList" :key="service.id" >
                        <input class="form-check-input" type="checkbox" :id="`service-${service.id}`" :value="service.id" v-model="selectedServices">
                        <label class="form-check-label" :for="`service-${service.id}`">{{service.name}}</label>
                </div>
            </div>
            <div class="col-12 col-md-7" id="apartments_list">
                <Loading v-if="loading"/>

                <div v-else>
                    <ApartmentCard v-for="element in apartmentResults" :key="element.id" :apartment='element'/>

                    <!-- impaginazione -->
                    <div v-if="!find">
                        <nav aria-label="navigation">
                            <ul class="pagination p-3">
                                <li v-if="currentPage > 1" class="page-item">
                                    <button class="page-link" @click="getApartmentList(currentPage - 1)">Precedente</button>
                                </li>

                                <li :class="{ active: n === currentPage }" v-for="(n, index) in lastPage" :key="index+n" class="page-item" @click="getApartmentList(n)">
                                    <a class="page-link" >{{ n }}</a>
                                </li>

                                <li class="page-item">
                                    <button v-if="currentPage < lastPage" class="page-link" @click="getApartmentList( currentPage + 1 )">Successivo</button>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- mappa -->
            <div class="col-5 d-none d-md-block">
                <div class="col-map">
                    <div id='map'></div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
import Loading from "./Loading.vue";
import ApartmentCard from './ApartmentCard.vue';

export default {
    name: "ApartmentView",
    data() {
        return {
            apartmentList: [],
            apartmentResults: [],
            apartmentListAll: [],
            poiList: [],
            search: "",
            find: false,
            loading: true,
            serviceList: [],
            selectedServices: [],
            radius: 20 ,
            room: 1,
            bed : 1,
            //pagination
            currentPage: 1,
            lastPage: null

        }
    },
    components:{
        ApartmentCard,
        Loading,
    },
    methods:{

        getApartmentList( page ){
            axios.get(`/api/apartments/?page=${page}`)
            .then( (response) => {
                //prende la pagina corrente
                this.currentPage = response.data.apartments.current_page;
                //prende l'ultima pagina
                this.lastPage = response.data.apartments.last_page;

                //svuoto gli array ad ogni chiamata
                this.apartmentList = [];
                this.apartmentResults = [];
                this.poi = [];
                this.poiList = [];

                // console.log(response.data.apartments.data);
                //per gli appartamenti della pagina corrente
                for(let element of response.data.apartments.data){
                    if(element.visible){
                        this.apartmentList.push(element);
                        // Ordina La lista di appartamenti per sponsorizzazione
                        this.apartmentList.sort((a,b) => (a.sponsors < b.sponsors) ? 1 : ((b.sponsors < a.sponsors) ? -1 : 0))
                    }
                }
                //per tutti gli appartamenti
                for(let element of response.data.apartmentsAll){
                    if(element.visible){
                        this.apartmentListAll.push(element);
                        // Ordina La lista di appartamenti per sponsorizzazione
                        this.apartmentListAll.sort((a,b) => (a.sponsors < b.sponsors) ? 1 : ((b.sponsors < a.sponsors) ? -1 : 0))
                    }
                }
                //pag corrente
                this.apartmentResults = this.apartmentList;

                this.serviceList = response.data.services;

            }).catch( (error) =>{
                console.log(error);
            }).then( () =>{
                this.loading = false;

                for(let apartment of this.apartmentListAll){
                    
                    this.poiList.push({
                        "poi": {
                            "title": apartment.title,
                            "street_name": apartment.street_name,
                            "street_number": apartment.street_number,
                            "city": apartment.city,
                            "id" : apartment.id,
                        },

                        "position":{
                            "lat": apartment.lat,
                            "lon": apartment.lon
                        }
                    })
                }

                var map = tt.map({
                    key : 'cYyxBH2UYfaHsG6A0diGa8DtWRABbSR4',
                    container: 'map',
                    center: [12, 41],
                    zoom: 4
                });
                map.addControl(new tt.FullscreenControl());
                map.addControl(new tt.NavigationControl());
                this.poiList.forEach(element => {
                    // Poi Details Settings
                    var popupOffsets = {
                        top: [0, 0],
                        bottom: [0, -70],
                        'bottom-right': [0, -70],
                        'bottom-left': [0, -70],
                        left: [25, -35],
                        right: [-25, -35]
                    }

                    var customMarker = document.createElement('div');
                    customMarker.id = 'marker-all';

                    var marker = new tt.Marker({element: customMarker}).setLngLat([element.position.lon, element.position.lat]).addTo(map);

                    // POI Details Popup
                    var popup = new tt.Popup({offset: popupOffsets}).setHTML(`<strong>${element.poi.title}</strong> <br> <p>${element.poi.street_name} ${element.poi.street_number}, ${element.poi.city}</p>`);
                    marker.setPopup(popup);

                });
                map.setCenter(12, 41);
                map.setZoom(9.5);
            });
        },

        isInSelectedServices(apartment){

            let apartmentServiceIds = []

            for(let service of apartment.services){
                apartmentServiceIds.push(service.id)
            }
            console.log(apartmentServiceIds)
            console.log(apartment.services)

            return this.selectedServices.every( (service) => {
                return apartmentServiceIds.includes(service)
            })
        },

        //cerca appartamento
        searchApartment(search){
            delete axios.defaults.headers.common['X-Requested-With'];
            console.clear()

            if(search == ''){
                this.apartmentResults = [];
                this.find = false;
                // this.apartmentResults = this.apartmentList;
                for(let element of this.apartmentList){
                    if(element.room >= this.room && element.bed >= this.bed && this.isInSelectedServices(element)){
                        this.apartmentResults.push(element);
                    }
                }
                var map = tt.map({
                    key : 'cYyxBH2UYfaHsG6A0diGa8DtWRABbSR4',
                    container: 'map',
                    center: [12, 41],
                    zoom: 4
                });
                map.addControl(new tt.FullscreenControl());
                map.addControl(new tt.NavigationControl());

                this.apartmentResults.forEach(element => {
                    // Poi Details Settings
                    var popupOffsets = {
                        top: [0, 0],
                        bottom: [0, -70],
                        'bottom-right': [0, -70],
                        'bottom-left': [0, -70],
                        left: [25, -35],
                        right: [-25, -35]
                    }
                    var customMarker = document.createElement('div');
                    customMarker.id = 'marker-all';
                    var marker = new tt.Marker({element: customMarker}).setLngLat([element.lon, element.lat]).addTo(map);

                    // POI Details Popup
                    var popup = new tt.Popup({offset: popupOffsets}).setHTML(`<strong>${element.title}</strong> <br> <p>${element.street_name} ${element.street_number}, ${element.city}</p>`);
                    marker.setPopup(popup);
                });
                map.setCenter(12, 41);
                map.setZoom(9.5);
            }
            else
            {
                axios.get(`https://api.tomtom.com/search/2/geocode/${search}.json`,{
                    params: {
                        key : 'cYyxBH2UYfaHsG6A0diGa8DtWRABbSR4'
                    }
                })
                .then( (response) => {
                    let geometryList =
                        {
                            "type":"CIRCLE",
                            "position": `${response.data.results[0].position.lat}, ${response.data.results[0].position.lon}`,
                            "radius": this.radius*1000
                        }

                    axios.get(`https://api.tomtom.com/search/2/geometryFilter.json?geometryList=[${JSON.stringify(geometryList)}]&poiList=${JSON.stringify(this.poiList)}&key=cYyxBH2UYfaHsG6A0diGa8DtWRABbSR4`)
                    .then( (response) => {
                        this.apartmentResults = [];
                        this.find = true;
                        //Se il risultato della ricerca degli appartamenti trovati coincide con la lista intera degli appartamenti pusha l'oggetto appartamento dentro 'arrayResults'
                        for(let elementResult of response.data.results){

                            for(let element of this.apartmentListAll){
                                if(elementResult.poi.id == element.id && element.room >= this.room && element.bed >= this.bed && this.isInSelectedServices(element)){
                                    this.apartmentResults.push(element);
                                }
                            }
                        }

                        //creazione mappa
                        var map = tt.map({
                            key : 'cYyxBH2UYfaHsG6A0diGa8DtWRABbSR4',
                            container: 'map',
                            center: [12, 41],
                            zoom: 4
                        });
                        map.addControl(new tt.FullscreenControl());
                        map.addControl(new tt.NavigationControl());

                        //stampa i marker dalle nostre coordinate
                        this.apartmentResults.forEach(element => {
                            var popupOffsets = {
                                top: [0, 0],
                                bottom: [0, -70],
                                'bottom-right': [0, -70],
                                'bottom-left': [0, -70],
                                left: [25, -35],
                                right: [-25, -35]
                            }

                            var customMarker = document.createElement('div');
                            customMarker.id = 'marker';
                            var marker = new tt.Marker({element: customMarker}).setLngLat([element.lon, element.lat]).addTo(map);

                             // POI Details Popup
                            var popup = new tt.Popup({offset: popupOffsets}).setHTML(`<strong>${element.title}</strong> <br> <p>${element.street_name} ${element.street_number}, ${element.city}</p>`);
                            marker.setPopup(popup);
                        });
                        map.setCenter([this.apartmentResults[0].lon, this.apartmentResults[0].lat]);
                        map.setZoom(9.5);
                    })
                })
                .catch( (error) =>{
                    console.log(error);
                })
                .then( () =>{
                    this.loading = false;
                });
            }
        },
    },

    created(){
        this.getApartmentList(1);
    },

}
</script>

<style>
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

#marker{
    background-image: url('https://i.pinimg.com/originals/6c/e9/12/6ce9124ba178121ec828d8e2e566c1f4.png');
    filter: invert(37%) sepia(37%) saturate(1831%) hue-rotate(218deg) brightness(87%) contrast(90%);
    background-size: contain;
    background-repeat: no-repeat;
    width: 55px;
    height: 75px;
}
#marker-all{
    background-image: url('https://i.pinimg.com/originals/6c/e9/12/6ce9124ba178121ec828d8e2e566c1f4.png');
    filter: invert(37%) sepia(37%) saturate(1831%) hue-rotate(218deg) brightness(87%) contrast(90%);
    background-size: contain;
    background-repeat: no-repeat;
    width: 35px;
    height: 35px;
}

#apartments_list{
    overflow-y: scroll;
    overflow-y: hidden;
}



</style>