<template>
    <form method="POST" enctype="multipart/form-data" >

        <div class="form-group">
            <label>Title</label>
            <input type="text" v-model="form.title" class="form-control" placeholder="Enter Title">
        </div>
        <div class="form-group">
            <label>Choose Video</label>
            <input type="file" class="form-control" id="videoUpload" name="video" @change="handleFileUpload($event)"  ref="fileInput">
        </div>
        <hr>
        <progress v-if="showProgress" max="100" :value.prop="uploadPercentage"></progress>
<!--        <button type="submit" class="btn btn-dark">Submit</button>-->
        <VueLoadingButton
            :styled="true"
            :loading="isLoading"
            @click.native="send"
        ></VueLoadingButton>

    </form>
</template>

<script>
import VueLoadingButton from 'vue-loading-button'

export default {
    name: "UploadVideo",
    components: {
        VueLoadingButton,
    },
    data(){
        return{
            form : {
                title : '',
                video : '',
            },
            uploadPercentage: 0,
            showProgress : false,
            isLoading: false,
        }
    },
    methods:{
        handleFileUpload( event ){
            console.log(event)
            this.form.video = event.target.files[0];
        },
        send(){
            this.isLoading = true;
            this.showProgress = true
            let data = new FormData();
            data.append('title', this.form.title);
            data.append('video', this.form.video)

            axios.post(`/uploadVideo`, data, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                },
                onUploadProgress: function( progressEvent ) {
                    this.uploadPercentage = parseInt( Math.round( ( progressEvent.loaded / progressEvent.total ) * 100 ) );
                }.bind(this)
            }).then(res => {

               this.form = {}
                this.uploadPercentage = 0
                this.showProgress = false
                this.$confetti.start({
                    particles: [
                        {
                            type: 'heart',
                        }
                    ],
                    defaultColors: [
                        'red',
                        'pink',
                        '#ba0000',
                    ],
                });
                setTimeout(() => {
                    this.$confetti.stop();
                }, 2000);
                // var self = this;
                // Object.keys(this.form).forEach(function(key,index) {
                //     self.form[key] = '';
                // });
            }).catch(error => {
                this.errors = error.response.data.errors;
                this.showProgress = false
                setTimeout(() => {
                    this.$confetti.stop();
                }, 2000);
            }) .finally(() => {
                this.isLoading = false
                this.showProgress = false
                }

            );
        }
    }
}
</script>

<style scoped>

</style>
