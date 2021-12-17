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
            var urlPreso = window.location.pathname;

            var parts = urlPreso.split("/");
            
            var lp = parts[parts.length - 1];
            
            if(lp === '') lp = parts[parts.length - 2];
            
            this.apID = lp 
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