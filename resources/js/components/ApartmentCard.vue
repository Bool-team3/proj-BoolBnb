<template>
    <div class="container">
        <div v-if="apartment.visible">
            <div class="card">
                <div class="card-body">                  
                    <h2 class="card-title">{{apartment.title}}</h2>
                    <h6 class="card-title">Stanze: {{apartment.room}}</h6>
                    <h6 class="card-title">Stanze da letto: {{apartment.bedroom}}</h6>
                    <h6 class="card-title">Posti letto: {{apartment.bed}}</h6>
                    <h6 class="card-title">Bagni: {{apartment.bathroom}}</h6>
                    <h6 class="card-title">Metri quadrati: {{apartment.mq}}</h6>
                    <p class="card-text">Città: {{apartment.city}}</p>
                    <p class="card-text"><small class="text-muted">Last updated {{apartment.created_at}} ago</small></p>
                    <a :href="`/apartments/${apartment.id}`" class="stretched-link"></a>
                </div>       
            </div>
        </div>               
    </div>
</template>

<script>

export default {
    name: 'ApartmentCard',
    data() {
        return {
        }
    },
    props: ['apartment'],

    components:{           
    },
    methods:{
    },
}
</script>

<style>

</style>