<ul class="sf-menu">
    <li <? if($this->params['controller'] == "home") echo ''; ?>class="pink"><?php echo $this->Html->image("home-icon.png", array("alt" => "logo", 'url' => array('controller' => 'home', 'action' => 'index'))); ?></li>
    <li><?php echo $this->Html->link('Events',array('controller'=>'fashions','action'=>'coming_soon')); ?></li>
    <li <? if($this->params['controller'] == "fashions") echo 'class="active"'; ?>><?php echo $this->Html->link('Fashion',array('controller'=>'fashions','action'=>'index')); ?></li>
    <li <? if($this->params['controller'] == "educations") echo 'class="active"'; ?>><?php echo $this->Html->link('Education',array('controller'=>'educations','action'=>'index')); ?></li>
    <li <? if($this->params['controller'] == "cookings") echo 'class="active"'; ?>><?php echo $this->Html->link('Cooking',array('controller'=>'cookings','action'=>'index')); ?></li>
    <li <? if($this->params['controller'] == "gossips") echo 'class="active"'; ?>><?php echo $this->Html->link('Gossip',array('controller'=>'gossips','action'=>'index')); ?></li>
    <li <? if($this->params['controller'] == "events") echo 'class="active"'; ?>><?php echo $this->Html->link('Events',array('controller'=>'fashions','action'=>'coming_soon')); ?></li>
    <li <? if($this->params['controller'] == "healths") echo 'class="active"'; ?>><?php echo $this->Html->link('Health',array('controller'=>'healths','action'=>'index')); ?></li>
    <li <? if($this->params['controller'] == "emotions") echo 'class="active"'; ?>><?php echo $this->Html->link('Emotion',array('controller'=>'emotions','action'=>'index')); ?></li>
    <li <? if($this->params['controller'] == "seniors") echo 'class="active"'; ?>><?php echo $this->Html->link('Seniors',array('controller'=>'seniors','action'=>'index')); ?></li>
    <li <? if($this->params['controller'] == "natures") echo 'class="active"'; ?>><?php echo $this->Html->link('Nature',array('controller'=>'natures','action'=>'index')); ?></li>
    <li <? if($this->params['controller'] == "juniors") echo 'class="active"'; ?>><?php echo $this->Html->link('Juniors',array('controller'=>'juniors','action'=>'index')); ?></li>
</ul>