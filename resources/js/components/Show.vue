<template>
    <div class="container">
        <h1>{{apartment.id}}</h1>    
    </div>
</template>

<script>
// import ApartmentShow from "./ApartmentShow.vue";
export default {
    name: "Show",
    data() {
        return {
            apartment: []
        }      
    },
    components:{           
        // ApartmentShow,
    },
    methods: {
        getApartmentDetails(){
            axios.get(`/api/apartments/`)       
            .then((response) => {
                console.log(response);
                this.apartment = response.data.apartment;
                
            }).catch( (error) =>{
                console.log(error);
            });
        }
    },
    created(){
        this.getApartmentDetails();
    }
   
}
</script>

<style>

</style>