<template>
  <div>
    <button
      type="button"
      class="btn m-0 p-1 shadow-none"
      
      @click="submit(psotId)"/>
    
    
    
    </button>
    {{ countLikes }}
  </div>
</template>



<script>
    export default {
        props: ['psotId'],
        
        methods: {
            submit(postId) {
                let url = '/api/posts/${psotId}/like'
                
                axios.post(url)
                .then(response) => {
                  
                })
                .catch(error => {
                  alert(error)
                });
            }
        }
    }
</script>
