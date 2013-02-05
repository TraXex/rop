<?php
$this->Session->read('User.User.user_group_id');
//pr($post);
//pr($advices);
//pr($comments);
?>
<div class="widget_804">
    <div class="sos_div content-div">
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
                        <span>1 hour ago</span>  
                    </div>
                </div>
            </div>
            <div class="content">
                <h4><?php echo $post['Post']['topic']; ?></h4>
                <p><?php echo $post['Post']['post']; ?></p>

            </div>
            <div class="comment-div">
                <h3>Advice</h3>
                <ul>
                    <?php foreach ($advices as $advice) { ?>                       
                        <li>
                            
                            <?php echo $this->Html->image("center-profile-pic.jpg"); ?>
                            <h3><?php echo $advice['User']['username'];?></h3>
                            <p><?php echo $advice['Advice']['advice']; ?></p>
                        </li>
                    </ul>
                <?php }
                ?>
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
                        <li><?php echo $this->Html->image("comment-icon.png", array("alt" => "profile", 'url' => '#CommentComment')); ?></li>

                        <li><?php echo $this->Html->image("share-icon.png", array("alt" => "profile", 'url' => array('controller' => 'fashions', 'action' => 'index'))); ?></li>
                        <li><?php echo $this->Html->image("beat-off.png", array('id' => $post['Post']['id'], "alt" => "profile", 'class' => 'like')); ?><div class="like-back"></div>
                    </ul>
                </nav>
            </div>
            </div>
        </div>
    </div>

    

<?php 
if(!empty($comments)){
foreach ($comments as $comment) { ?>                       
        <div class="sos_div content-div">
            <div class="title">
    <?php echo $this->Html->image("drop-down.png", array("alt" => "drop", 'url' => array('controller' => 'fashions', 'action' => 'index'))); ?>
            </div>
            <div class="info">
                <div class="heading diff_heading">
    <?php echo $this->Html->image("center-profile-pic.jpg"); ?>
                    <div class="inner-heading">
                        <div class="left">
                            <p><?php echo $comment['User']['username']; ?>&nbsp<span>,<?php echo $comment['User']['role']; ?></span></p>

                        </div>
                        <div class="right">
                            <span>1 hour ago</span>  
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

    <?php }}
    ?>
    <?php
    if ($this->Session->read('User.User.user_group_id') == '1') {
        ?>

        <div class="add-comment">
            <?php
            echo $form->create('Advice', array('url' => array('controller' => 'fashions', 'action' => 'add_advice_reply')));
            echo $form->hidden('post_id', array('value' => $post['Post']['id']));
            echo $form->hidden('user_id', array('value' => $this->Session->read('User.User.id')));
            echo $form->hidden('type', array('value' => $post['PostDetail']['type']));
            echo $form->input('advice', array('type' => 'textarea', 'div' => false, 'label' => false));
            echo $form->submit("Advice", array('class' => 'button', 'div' => false));
            ?>
        </div>
        <?php
    } else {
        ?>
        <div class="add-comment">
            <?php
            echo $form->create('Comment', array('url' => array('controller' => 'fashions', 'action' => 'add_comment')));
            echo $form->hidden('post_id', array('value' => $post['Post']['id']));
            echo $form->hidden('user_id', array('value' => $this->Session->read('User.User.id')));
            echo $form->hidden('type', array('value' => $post['PostDetail']['type']));
            echo $form->input('comment', array('type' => 'textarea', 'div' => false, 'label' => false));
            echo $form->submit("Comment", array('class' => 'button', 'div' => false));
            ?>
        </div>
        <?php
    }
    ?>
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
    

    });
</script>