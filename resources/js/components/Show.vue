<template>
    <div class="container">
        <Loading v-if="loading"/>
        <div class="card" v-else>
        <div class="card-body">
            <h2>{{apartment.title}}</h2>
            <h2>{{apartment.id}}</h2>
            <h3>{{apartment.city}}</h3>        
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
            apID : '',
            loading: true,
        }      
    },
    components:{           
        Loading,
    },
    methods: {
        getIDfromURL(){
            //prendo l'id dall0'url e sto.
            this.apID =  window.location.pathname.split('/')[2];
            console.log(this.apID);
        },
        getApartmentDetails(){
            axios.get(`/api/apartments/${this.apID}`)       
            .then((response) => {              
                this.apartment = response.data.apartment;    
            }).catch( (error) =>{
                console.log(error);
            }).then( () =>{
                this.loading = false;
            });
        }
    },
    created(){
        this.getIDfromURL();
        this.getApartmentDetails();
    }
}
</script>

<style>

</style>