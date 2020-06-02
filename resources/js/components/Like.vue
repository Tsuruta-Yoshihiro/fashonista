<template>
   <div>
       <button 
       type="button" 
       :class="{ 'button--liked': liked_by_user }" 
       @click="onLikeClick"
       >
      
        <i class="icon ion-md-heart"></i>{{ likes_count }}
       </button>
   </div>
</template>

<script>
    export default {
        props: ['postId'],
        
        methods: {
            submit(postId) {
              let url = '/api/posts/${postId}/like'
              
              axios.post(url)
              .then(response => {
                
              })
              .catch(error => {
                alert(error)
              });
              
            }
        }
    }
</script>
