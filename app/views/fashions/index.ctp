<?php
//pr($posts);
foreach ($posts as $post) {
    ?>
    <div class="sos_div <?php if($post['PostDetail']['type']!='sos') echo "content-div"; ?>">

        <div class="title">
            <h2><?php echo $post['PostDetail']['type']; ?></h2>
            <?php // echo $this->Html->image("drop-down.png", array("alt" => "drop", 'url' => array('controller' => 'fashions', 'action' => 'index'))); ?>

        </div>
        <div class="info">
            <div class="heading">

                <?php echo $this->Html->image("center-profile-pic.jpg"); ?>
                <div class="inner-heading">
                    <div class="left">
                        <p><?php echo $post['User']['username']; ?></p>
                        <span><?php echo $post['User']['role']; ?></span>
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
                <h4><?php
            if ($post['PostDetail']['type'] == 'sos') {
                echo $this->Html->link($post['Post']['topic'], array('controller' => 'fashions', 'action' => 'view_sos', $post['Post']['id']), array('escape' => false));
            } elseif ($post['PostDetail']['type'] == 'expert advice') {

                echo $this->Html->link($post['Post']['topic'], array('controller' => 'fashions', 'action' => 'view_advice', $post['Post']['id']),array('escape' => false));
            }elseif ($post['PostDetail']['type'] == 'pink up') {
                echo $this->Html->link($post['Post']['topic'], array('controller' => 'fashions', 'action' => 'view_pink_me_up', $post['Post']['id']),array('escape' => false));
            }elseif ($post['PostDetail']['type'] == 'news') {
                echo $this->Html->link($post['Post']['topic'], array('controller' => 'fashions', 'action' => 'view_news', $post['Post']['id']),array('escape' => false));
            } 
            else {

                echo $this->Html->link($post['Post']['topic'], array('controller' => 'fashions', 'action' => 'view', $post['Post']['id']));
            }
                ?></h4>
                <p><?php 
                $content = $post['Post']['post'];
                        $clearText = preg_replace("/<img[^>]+\>|<object[^>]+\>/i", " ", $content);
                        //echo $content;                
                        //echo $clearText;
                        echo $this->Text->truncate($clearText, '150', array('ending' => '...', 'exact' => false));
                ?></p>

            </div>
            <?php
            if ($post['PostDetail']['type'] == 'discussion'||$post['PostDetail']['type'] == 'news'||$post['PostDetail']['type'] == 'expert advice') { ?>
            <div class="comment-div">
                <ul>                    
                    <?php $i=0;
                    foreach ($post['Comment'] as $comment) {
                        
                        if($i<2){
                        ?>

                        <li>
                            <?php echo $this->Html->image("center-profile-pic.jpg"); ?>
                            <h3><?php $userId=$comment['user_id'];echo $users[$userId]['User']['username']  ?></h3>
                            <p><?php echo $comment['comment']; ?></p>
                        </li>
    <?php }
    $i++;
    } ?>
                </ul>
                
                <?php
            if ($post['PostDetail']['type'] == 'sos') {
                echo $this->Html->link('view more replies', array('controller' => 'fashions', 'action' => 'view_sos', $post['Post']['id']), array('escape' => false));
            } elseif ($post['PostDetail']['type'] == 'expert advice') {

                echo $this->Html->link('view more comments', array('controller' => 'fashions', 'action' => 'view_advice', $post['Post']['id']),array('escape' => false));
            }
            elseif ($post['PostDetail']['type'] == 'pink up') {
                echo $this->Html->link('view more replies', array('controller' => 'fashions', 'action' => 'view_pink_me_up', $post['Post']['id']),array('escape' => false));
            }elseif ($post['PostDetail']['type'] == 'news') {
                echo $this->Html->link('view more comments', array('controller' => 'fashions', 'action' => 'view_news', $post['Post']['id']),array('escape' => false));
            } 
            else {

               
                echo $this->Html->link('view more comments', array('controller' => 'fashions', 'action' => 'view', $post['Post']['id']));
            }
                ?>
            </div>
            <?php } else {?>
        <div class="comment-div">
                <ul>                    
                    <?php $i=0;
                    foreach ($post['Reply'] as $reply) {
                        
                        if($i<2){
                        ?>

                        <li>
                            <?php echo $this->Html->image("center-profile-pic.jpg"); ?>
                            <h3><?php $userId=$reply['user_id'];echo $users[$userId]['User']['username']  ?></h3>
                            <p><?php echo $reply['reply']; ?></p>
                        </li>
    <?php }
    $i++;
    } ?>
                </ul>
                
                <?php
            if ($post['PostDetail']['type'] == 'sos') {
                echo $this->Html->link('view more replies', array('controller' => 'fashions', 'action' => 'view_sos', $post['Post']['id']), array('escape' => false));
            } elseif ($post['PostDetail']['type'] == 'expert advice') {

                echo $this->Html->link('view more comments', array('controller' => 'fashions', 'action' => 'view_advice', $post['Post']['id']),array('escape' => false));
            }
            elseif ($post['PostDetail']['type'] == 'pink up') {
                echo $this->Html->link('view more replies', array('controller' => 'fashions', 'action' => 'view_pink_me_up', $post['Post']['id']),array('escape' => false));
            }elseif ($post['PostDetail']['type'] == 'news') {
                echo $this->Html->link('view more comments', array('controller' => 'fashions', 'action' => 'view_news', $post['Post']['id']),array('escape' => false));
            } 
            else {

               
                echo $this->Html->link('view more comments', array('controller' => 'fashions', 'action' => 'view', $post['Post']['id']));
            }
                ?>
            </div>
        <?php } ?>
        
            
            <div class="notification-div">
                <ul class="counting">
                                        <li><span><?php 
                                        if ($post['PostDetail']['type'] == 'sos') {
                echo $comments=count($post['Reply']);
            } elseif ($post['PostDetail']['type'] == 'expert advice') {
                echo $comments=count($post['Comment']);
            }elseif ($post['PostDetail']['type'] == 'pink up') {
                echo $comments=count($post['Reply']);
            } 
            else {
                echo $comments=count($post['Comment']);
            }
                                        ?></span></li>
                                        <li><span><?php echo $post['PostDetail']['total_views'];?></span></li>
                                  <!--      <li><span><?php echo $post['PostDetail']['total_shares'];?></span></li>-->
                                        <li><span><?php echo $beats=count($post['Heartbeat']); ?></span></li>
                                    </ul>
            <div class="option-menu">
                <nav class="options">
                    <ul>
                        <li><?php 
                        if ($post['PostDetail']['type'] == 'sos') {
                echo $this->Html->image("comment-icon.png", array("alt" => "comment-icon",'class'=>'comment target','title'=>$comments, 'url' => array('controller' => 'fashions', 'action' => 'view_sos', $post['Post']['id'])));
            } elseif ($post['PostDetail']['type'] == 'expert advice') {
                echo $this->Html->image("comment-icon.png", array("alt" => "comment-icon",'class'=>'comment target','title'=>$comments, 'url' => array('controller' => 'fashions', 'action' => 'view_advice', $post['Post']['id'])));
            }elseif ($post['PostDetail']['type'] == 'pink up') {
                echo $this->Html->image("comment-icon.png", array("alt" => "comment-icon",'class'=>'comment target','title'=>$comments, 'url' => array('controller' => 'fashions', 'action' => 'view_pink_me_up', $post['Post']['id'])));
            } elseif ($post['PostDetail']['type'] == 'news') {
                echo $this->Html->image("comment-icon.png", array("alt" => "comment-icon",'class'=>'comment target','title'=>$comments, 'url' => array('controller' => 'fashions', 'action' => 'view_news', $post['Post']['id'])));
            } 
            else {
                echo $this->Html->image("comment-icon.png", array("alt" => "comment-icon",'class'=>'comment target','title'=>$comments, 'url' => array('controller' => 'fashions', 'action' => 'view', $post['Post']['id'])));
            }
                        
                        
             ?></li>
                        <li><?php
                        if ($post['PostDetail']['type']== 'sos'){
                                echo $this->Html->image("icon-02.png", array("alt" => "view-icon",'class'=>'view target','title'=>$post['PostDetail']['total_views'], 'url' => array('controller' => 'fashions', 'action' => 'view_sos', $post['Post']['id']))); 
                        }elseif ($post['PostDetail']['type']== 'expert advice'){
                                echo $this->Html->image("icon-02.png", array("alt" => "view-icon",'class'=>'view target','title'=>$post['PostDetail']['total_views'], 'url' => array('controller' => 'fashions', 'action' => 'view_advice', $post['Post']['id']))); 
                        }elseif ($post['PostDetail']['type']== 'pink up'){
                                echo $this->Html->image("icon-02.png", array("alt" => "view-icon",'class'=>'view target','title'=>$post['PostDetail']['total_views'], 'url' => array('controller' => 'fashions', 'action' => 'view_pink_me_up', $post['Post']['id']))); 
                        }elseif ($post['PostDetail']['type']== 'news'){
                                echo $this->Html->image("icon-02.png", array("alt" => "view-icon",'class'=>'view target','title'=>$post['PostDetail']['total_views'], 'url' => array('controller' => 'fashions', 'action' => 'view_news', $post['Post']['id']))); 
                        }
                        else
                            {
                            echo $this->Html->image("icon-02.png", array("alt" => "view-icon",'class'=>'view target','title'=>$post['PostDetail']['total_views'], 'url' => array('controller' => 'fashions', 'action' => 'view', $post['Post']['id']))); 
                        }
                            ?></li>
                 <!--       <li><?php echo $this->Html->image("share-icon.png", array("alt" => "share-icon")); ?></li>-->
                        <li><?php $beats=count($post['Heartbeat']); echo $this->Html->image("beat-off.png", array('id' => $post['Post']['id'], "alt" => "beat-icon",'title'=>$beats, 'class' => 'like target'));?><div class="like-back"></div></li>
                    
                    </ul>
                </nav>

            </div>
            </div>  
        </div>

     </div>

<?php }
?>
<div class="pagenation">
    <?php echo $this->Paginator->prev('<Previous', array(), null, array('class' => 'prev disabled', 'span' => false)); ?>   
    <div class="numbers">
        <?php echo $this->Paginator->numbers(array('first' => 'First page', array('class' => 'numbers'))); ?>                
    </div>
    <?php echo $this->Paginator->next('Next>', array(), null, array('class' => 'next disabled')); ?>
</div>
<script>
    $(document).ready(function(){
     $('.subscribe').click(function(){
         $.post("<?php echo $this->base; ?>/fashions/subscribe",
         { data:{community:'fashion'}},
         function(data){
                $(".subscribe").html(data);
            }
     );
     });
     
     $('.unsubscribe').click(function(){
         $.post("<?php echo $this->base; ?>/fashions/unsubscribe",
         { data:{community:'fashion'}},
         function(data){
                $(".unsubscribe").html(data);
            }
     );
     });
    });
</script>