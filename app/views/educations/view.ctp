<?php
//pr($post);
//pr($comments);
?>
<div class="widget_804">
    <div class="sos_div content-div">
        <div class="title">
            <h2><?php echo $post['PostDetail']['type'];?></h2>
            <?php //echo $this->Html->image("drop-down.png", array("alt" => "drop", 'url' => array('controller' => 'educations', 'action' => 'index'))); ?>
            <div class="extra-actions">
                    <?php
            $id=$this->Session->read('User.User.id');
            if ($post['Post']['user_id'] == $id) {
                
                echo $this->Html->image("drop-down.png", array("alt" => "drop",'class'=>'drop-down' ,'url' =>"#"));
            
            ?>
                    <div class="action-list">
                        <ul>
                            <li><?php 
                            if($post['PostDetail']['type']=='discussion'){
                            
                               echo $this->Html->link('Edit',array('controller'=>'educations','action'=>'edit_discussion',$post['Post']['id']));
                            
                            }else{
                                echo $this->Html->link('Edit',array('controller'=>'educations','action'=>'edit_news',$post['Post']['id']));
                            }
                                ?></li>
                            <li><?php echo $this->Html->link('Delete',array('controller'=>'educations','action'=>'delete',$post['Post']['id'])); ?></li>
                            <li><a href="#">Flag Post</a></li>
                        </ul>
                    </div><?php } ?>
                </div>
        </div>
        <div class="info">
            <div class="heading">
                <?php echo $this->Html->image("center-profile-pic.jpg"); ?>
                <div class="inner-heading">
                    <div class="left">
                        <p><?php echo $post['User']['username'] ?></p>
                        <span><?php echo $post['User']['role'] ?></span>
                    </div>
                    <div class="right">
                        <p><?php echo $post['PostDetail']['related_to']; ?></p>
                        <span><?php 
                        $timeTook=$this->Time->timeAgoInWords( $post['Post']['created']);
                        $roundOff= strpos($timeTook,',');
                        if($roundOff){
                            echo substr( $timeTook,0,strpos($timeTook,','))." ago";
                        }else{
                            echo $timeTook;
                        }
                        ?></span> 
                    </div>
                </div>
            </div>
            <div class="content">
                <h4><?php echo $post['Post']['topic']; ?></h4>
                
                <?php if(!empty($post['Post']['image_url'])){
                    
                    echo "<div class=post_image><img src=".$post['Post']['image_url']."></div>";
                    echo "<div class='post_video'>".$post['Post']['video_url']."</div>";
                }elseif(!empty($post['Post']['video_url'])){
                    echo "<div class='post_video'>".$post['Post']['video_url']."</div>";
                }
                 ?>
                <p><?php echo $post['Post']['post']; ?></p>

            </div>

            <div class="notification-div">

                <ul class="counting">
                    <li><span><?php echo $commentCount = count($post['Comment']); ?></span></li>
                    <li><span><?php echo $post['PostDetail']['total_views']; ?></span></li>
                    <li><span><?php echo $post['PostDetail']['total_shares']; ?></span></li>
                    <li><span class="beat-counter"><?php echo $beats = count($post['Heartbeat']); ?></span></li>
                </ul>
                <div class="option-menu">
                    <nav class="options">
                        <ul>
                            <li><?php echo $this->Html->image("comment-icon.png", array("alt" => "comments", 'url' => '#CommentComment')); ?></li>
                            <li><?php echo $this->Html->image("icon-02.png", array("alt" => "view", 'class' => 'view', 'title' => $post['PostDetail']['total_views'])); ?></li>
                            <li><a href="#share-this" class="share"><?php echo $this->Html->image("share-icon.png", array("alt" => "share")); ?></a></li>
                            <li><?php
                $beats = $post['Heartbeat'];

                function beat_check($beats, $userId) {
                    foreach ($beats as $key => $beat) {
                        if ($beat['user_id'] == $userId)
                            return $userId;
                    }
                    return false;
                }

                $userBeat = beat_check($beats, $this->Session->read('User.User.id'));


                if ($userBeat) {
                    echo $this->Html->image("beat-on.png", array('id' => $post['Post']['id'], "alt" => "profile", 'title' => $beats, 'class' => 'like target image-swap on'));
                } else {
                    echo $this->Html->image("beat-off.png", array('id' => $post['Post']['id'], "alt" => "profile", 'title' => $beats, 'class' => 'like target image-swap'));
                }
                ?></li><div class="like-back"></div>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <?php
    if (isset($comments)) {
        foreach ($comments as $comment) {
            ?>                       
            <div class="sos_div content-div">
                <div class="title">
                    <?php echo $this->Html->image("drop-down.png", array("alt" => "drop", 'url' => array('controller' => 'educations', 'action' => 'index'))); ?>
                </div>
                <div class="info">
                    <div class="heading diff_heading">
                        <?php echo $this->Html->image("center-profile-pic.jpg"); ?>
                        <div class="inner-heading">
                            <div class="left">
                                <p><?php echo $comment['User']['username']; ?>&nbsp<span>,<?php echo $comment['User']['role']; ?></span></p>

                            </div>
                            <div class="right">
                                <span><?php 
                        $timeTook=$this->Time->timeAgoInWords($comment['Comment']['created']);
                        $roundOff= strpos($timeTook,',');
                        if($roundOff){
                            echo substr( $timeTook,0,strpos($timeTook,','))." ago";
                        }else{
                            echo $timeTook;
                        }
                        ?></span> 
                            </div>
                            <div class="content">
                                <p>
                                    <?php echo $comment['Comment']['comment']; ?>
                                </p>
                            </div>

                        </div>
                    </div>



                </div>
            </div>

        <?php
        }
    }
    ?>
    <div class="add-comment">
        <?php
        
        echo $form->create('Comment', array('url' => array('controller' => 'educations', 'action' => 'add_comment')));
        echo $form->hidden('post_id', array('value' => $post['Post']['id']));
        echo $form->hidden('user_id', array('value' => $this->Session->read('User.User.id')));
        echo $form->hidden('type', array('value' => $post['PostDetail']['type']));
        echo $form->input('comment', array('type' => 'textarea', 'div' => false, 'label' => false));
        echo $form->submit("Comment", array('class' => 'button', 'div' => false));
        ?>
    </div>
