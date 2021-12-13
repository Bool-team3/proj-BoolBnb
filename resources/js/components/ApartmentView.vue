<template>
    <div class="container">
        <div class="row">
            <div class="col-6" id="apartments_list">
                <Loading v-if="loading"/>

                <div>
                    <nav class="navbar navbar-light bg-light">
                        <input class="form-control mr-sm-2" v-model.trim="search" @keyup.enter="searchApartment(search)" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit"  @keyup.enter="searchApartment(search)">Search</button>              
                    </nav>
                    <ApartmentCard v-for="element in apartmentResults" 
                        :key="element.id" :apartment='element' />              
                </div>
            </div>
            <div class="col-6" id="mappa">
                <div id='map'></div>
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
            alela: [],
            poiList: [],
            search: "",
            loading: true,
            poi: [],
        }
    },
    components:{           
        ApartmentCard,
        Loading,
    },
    methods:{
        
        getApartmentList(){
            axios.get("/api/apartments")
            .then( (response) => {
                this.apartmentList = response.data.apartments;
                // Ordina La lista di appartamenti per sponsorizzazione
                this.apartmentList.sort((a,b) => (a.sponsors < b.sponsors) ? 1 : ((b.sponsors < a.sponsors) ? -1 : 0))

                this.apartmentResults = response.data.apartments;     
                
            }).catch( (error) =>{
                console.log(error);
            }).then( () =>{
                this.loading = false;

                for(let apartment of this.apartmentList){
                    this.poiList.push({
                        "poi": {
                            "title": apartment.title,
                            "id" : apartment.id, 
                        },
                        

                        "position":{
                            "lat": apartment.lat,
                            "lon": apartment.lon
                        }
                    })
                }
            });
        },

        searchApartment(search){
            delete axios.defaults.headers.common['X-Requested-With'];

            if(search == ''){
                this.apartmentResults = this.apartmentList
            }
            else
            {    
                axios.get(`https://api.tomtom.com/search/2/geocode/${search}.json`,{
                    params: {
                        key : 'cYyxBH2UYfaHsG6A0diGa8DtWRABbSR4'                   
                    }
                })
                .then( (response) => {
                    let geometryListArray =
                        {
                            "type":"CIRCLE", 
                            "position": `${response.data.results[0].position.lat}, ${response.data.results[0].position.lon}`, 
                            "radius":20000
                        }
                    
                    axios.get(`https://api.tomtom.com/search/2/geometryFilter.json?geometryList=[${JSON.stringify(geometryListArray)}]&poiList=${JSON.stringify(this.poiList)}&key=cYyxBH2UYfaHsG6A0diGa8DtWRABbSR4`)
                    .then( (response) => {
                        this.apartmentResults=[];
                        //Se il risultato della ricerca degli appartamenti trovati coincide con la lista intera degli appartamenti pusha l'oggetto appartamento dentro 'arrayResults'
                        for(let elementResult of response.data.results){
                            console.log(elementResult.poi.id)
                            for(let element of this.apartmentList){
                                if(elementResult.poi.id == element.id){
                                    this.apartmentResults.push(element);
                                    this.poi.push({
                                        position: {
                                            lon: element.lon, 
                                            lat: element.lat
                                        }
                                    });
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
                        this.poi.forEach(element => {
                            
                            var customMarker = document.createElement('div');
                            customMarker.id = 'marker';
                            new tt.Marker({element: customMarker}).setLngLat([element.position.lon, element.position.lat]).addTo(map);
                        });
                        map.setCenter([this.poi[0].position.lon, this.poi[0].position.lat]);
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
        this.getApartmentList();
    },

    mounted() {
        var map = tt.map({
            key : 'cYyxBH2UYfaHsG6A0diGa8DtWRABbSR4',                  
            container: 'map',
            center: [12, 41],
            zoom: 4
        });
        map.addControl(new tt.FullscreenControl());
        map.addControl(new tt.NavigationControl());
    }
     
}
</script>

<style> 
#map{ 
    height: 100%; 
    width: 100%; 
}
#marker{
  background-image: url('https://i.pinimg.com/originals/6c/e9/12/6ce9124ba178121ec828d8e2e566c1f4.png');
  filter: invert(37%) sepia(37%) saturate(1831%) hue-rotate(218deg) brightness(87%) contrast(90%);
  background-size: contain;
  background-repeat: no-repeat;
  width: 55px;
  height: 75px;
}

#mappa{
    position: fixed;
    right: 0;
    width: 100%;
    height: 100%;
}

#apartments_list{
    overflow-y: scroll;
    overflow-y: hidden;
}
</style> 