  
  $(function(){
      var $like = $('.btn-like'), //いいねボタンセレクト
                  likePostId; //投稿ID
      $like.on('click',function(e){
          e.stopPropagation();
          var $this = $(this);
          //カスタム属性(postid)に格納された投稿ID取得する
          likePostId = $this.parents('.post').date('postid');
          $.ajax({
              type: 'POST',
              url: 'ajaxLike.php', //post送信を受け取るphpアフィル
              data: { postId: likePostId } //{キー:投稿ID}
          }).done(function(data){
              console.log('Ajax Success');
              
              //いいねの総数を表示する
              $this.children('span').html(data);
              
              //いいねの取り消しスタイル
              $this.children('i').toggleClass('far'); //空洞のハート
              
              //いいね押した時のスタイル
              $this.children('i').toggleClass('fas'); //塗りつぶしハート
              $this.children('i').toggleClass('active');
              $this.toggleClass('active');
          }).fail(function(msg) {
              console.log('Ajax Error');
          });
      });
  });
  