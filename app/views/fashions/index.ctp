<?php
//pr($posts);
foreach ($posts as $post) {
    ?>
    <div class="sos_div content-div">

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
                echo $this->Html->link($post['Post']['topic'], array('controller' => 'fashions', 'action' => 'view_sos', $post['Post']['id']));
            } elseif ($post['PostDetail']['type'] == 'expert advice') {
                echo $this->Html->link($post['Post']['topic'], array('controller' => 'fashions', 'action' => 'view_advice', $post['Post']['id']));
            }elseif ($post['PostDetail']['type'] == 'pink up') {
                echo $this->Html->link($post['Post']['topic'], array('controller' => 'fashions', 'action' => 'view_pink_me_up', $post['Post']['id']));
            } 
            else {
                echo $this->Html->link($post['Post']['topic'], array('controller' => 'fashions', 'action' => 'view', $post['Post']['id']));
            }
                ?></h4>
                <p><?php echo $this->Text->truncate($post['Post']['post'], '150', array('ending' => '...', 'exact' => false)); ?>...</p>


            </div>
            <div class="notification-div">
                <ul class="counting">
                                        <li><span><?php echo $comments=count($post['Comment']);?></span></li>
                                        <li><span><?php echo $post['PostDetail']['total_views'];?></span></li>
                                        <li><span><?php echo $post['PostDetail']['total_shares'];?></span></li>
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
                        }else{
                            echo $this->Html->image("icon-02.png", array("alt" => "view-icon",'class'=>'view target','title'=>$post['PostDetail']['total_views'], 'url' => array('controller' => 'fashions', 'action' => 'view', $post['Post']['id']))); 
                        }
                            ?></li>
                        <li><?php echo $this->Html->image("share-icon.png", array("alt" => "share-icon", 'url' => array('controller' => 'fashions', 'action' => 'index'))); ?></li>
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
    });
</script>