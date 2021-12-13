<template>

<<<<<<< HEAD
  <div class="container">
      <div class="row">
          <div class="col">
             <nav class="navbar navbar-light bg-light">
                <input class="form-control mr-sm-2" v-model.trim="search" @keyup="searchApartment(search)" @keyup.enter="resetModel()" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>              
            </nav>
            <ApartmentCard v-for="element in apartmentList" :key="element.id" :apartment='element' />              
          </div>
      </div>
  </div>
=======
                <div>
                    <nav class="navbar navbar-light bg-light">
                        <input class="form-control mr-sm-2" v-model.trim="search" @keyup.enter="searchApartment(search)" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit"  @keyup.enter="searchApartment(search)">Search</button>              
                    </nav>
                    <ApartmentCard v-for="element in apartmentResults" 
                        :key="element.id" :apartment='element' />              
                </div>
            </div>
        </div>
    </div>
>>>>>>> main
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

<<<<<<< HEAD
                response.data.apartments.forEach(element => {
                    if(element.city.toLowerCase().includes(search.toLowerCase()) || element.street_name.toLowerCase().includes(search.toLowerCase())){
                        console.log(search);
                        if(!this.apartmentList.includes(element)){
                            this.apartmentList.push(element);
                            console.log(this.apartmentList);              
                        }
=======
            if(search == ''){
                this.apartmentResults = this.apartmentList
            }
            else
            {    
                axios.get(`https://api.tomtom.com/search/2/geocode/${search}.json`,{
                    params: {
                        key : 'cYyxBH2UYfaHsG6A0diGa8DtWRABbSR4'                   
>>>>>>> main
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
                                }
                            }
                        }
                    })
                })
                .catch( (error) =>{
                    console.log(error);
                })
                .then( () =>{
                    this.loading = false;
                });
<<<<<<< HEAD
            }).catch( (error) =>{
                console.log(error);
            }).then( () =>{
                this.loading = false;
            });
        },
        resetModel(){
            this.search = '';
=======
            }
>>>>>>> main
        }
    },

    created(){
        this.getApartmentList();
    },
}
</script>