</div>
<div class="hidden-elements" style="display: none;">
    <div id="share-this">
        <span class='st_facebook_large' displayText='Facebook'></span>
        <span class='st_twitter_large' displayText='Tweet'></span>
        <span class='st_linkedin_large' displayText='LinkedIn'></span>
        <span class='st_pinterest_large' displayText='Pinterest'></span>
        <span class='st_email_large' displayText='Email'></span>
        <span class='st_sharethis_large' displayText='ShareThis'></span>
        <script>
   
           $.getScript("http://w.sharethis.com/button/button.js",function(){
               var switchTo5x=true;
               stLight.options({publisher: "ur-f3b5f3ea-6a8b-185-941a-e61efe83a432", doNotHash: false, doNotCopy: false, hashAddressBar: true});    
           });
   
       </script>

    </div>
    
</div>
<script>
    
    $(document).ready(function(){
        $('.like').live('click',function(){
            var id =$(this).attr('id');
            
            
            $.post("<?php echo $this->base; ?>/fashions/add_beat",{
                data:{Heartbeat:{post_id:<?php echo $post['Post']['id']; ?>,user_id:<?php echo $this->Session->read('User.User.id'); ?>}}
            },
            function(data){
                $(".beat-counter").html(data);
            }
        );       
            
            if ($(this).attr("class").indexOf("on")>0) {
                this.src = this.src.replace("-on","-off");
            } else {
                this.src = this.src.replace("-off","-on");
            }
            $(this).toggleClass("on");
        }
    );
    
    

       

             $(".share").colorbox({inline:true,opacity:'0.15'});    
        

    });
</script>

