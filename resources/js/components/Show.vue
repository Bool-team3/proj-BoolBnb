<template>
    <div class="container">
       <div class="card">
        <div class="card-body">
            <h2>{{apartment.title}}</h2>
            <h3>{{apartment.city}}</h3>        
        </div>    
    </div>
    </div>
</template>

<script>

export default {
    name: "Show",
    data() {
        return {
            apartment: [],
            apID : '',
        }      
    },
    components:{           
    
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