<template>
    <div class="container-fluid">
        <div v-if="apartment.visible">
            <div class="displayBox" data-aos="fade-left">
                <div class="card container-content">
                    <div class="card-body">
                        <div class="img-container">
                            <div v-if="apartment.img_url">
                                <img class="img-fluid" :src='`http://127.0.0.1:8000/storage/${apartment.img_url}`' alt="Immagine appartamento">
                            </div>
                            <div v-else>
                                <img class="img-fluid" src="https://www.pianetacasafacile.it/uploads/cache/profile_mid/uploads/property_images/2018/01/property_no_photo.png" alt="Immagine appartamento">
                            </div>
                        </div>

                        <div class="text-container">
                            <h2>{{apartment.title}}</h2>
                            <p>{{apartment.province}}, {{apartment.city}}, {{apartment.street_name}} {{apartment.street_number}}</p>
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

                        <a :href="`/apartments/${apartment.id}`" class="stretched-link"></a>
                    </div>
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