<?php 

foreach ($posts as $post) {
?>
    <div class="sos_div">
        
        <div class="title">
            <h2><?php echo $post['PostDetail']['type'];?></h2>
            <?php //echo $this->Html->image("drop-down.png", array("alt" => "drop", 'url' => array('controller' => 'seniors', 'action' => 'index'))); ?>

        </div>
        <div class="info">
            <div class="heading">

                <?php echo $this->Html->image("center-profile-pic.jpg"); ?>
                <div class="inner-heading">
                    <div class="left">
                        <p><?php echo $post['User']['username'];?></p>
                        <span><?php echo $post['User']['role'];?></span>
                    </div>
                    <div class="right">
                        <p><?php echo $post['PostDetail']['related_to'];?></p>
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
                <p><?php echo $this->Html->link($post['Post']['topic'],array('controller'=>'seniors','action'=>'view_sos',$post['Post']['id']), array('escape' => false)); ?></p>
                
            </div>
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
                
                <?php echo $this->Html->link('View more comments',array('controller'=>'seniors','action'=>'view_sos',$post['Post']['id'])); ?>
            </div>
            <div class="notification-div">
                <ul class="counting">
                                        <li><span><?php echo $comments=count($post['Reply']);?></span></li>
                                        <li><span><?php echo $post['PostDetail']['total_views'];?></span></li>
                                    <!--    <li><span><?php echo $post['PostDetail']['total_shares'];?></span></li>
                                        <li><span><?php echo $beats=count($post['Heartbeat']); ?></span></li>
                                    -->
                                    </ul>
            <div class="option-menu">
                <nav class="options">
                    <ul>
                        <li><?php
                        if ($post['PostDetail']['type']== 'sos'){
                         echo $this->Html->image("comment-icon.png", array("alt" => "comment-icon",'class'=>'comment target','title'=>$comments, 'url' => array('controller' => 'cookings', 'action' => 'view_sos', $post['Post']['id'])));
                        }?></li>
                        <li><?php echo $this->Html->image("icon-02.png"); ?></li>
                   <!--     <li><?php echo $this->Html->image("share-icon.png", array("alt" => "profile", 'url' => array('controller' => 'seniors', 'action' => 'index'))); ?></li>
                        <li><?php echo $this->Html->image("beat-off.png", array("alt" => "profile", 'url' => array('controller' => 'seniors', 'action' => 'index'))); ?></li>
                   --> 
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