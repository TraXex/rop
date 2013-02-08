<?php
//pr($post);
//pr($replies);
?>
<div class="widget_804">
    <div class="sos_div ">
        <div class="title">
            <h2><?php echo $post['PostDetail']['type']; ?></h2>
            <?php echo $this->Html->image("drop-down.png", array("alt" => "drop", 'url' => array('controller' => 'fashions', 'action' => 'index'))); ?>
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
                <p><?php echo $post['Post']['post']; ?></p>

            </div>
            <div class="notification-div">
                <ul class="counting">
                    <li><span><?php echo $comments = count($post['Reply']); ?></span></li>
                    <li><span><?php echo $post['PostDetail']['total_views']; ?></span></li>
                 <!--   <li><span><?php echo $post['PostDetail']['total_shares']; ?></span></li>
                    <li><span><?php echo $beats = count($post['Heartbeat']); ?></span></li>
               -->
                 </ul>


            <div class="option-menu">
                <nav class="options">
                    <ul>
                        <li><?php echo $this->Html->image("comment-icon.png", array("alt" => "profile", 'url'=>'#CommentComment')); ?></li>
                        <li><?php echo $this->Html->image("icon-02.png", array("alt" => "view-icon",'class'=>'view target','title'=>$post['PostDetail']['total_views'], 'url' => array('controller' => 'fashions', 'action' => 'index'))); ?></li>
                    <!--    <li><?php echo $this->Html->image("share-icon.png", array("alt" => "profile", 'url' => array('controller' => 'fashions', 'action' => 'index'))); ?></li>
                        <li><?php echo $this->Html->image("beat-off.png",array('id'=>$post['Post']['id'],"alt" => "profile", 'class' => 'like')); ?><div class="like-back"></div>
                    -->
                    </ul>
                </nav>
            </div>
            </div>
        </div>
    </div>
    <?php foreach ($replies as $reply) { ?>                       
        <div class="sos_div content-div">
            <div class="title">
                <?php echo $this->Html->image("drop-down.png", array("alt" => "drop", 'url' => array('controller' => 'fashions', 'action' => 'index'))); ?>
            </div>
            <div class="info">
                <div class="heading diff_heading">
                    <?php echo $this->Html->image("center-profile-pic.jpg"); ?>
                    <div class="inner-heading">
                        <div class="left">
                            <p><?php echo $reply['User']['username']; ?>&nbsp<span>,<?php echo $reply['User']['role']; ?></span></p>

                        </div>
                        <div class="right">
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
                        <div class="content">
                            <p>
                                <?php echo $reply['Reply']['reply']; ?>
                            </p>
                            

                        </div>
                        

                    </div>
                    <div class="helpful">
                        <?php if (empty($reply['Reply']['useful'])) {
                        
                            
                                    $id = $this->Session->read('User.User.id');
                                    $replyId = $reply['Reply']['id'];
                                    if ($post['Post']['user_id'] == $id) {
                                        ?>
                                <ul>
                                    <li><?php echo $this->Html->image("thumbs-up.jpg", array("alt" => $replyId, "class" => 'yes', "height" => "20")); ?></li>
                                    <li><?php echo $this->Html->image("thumbs-down.jpg", array("alt" => $replyId, "class" => 'no', "height" => "20")); ?></li>                            
                                </ul>
                            <?php }
                        } ?>
                    </div>
                </div>
                <?php
                    if ($reply['Reply']['useful'] == 'yes') {?>
                <div class="pink-up-button">
                                This pinked me up
                            </div>
                <?php }?>

            </div>
        </div>

    <?php }
    ?>
    <div class="add-comment">
        <?php
        echo $form->create('Reply', array('url' => array('controller' => 'fashions', 'action' => 'add_pink_me_up_reply')));
        echo $form->hidden('post_id', array('value' => $post['Post']['id']));
        echo $form->hidden('user_id', array('value' => $this->Session->read('User.User.id')));
        echo $form->hidden('type', array('value' => $post['PostDetail']['type']));
        echo $form->input('reply', array('type' => 'textarea', 'div' => false, 'label' => false));
        echo $form->submit("Reply", array('class' => 'button', 'div' => false));
        ?>
    </div>
</div>
<script>
    
    $(document).ready(function(){
        $('.like').click(function(){
            var id =$(this).attr('id');
            
            var newDiv = $(this).parent().find('.like-back');
            $.post("<?php echo $this->base; ?>/fashions/add_beat",{
                data:{Heartbeat:{post_id:<?php echo $post['Post']['id']; ?>,user_id:<?php echo $post['User']['id']; ?>}}
            },
            function(data){
                $(newDiv).html(data);
                console.log(data)
            }
        );       
        }
    );
    
    $('.yes').click(function(){
        var id =$(this).attr('alt');
        $.post("<?php echo $this->base; ?>/fashions/sos_useful",{
            data:{
                Reply:{reply_id:id,useful:"yes"}
            }
        });
        $(this).parent().siblings().children().css('display','none');
    });
    
    $('.no').click(function(){
        var id =$(this).attr('alt');
        $.post("<?php echo $this->base; ?>/fashions/sos_useful",{
            data:{
                Reply:{reply_id:id,useful:"no"}
            }
        });
        $(this).parent().siblings().children().css('display','none');
    });

    });
</script>