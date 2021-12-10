<template>
  <div class="container">
      <div class="row">
          <div class="col">
             <nav class="navbar navbar-light bg-light">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>              
            </nav>
            <ApartmentCard v-for="element in apartmentList" :key="element.id" :apartment='element' />              
          </div>
      </div>
  </div>
</template>

<script>

import ApartmentCard from './ApartmentCard.vue';

export default {
    name: "ApartmentView",
    data() {
        return {
            apartmentList: [],
        }
    },
    components:{           
        ApartmentCard
    },
    methods:{
        getApartmentList(){
            axios.get("/api/apartments")
            .then( (response) => {
                this.apartmentList = response.data.apartments;
                console.log(response.data.apartments[0].sponsors);
            }).catch( (error) =>{
                console.log(error);
            }).then( () =>{
                // this.loading = false;
            });
        },

    },
    created(){
        this.getApartmentList();
    },
    computed(){
        
    }
}
</script>

<style>

</style>