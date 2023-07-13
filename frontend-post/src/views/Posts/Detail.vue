<template>
    <div class="card">
      <div class="card-header">
        Postingan
      </div>
      <div class="card-body">
        <h2 class="card-title">{{ model.post.title }}</h2>
        <p class="card-text">{{ model.post.content }}</p>
        <button type="button" @click="goBack()" class="btn btn-primary">back</button>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios'
  
  export default {
    name: 'postDetail',
    data() {
      return {
        postSlug: '',
        model: {
          post: {
            title: '',
            content: ''
          }
        }
      }
    },
    mounted() {
      this.postSlug = this.$route.params.slug;
      this.getPostsData(this.$route.params.slug);
    },
    methods: {
      getPostsData(postSlug) {
        axios.get(`http://127.0.0.1:8000/api/posts/${postSlug}`)
          .then(res => {
            console.log(res.data.post)
            this.model.post = res.data.post
          })
          .catch(function (error) {
            if (error.response) {
              if (error.response.status == 422) {
                alert(error.response.data.message);
              }
            }
          });
      },
      goBack(){
        this.$router.push({path:"/"});
      }
    }
  }
  </script>
  