<template>
  <div class="container">
      <div class="row">
          <div class="col">
              <h1 class="text text-success">ciao</h1>
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
        }
    },
    created(){
        this.getApartmentList();
    }
}
</script>

<style>

</style>