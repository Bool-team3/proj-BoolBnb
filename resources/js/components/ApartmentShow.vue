<template>
    <div class="container">
        <Loading v-if="loading"/>
        <h1>{{apartment[0].id}}</h1>

    </div>
</template>

<script>
import Loading from "./Loading.vue";
export default {
    name: "ApartmentShow",
    data() {
        return {
            //per mo lo lascio falso
            loading: false,
            apartment: []
        }
    },
    components:{           
        Loading,
    },
    methods: {
        getApartmentDetails(){
            axios.get(`/api/apartments/`)
            .then((response) => {
                console.log(response);
                this.apartment = response;
                
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