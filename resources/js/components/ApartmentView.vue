<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <Loading v-if="loading"/>

                <div>
                    <nav class="navbar navbar-light bg-light">
                        <input class="form-control mr-sm-2" v-model.trim="search" @keyup.enter="searchApartment(search)" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>              
                    </nav>
                    <ApartmentCard v-for="element in apartmentList" 
                        :key="element.id" :apartment='element' />              
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
            poiList: [],
            search: "",
            loading: true, 
        }
    },
    components:{           
        ApartmentCard,
        Loading
    },
    methods:{
        
        getApartmentList(){
            axios.get("/api/apartments")
            .then( (response) => {
                this.apartmentList = response.data.apartments;
                // console.log(response.data.apartments);
            }).catch( (error) =>{
                console.log(error);
            }).then( () =>{
                this.loading = false;

                for(let apartment of this.apartmentList){
                    this.poiList.push({
                        "poi": {
                            "title": apartment.title
                        },
                        "position":{
                            "lat": apartment.lat,
                            "lon": apartment.lon
                        }
                    })
                }
                console.log(this.poiList)
            });
        },

        searchApartment(search){
            delete axios.defaults.headers.common['X-Requested-With'];

            // axios.get("/api/apartments", {
            //     params: {
            //         query: search
            //     }
            // })
            // .then( (response) => {
            //     this.apartmentList = [];

            //     response.data.apartments.forEach(element => {
            //         if(element.city.toLowerCase().includes(search.toLowerCase()) || element.province.toLowerCase().includes(search.toLowerCase()) ){
            //             // console.log(search);
            //             if(!this.apartmentList.includes(element)){
            //                 this.apartmentList.push(element);
            //                 // console.log(this.apartmentList);
            //                 this.search = "";
            //             }
            //         }
            //     });
            // }).catch( (error) =>{
            //     console.log(error);
            // }).then( () =>{
            //     this.loading = false;
            // });

            axios.get(`https://api.tomtom.com/search/2/geocode/${search}.json`,{
                params: {
                    key : 'cYyxBH2UYfaHsG6A0diGa8DtWRABbSR4'                   
                }
            })
            .then( (response) => {
                // console.log('Risposta TomTom: ',response.data.results[0].position)
                let geometryListArray = 
                    [{
                        "type":"CIRCLE", 
                        "position": `${response.data.results[0].position.lat}, ${response.data.results[0].position.lon}`, 
                        "radius":20000
                    }]
                
                axios.get("https://api.tomtom.com/search/2/geometryFilter.json",{
                    params: {
                        geometryList : geometryListArray,
                        poiList : this.poiList,
                        key : 'cYyxBH2UYfaHsG6A0diGa8DtWRABbSR4'              
                        // geometryList : [{"type":"CIRCLE", "position":"40.80558, -73.96548", "radius":100}],
                        // poiList : [{"poi":{"name":"S Restaurant Toms"},"address":{"freeformAddress":"2880 Broadway, New York, NY 10025"},"position":{"lat":40.80558,"lon":-73.96548}},{"poi":{"name":"Yasha Raman Corporation"},"address":{"freeformAddress":"940 Amsterdam Ave, New York, NY 10025"},"position":{"lat":40.80076,"lon":-73.96556}}],
                        // key : 'cYyxBH2UYfaHsG6A0diGa8DtWRABbSR4'                    
                    }
                })
                .then( (response) => {
                    console.log(response)
                })

            })
            .catch( (error) =>{
                console.log(error);
            });
        }
    },

    created(){
        this.getApartmentList();
    },
}
</script>