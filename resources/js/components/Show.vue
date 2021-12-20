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
                    <img v-if="!apartment.img_url" :src="'https://via.placeholder.com/200x300.png/0099ee?text=team3+praesentium'" alt="">
                    <img v-else :src="apartment.img_url" alt="">   
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
            <div class="col-6 d-flex justify-content-center align-items-center">
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

                // this.services = response.data.services;    
                
            }).catch( (error) =>{
                console.log(error);
            }).then( () =>{
                this.loading = false;
            });
        },
        // searchApartment(search){
        //     delete axios.defaults.headers.common['X-Requested-With'];
        //     console.clear()
  
        //     axios.get(`https://api.tomtom.com/search/2/geocode/${search}.json`,{
        //         params: {
        //             key : 'cYyxBH2UYfaHsG6A0diGa8DtWRABbSR4'                   
        //         }
        //     })
        //     .then( (response) => {
        //         let geometryList =
        //             {
        //                 "type":"CIRCLE", 
        //                 "position": `${response.data.results[0].position.lat}, ${response.data.results[0].position.lon}`, 
        //                 "radius": this.radius*1000
        //             }
                
        //         axios.get(`https://api.tomtom.com/search/2/geometryFilter.json?geometryList=[${JSON.stringify(geometryList)}]&poiList=${JSON.stringify(this.poiList)}&key=cYyxBH2UYfaHsG6A0diGa8DtWRABbSR4`)
        //         .then( (response) => {
        //             this.apartmentResults=[];
        //             //Se il risultato della ricerca degli appartamenti trovati coincide con la lista intera degli appartamenti pusha l'oggetto appartamento dentro 'arrayResults'
        //             for(let elementResult of response.data.results){
        //                 console.log(elementResult.poi.id)
        //                 for(let element of this.apartmentList){
        //                     if(elementResult.poi.id == element.id && element.room >= this.room && element.bed >= this.bed && this.isInSelectedServices(element)){
        //                         this.apartmentResults.push(element);
        //                         this.poi.push({
        //                             position: {
        //                                 lon: element.lon, 
        //                                 lat: element.lat
        //                             }
        //                         });
        //                     }
        //                 }
        //             }
                    
        //             //creazione mappa
        //             var map = tt.map({
        //                 key : 'cYyxBH2UYfaHsG6A0diGa8DtWRABbSR4',                  
        //                 container: 'map',
        //                 center: [12, 41],
        //                 zoom: 4
        //             });
        //             map.addControl(new tt.FullscreenControl());
        //             map.addControl(new tt.NavigationControl());

        //             //stampa i marker dalle nostre coordinate
        //             this.poi.forEach(element => {
                        
        //                 var customMarker = document.createElement('div');
        //                 customMarker.id = 'marker';
        //                 new tt.Marker({element: customMarker}).setLngLat([element.position.lon, element.position.lat]).addTo(map);
        //             });
        //             map.setCenter([this.poi[0].position.lon, this.poi[0].position.lat]);
        //             map.setZoom(9.5);
        //             this.poi = [];
        //         })
        //     })
        //     .catch( (error) =>{
        //         console.log(error);
        //     })
        //     .then( () =>{
        //         this.loading = false;
        //     });
        // },
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
        li{
            display: inline;
            margin-right: 10px;           
        }
    }

    ul{
        display: flex;
        flex-direction: column;
    }
    li{
        list-style-type: none;
    }
</style>>
