<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>ROP :: Index Page</title>

        <?php echo $this->Html->script('jquery'); ?>
        <?php echo $this->Html->script('minijs-notification');?>
        <?php echo $this->Html->script('WEB_ROOT'.'js/ckeditor/ckeditor'); ?>

        <!-- Scripts -->
        <!--[if lt IE 9]>
        
        <?php echo $this->Html->css('ie'); ?>
        <?php echo $this->Html->script('modernizr'); ?>
       <?php echo $this->Html->script('WEB_ROOT'.'js/ckeditor/ckeditor'); ?>
            <![endif]--> 	
        
        <?php echo $this->Html->css('colorbox'); ?>
        <?php echo $this->Html->css(array('reset', 'main', 'fonts/fonts', 'super-fish', 'responsive')); ?>

        <?php echo $this->Html->script('colorbox'); ?>
        <script type="text/javascript">var switchTo5x=true;</script>
        <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
        <script type="text/javascript">stLight.options({publisher: "ur-f3b5f3ea-6a8b-185-941a-e61efe83a432", doNotHash: false, doNotCopy: false, hashAddressBar: true});</script>
    </head>
    <body>
        <div id="pagewidth">
            <div class="two-col">
                <div class="left-col">
                    <div class="logo">
                        <?php echo $this->Html->image("logo.png", array("alt" => "logo", 'url' => array('controller' => 'home', 'action' => 'index'))); ?>
                    </div>

                    <div class="right-board">
                        <h3>bulletin board</h3>
                        <?php echo $this->Html->image("map-board.jpg",array('url'=>array('controller'=>'fashions','action'=>'coming_soon'))); ?>
                    </div>
                    <div class="advertisement">
                        <?php echo $this->Html->image("ad.jpg"); ?>
                    </div>
                    <div class="right-bottom">
                        <?php echo $this->Html->image("passport-book.png"); ?>
                        <?php echo $this->Html->link('<span>1</span>',array('controller'=>'fashions','action'=>'coming_soon'),array('class'=>'notification','escape'=>false)); ?>
                    </div>
                </div>

                <div class="right-col">
                    <div class="widget_577">
                        <div class="search">
                            <input type="button" class="search_button" value="&nbsp;">
                            <input type="search" class="text">
                        </div>
                        <div class="second-row">
                            <?php echo $this->element('top-nav',array('type'=>$type)); ?>
                            <?php echo $this->Session->flash(); ?>
                        </div>
                    </div>
                    <div class="widget_195">
                        <div class="top-info">
                        <?php if(Authsome::get()){ ?>
                            <?php echo $this->Html->image("small-profile.jpg"); ?>
                            <p><?php echo $this->Session->read('User.User.username'); ?></p>
                            <span><?php echo $this->Session->read('User.User.role'); ?></span>
                        </div>    
                                <div class="line">
                                <?php echo $this->Html->image("line.jpg", array("alt" => "line")); ?>

                            </div>
                            <div class="logout">
                                <?php echo $this->Html->image("log-out.png", array("alt" => "logo", 'url' => array('controller' => 'users', 'action' => 'logout'))); ?>

                            </div>
                        <?php } ?>    
                        
                    </div>
                    <?php echo $content_for_layout ?>


                </div>
                <nav class="main-menu">
                    <?php echo $this->element('footer-nav'); ?>
                </nav>
            </div>
        </div>   

            
        <?php
        echo $this->Js->writeBuffer();
        //echo $this->element('sql_dump'); ?>
    </body>
</html>
