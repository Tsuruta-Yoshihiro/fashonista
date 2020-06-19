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
       {{ likescount }}
   </div>
</template>

<script>
    export default {
        props: {
            initialIsLikedBy: {
                
                type: Boolean,
                default: false,
            },
            
            initialLikesCount: {
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
            isLikedBy: this.initialIsLikedBy,
            likescount: this.initialLikesCount,
            gotToLike: false,
            }
        },
        
        methods: {
            Likeclick() {
              if (!this.authorized) {
                  alert('いいね機能を使うにはログインしてください。')
                  return
              }
              
              this.isLikedBy
              ? this.unlike()
              : this.like()
            },
            
            async like() {
                const response = await axios.put(this.endpoint)

                
                this.isLikedBy = true
                this.likesCount = response.data.likesCount
                this.gotToLike = true
            },
            
            
            async unlike() {
                const response = await axios.delete(this.endpoint)
                
                this.isLikedBy = false
                this.likesCount = response.data.likesCount
                this.gotToLike = false
            },
        },
    }
</script>
