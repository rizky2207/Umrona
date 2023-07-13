<template>

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4>Add Post</h4>
        </div>
        <div class="card-body">
            <ul class="alert alert-warning" v-if="Object.keys(this.errorList).length > 0">
                <li class="mb-0 ms-3" v-for="(error,index) in this.errorList" :key="index">
                    {{ error[0] }}
                </li>

            </ul>

            <div class="mb-3">
                <label  class="form-label">Title</label>
                <input type="text" v-model="model.post.title" class="form-control"  placeholder="Masukkan title">
            </div>
            <div class="mb-3">
                <label  class="form-label">Slug</label>
                <input type="text" v-model="model.post.slug" class="form-control" >
            </div>
            <div class="mb-3">
                <label  class="form-label">Content</label>
                <textarea class="form-control" v-model="model.post.content"  rows="3"></textarea>
            </div>
            <div class="mb-3">
            <button type="button" @click="savePost" class="btn btn-primary">Simpan</button>   
            </div>
        </div>
    </div>
</div>

</template>

<script>
import axios from 'axios'
export default{
    name:'postCreate',
    data(){
        return{
            errorList:'',
            slug:'',
            model:{
                post:{
                    title:'',
                    slug:'',
                    content:''
                }
            }
        }
    },

    methods:{
        convertToSlug() {
        this.slug = this.title
            .toLowerCase()
            .replace(/[^\w\s-]/g, '') // Menghapus karakter khusus
            .replace(/\s+/g, '-') // Mengganti spasi dengan tanda -
            .replace(/--+/g, '-') // Mengganti beberapa tanda - berurutan dengan satu tanda -
            .trim(); // Menghapus spasi di awal dan akhir
        },

        savePost(){
            var mythis=this;
            axios.post('http://127.0.0.1:8000/api/posts',this.model.post)
            .then(res=>{
                console.log(res.data)
                alert(res.data.message)

                this.model.post={
                    title:'',
                    slug:'',
                    content:''
                }
                this.convertToSlug()
                this.errorList=''
            })
            .catch(function(error){
                if (error.response) {
                    
                    if(error.response.status == 422){
                        mythis.errorList=error.response.data.errors;
                    }

                    // console.log( );
                    // console.log(error.response.status);
                    // console.log(error.response.headers);
                } else if (error.request) {
                    console.log(error.request);
                } else {
                    console.log('Error', error.message);
                }
            });
        }
    },
}

</script>