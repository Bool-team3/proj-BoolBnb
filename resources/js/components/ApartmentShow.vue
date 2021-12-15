<template>
    <div class="container">
        <Loading v-if="loading"/>

        <h1>asdgbasidghasi</h1>
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
        }
    },
    components:{           
        Loading,
    },
    methods: {
        getApartmentDetails(){
            axios.get(`/api/apartment/${apartment.id}`)
            .then((response) => {
                console.log(response)
                
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