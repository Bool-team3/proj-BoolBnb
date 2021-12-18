<template>
    <div class="container-fluid">
        <div v-if="apartment.visible">
            <!-- <div class="card">
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
            </div> -->
            <div class="card container-content">
                <div class="d-flex card-body">
                    <div class="img-container">
                        <div v-if="apartment.img_url">
                            <img class="img-fluid" :src='apartment.img_url' alt="Immagine appartamento">
                        </div>
                        <div v-else>
                            <img class="img-fluid" src="https://www.pianetacasafacile.it/uploads/cache/profile_mid/uploads/property_images/2018/01/property_no_photo.png" alt="Immagine appartamento">
                        </div>
                    </div>

                    <div class="text-container">
                        <h2>{{apartment.title}}</h2>
                        <p>{{apartment.province}}, {{apartment.city}}, Via {{apartment.street_name}} {{apartment.street_number}}</p>
                        <ul>
                            <li>{{apartment.room}} stanze</li>
                            <li>{{apartment.bedroom}} camera da letto</li>
                            <li>{{apartment.bed}} letto</li>
                            <li>{{apartment.bathroom}} bagno</li>
                            <li>{{apartment.mq}} metri quadrati</li>
                        </ul>
                        
                        <ul>
                            <li v-for="service in apartment.services" :key="service">{{service.name}}</li>
                        </ul>
                        
                    </div>

                    <!-- <a :href="`/apartments/${apartment.id}`" class="stretched-link"></a> -->
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