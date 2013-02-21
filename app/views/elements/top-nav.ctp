<div class="page-title">
    <?php
    if (isset($type)) {
        switch ($type) {
            case "discussion" :
                echo $this->Html->link('<h2>add discussion</h2>', array('action' => 'add_discussion'), array('escape' => false));
                break;
            case "news":
                echo $this->Html->link('<h2>add news</h2>', array('action' => 'add_news'), array('escape' => false));
                break;
            case "advice":
                echo $this->Html->link('<h2>Ask the expert</h2>', array('action' => 'add_expert_advice'), array('escape' => false));
                break;
            case "sos":
                echo $this->Html->link('<h2>send SOS</h2>', array('action' => 'add_sos'), array('escape' => false));
                break;
            case "pinkup":
                echo $this->Html->link('<h2>Add Pink Me Up</h2>', array('action' => 'add_pink_me_up'), array('escape' => false));
                break;
            default :
                if ($this->params['controller'] != 'home') {
                    $comm = $this->Session->read('User.User.communities');
                    $commArray = explode(",", $comm);
                    if (in_array($type, $commArray)) {
                        echo $this->Html->link('<h2 class="unsubscribe">Unsubscribe</h2>', '#', array('escape' => false));
                    } else {
                        echo $this->Html->link('<h2 class="subscribe">Subscribe</h2>', '#', array('escape' => false));
                    }
                }
                break;
        }
    }
    ?>

</div>
<nav class="top-nav">
    <ul class="sf-menu">
        <li <?php if ($this->params['action'] == "sos" || $this->params['action'] == "view_sos"||$this->params['action'] == "edit_sos"||$this->params['action'] == "add_sos") echo 'class="active"'; ?>><?php echo $this->Html->link('SOS', array('action' => 'sos'), array('class' => 'pink')); ?></li>
        <li <?php if ($this->params['action'] == "news" || $this->params['action'] == "view_news"||$this->params['action'] == "edit_news"||$this->params['action'] == "add_news") echo 'class="active"'; ?>><?php echo $this->Html->link('News', array('action' => 'news')); ?></li>
        <li <?php if ($this->params['action'] == "discussions" || $this->params['action'] == "view"||$this->params['action'] == "edit_discussion"||$this->params['action'] == "add_discussion") echo 'class="active"'; ?>><?php echo $this->Html->link('Discussions', array('action' => 'discussions')); ?></li>
        <li <?php if ($this->params['action'] == "expert_advice" || $this->params['action'] == "view_advice"||$this->params['action'] == "edit_expert_advice"||$this->params['action'] == "add_expert_advice") echo 'class="active"'; ?>><?php echo $this->Html->link('Expert Advice', array('action' => 'expert_advice')); ?></li>
        <li <?php if ($this->params['action'] == "pink_me_ups" || $this->params['action'] == "view_pink_me_up"||$this->params['action'] == "edit_pink_me_up"||$this->params['action'] == "add_pink_me_up") echo 'class="active"'; ?>><?php echo $this->Html->link('Pink Me Up', array('action' => 'pink_me_ups')); ?></li>
        <li <?php if ($this->params['action'] == "index") echo 'class="active"'; ?>><?php echo $this->Html->link('All', array('action' => 'index')); ?></li>
    </ul>
</nav>
