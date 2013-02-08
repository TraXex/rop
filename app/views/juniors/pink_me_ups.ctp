<?php 

foreach ($posts as $post) {
?>
    <div class="sos_div content-div">
        
        <div class="title">
            <h2><?php echo $post['PostDetail']['type'];?></h2>
            <?php echo $this->Html->image("drop-down.png", array("alt" => "drop", 'url' => array('controller' => 'juniors', 'action' => 'index'))); ?>

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
                <p><?php echo $this->Html->link($post['Post']['topic'],array('controller'=>'juniors','action'=>'view_pink_me_up',$post['Post']['id'])); ?></p>
                
            </div>
            <div class="comment-div">
                <ul>                    
                    <?php $i=0;
                    foreach ($post['Advice'] as $advice) {
                        
                        if($i<2){
                        ?>

                        <li>
                            <?php echo $this->Html->image("center-profile-pic.jpg"); ?>
                            <h3><?php $userId=$advice['user_id'];echo $users[$userId]['User']['username']  ?></h3>
                            
                            <p><?php echo $this->Text->truncate($advice['advice'], '150', array('ending' => '...', 'exact' => false)); ?>...</p>
                        </li>
    <?php }
    $i++;
    } ?>
                </ul>
                
                <?php echo $this->Html->link('View Advice',array('controller'=>'juniors','action'=>'view_pink_me_up',$post['Post']['id'])); ?>
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
                        <li><?php echo $this->Html->image("comment-icon.png", array("alt" => "profile", 'url' => array('controller' => 'juniors', 'action' => 'index'))); ?></li>
                        <li><?php echo $this->Html->image("icon-02.png", array("alt" => "profile", 'url' => array('controller' => 'juniors', 'action' => 'index'))); ?></li>
                       <!-- <li><?php echo $this->Html->image("share-icon.png", array("alt" => "profile", 'url' => array('controller' => 'juniors', 'action' => 'index'))); ?></li>
                        <li><?php echo $this->Html->image("beat-off.png", array("alt" => "profile", 'url' => array('controller' => 'juniors', 'action' => 'index'))); ?></li>
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