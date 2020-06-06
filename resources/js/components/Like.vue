<template>
   <div>
       <button
          type="button"
          class="btn m-0 p-1 shadow-none"
          >
            <i class="fas fa-heart mr-1"
               @click="Likeclick"
            />
        </button>
       {{ likes_count }}
   </div>
</template>

<script>
    export default {
        props: {
            initialIsLikeBy: {
                type: Boolean,
                default: false,
            },
            
            initialCountLikes: {
                type: Number,
                default: 0,
            },
            
            authorized: {
                type: Boolean,
                default: false,
            },
            
            endpoint: {
                type: String,
            },
        },
        
        data() {
            return {
            isLikeBy: this.initialIsLikeBy,
            countLikes: this.initialCountLikes,
            gotToLike: false,
            }
        },
        
        methods: {
            Likeclick({ id,liked }) {
              //if (!this.authorized) {
                  //alert('いいね機能を使うにはログインしてください。')
                  //return
              //}
              
              this.isLikedBy
              ? this.unlike(id)
              : this.like(id)
            },
            
            async like(id) {
                const response = await axios.put(this.endpoint)
                
                this.isLikeBy = true
                this.countLikes = response.data.countLikes
                this.gotToLike = true
            },
            
            
            async unlike() {
                const response = await axios.delete(this.endpoint)
                
                this.isLikedBy = false
                this.countLikes = response.data.countLikes
                this.gotToLike = false
            },
        },
    }
</script>
