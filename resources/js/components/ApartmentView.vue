<template>

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
</template>

<script>
import Loading from "./Loading.vue";

import ApartmentCard from './ApartmentCard.vue';

export default {
    name: "ApartmentView",
    data() {
        return {
            baseUri : 'http://127.0.0.1:8000',
            apartmentList: [],
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
            axios.get(`${this.baseUri}/api/apartments`)
            .then( (response) => {
                this.apartmentList = response.data.apartments;
                // console.log(response.data.apartments);
            }).catch( (error) =>{
                console.log(error);
            }).then( () =>{
                this.loading = false;
            });
        },

        searchApartment(search){
            axios.get("/api/apartments", {
                params: {
                    query: search
                }
            })
            .then( (response) => {
                this.apartmentList = [];

                response.data.apartments.forEach(element => {
                    if(element.city.toLowerCase().includes(search.toLowerCase()) || element.street_name.toLowerCase().includes(search.toLowerCase())){
                        console.log(search);
                        if(!this.apartmentList.includes(element)){
                            this.apartmentList.push(element);
                            console.log(this.apartmentList);              
                        }
                    }
                });
            }).catch( (error) =>{
                console.log(error);
            }).then( () =>{
                this.loading = false;
            });
        },
        resetModel(){
            this.search = '';
        }

    },

    created(){
        this.getApartmentList();
    },
}
</script>

<style>

</style>