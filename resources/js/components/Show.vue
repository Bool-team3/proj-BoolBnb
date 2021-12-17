<template>
    <div class="container">
        <Loading v-if="loading"/>
        <div class="row">
            <div class="col-12">
                <h2 class="text-center">{{apartment.title}}</h2>
            </div>
        </div>
        <div class="row">
            <div class="card-body col-6">
                <picture>
                    <img v-if="!apartment.img_url" :src="'https://via.placeholder.com/300x300.png/0099ee?text=team3+praesentium'" alt="">
                    <img v-else :src="apartment.img_url" alt="">   
                </picture>
                <div>
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
                <div>
                    <h5>Host: {{user.name}}</h5>
                    <h6>contact mail: {{user.email}}</h6>
                </div>
            </div>
            <div class="col-6">
                <ul>
                    <li v-for="(element, index) in apartment.services" :key="index">{{element.name}}</li>
                </ul>
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
            // services: [],
            apID : '',
            loading: true
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
            
            this.apID = lp;
        },
        getApartmentDetails(){
            axios.get(`/api/apartments/${this.apID}`)       
            .then((response) => {         
                //riempio apartment
                this.apartment = response.data.apartment;    
                //riempio user
                this.user = response.data.user;    

                // this.services = response.data.services;    
                
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


<style scoped lang="scss">
    .card{
        flex-direction: row;
    }
    .card-body{
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    ol{
        padding: 0;
    }
    li{
        list-style-type: none;
        display: inline;
        margin-right: 10px;
    }
</style>>
