<template>
  <div class="card">
    <div class="card-header">
        <h4>Posts</h4>
        <RouterLink class="btn btn-primary" to="/posts/create">Add Posts</RouterLink>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>title</th>
                    <th>slug</th>
                    <th>content</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody v-if="this.posts.length>0">
                <tr v-for="(post,index) in this.posts" :key="index">
                    <td>{{ post.id }}</td>
                    <td>{{ post.title }}</td>
                    <td>{{ post.slug }}</td>
                    <td>{{ post.content }}</td>
                    <td>
                        <RouterLink :to="{ path:'/posts/'+post.slug }" class="btn m-1"><i class="bi bi-eye"></i></RouterLink>
                        <RouterLink :to="{ path:'/posts/'+post.id+'/edit' }" class="btn btn-success">Edit</RouterLink>
                        <button type="button" @click="deletePost(post.id)" class="btn btn-danger m-1">Delete</button>
                    </td>
                </tr>
            </tbody>
            <tbody v-else>
                <tr>
                    <td colspan="7">loading...</td>
                </tr>
            </tbody>
        </table>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
export default{
    name:'posts',
    data(){
        return{
            posts:[]
        }
    },
    mounted(){
       this.getPosts();
    },
    methods:{
        getPosts(){

            axios.get('http://127.0.0.1:8000/api/posts').then(res=>{
                this.posts= res.data.posts
                console.log(this.posts)
            })
        },
        deletePost(postId){
         if(confirm('apakah kamu yakin ?'))
            console.log(postId)
            axios.delete(`http://127.0.0.1:8000/api/posts/${postId}/delete`)
            .then(res=>{
                alert(res.data.message);
                this.getPosts();
            })
            .catch(function(error){
                if (error.response) {
                    
                    if(error.response.status == 404){
                        alert(error.response.data.message);
                    }

        
                } 
            });
        }
    },

}

</script>
