<template>
    <div class="price_container">


            <div class="box" v-for="villa in villas" :key="villa.id">
<!--                <form>-->
                <div class="name">
                    <h6>
                        {{villa.name }}
                    </h6>
                </div>
                <div class="img-box">
                    <img :src="villa.image" alt="">
                </div>
                <div class="detail-box">
                    <h5>
                        $<span>{{ villa.price }}</span>
                    </h5>
                    <button type="submit" @click.prevent="booking(villa)">
                        Buy Now
                    </button>
                </div>
<!--                </form>-->
            </div>


    </div>
</template>

<script>
export default {
    name: "Villa",
    data(){
        return {
            villas : [],
        }
    },
    created(){
        this.getVillas()
    },
    methods:{
        getVillas(){
            axios.get('/getVillaApi').then(res => {
              this.villas = res.data.data
            })
        },
        booking(villa){
            axios.post('/booking',{
                villa_id : villa,
            }).then(res => {
                if (res.data.message){
                    this.$toast.success(res.data.message,'Success',{timeout : 3000})
                }else {
                    this.$toast.warning(res.data.fail,'Warning',{timeout : 3000})
                }

            }).catch(error => {
               this.$toast.error('مشكلة','Error',{timeout : 3000})
            })
        }

    }
}
</script>

<style scoped>

</style>
