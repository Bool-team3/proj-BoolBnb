<template>
    <div class="container">
        <Loading v-if="loading"/>
        <div class="card d-flex" v-else>
            <h2>{{apartment.title}}</h2>
            <picture>
                <img :src="apartment.img_url" alt="">   
            </picture>
            <div class="card-body">
                <h5>Host: {{user.name}}</h5>
                <h6>contact mail: {{user.email}}</h6>
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
                //riempio apartment
                this.apartment = response.data.apartment;    
                //riempio user
                this.user = response.data.user;    
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