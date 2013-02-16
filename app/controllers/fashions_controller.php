<?php

class FashionsController extends AppController {

    var $name = 'Fashions';
    var $components = array('Authsome', 'Session');
    var $helpers = array('Html', 'Form', 'Js' => array('Jquery'), 'Text','Time');
    var $uses = array('Post', 'PostDetail', 'Comment', 'Heartbeat', 'Advice', 'Reply', 'User');
    var $layout = 'two-column';

    public function beforeFilter() {
        parent::beforeFilter();
        $this->set('type', "");
    }

    public function add_discussion() {
        if (!empty($this->data)) {
            $this->Post->create();
            $this->data['Post'] = $this->data['Fashion'];
            if ($this->Post->save($this->data)) {
                $postId = $this->Post->getInsertId();
                $data['PostDetail']['type'] = 'discussion';
                $data['PostDetail']['post_id'] = $postId;
                $data['PostDetail']['related_to'] = 'fashion';
                $data['PostDetail']['status'] = 'active';
                //pr($data);
                $this->PostDetail->save($data);
            }
            $this->redirect(array('action' => 'view', $postId));
        }
    }

    public function add_comment() {
        //pr($this->Session);
        //echo $userId = $this->Authsome->get('id');
        $this->render(false);
        if (!empty($this->data)) {
            $this->Comment->save($this->data);
            if ($this->data['Comment']['type'] == 'expert advice') {
                $this->redirect(array('action' => 'view_advice', $this->data['Comment']['post_id']));
            }else if($this->data['Comment']['type'] == 'news'){
               $this->redirect(array('action' => 'view_news', $this->data['Comment']['post_id'])); 
            }else{
            $this->redirect(array('action' => 'view', $this->data['Comment']['post_id']));
//            
        }
        
        }
    }

    public function add_news() {
        if (!empty($this->data)) {
            
            
            $this->Post->create();
            $this->data['Post'] = $this->data['Fashion'];
            if ($this->Post->save($this->data)) {
                $postId = $this->Post->getInsertId();
                $data['PostDetail']['type'] = 'news';
                $data['PostDetail']['post_id'] = $postId;
                $data['PostDetail']['related_to'] = 'fashion';
                $data['PostDetail']['status'] = 'active';
                $this->PostDetail->save($data);
            }   
           $this->redirect(array('action' => 'view', $postId));

        }
    }

    public function add_sos() {
//        $userId = $this->Authsome->get('User.id');
//        $timeLimit = date('Y-m-d',(strtotime("-1 month")));
//        $sosCount=$this->Post->find('list',array('conditions'=>array('Post.user_id'=>$userId,'PostDetail.type'=>'sos','Post.created >' => $timeLimit)));
//        pr($sosCount);
        
        if (!empty($this->data)) {
            $this->Post->create();
            $this->data['Post'] = $this->data['Fashion'];
            if ($this->Post->save($this->data)) {
                $postId = $this->Post->getInsertId();
                $data['PostDetail']['type'] = 'sos';
                $data['PostDetail']['post_id'] = $postId;
                $data['PostDetail']['related_to'] = 'fashion';
                $data['PostDetail']['status'] = 'active';
                $this->PostDetail->save($data);
            }
                        $this->redirect(array('action' => 'view_sos', $postId));

        }
    }

    public function add_expert_advice() {
        if (!empty($this->data)) {
            $this->Post->create();
            $this->data['Post'] = $this->data['Fashion'];
            if ($this->Post->save($this->data)) {
                $postId = $this->Post->getInsertId();
                $data['PostDetail']['type'] = 'expert advice';
                $data['PostDetail']['post_id'] = $postId;
                $data['PostDetail']['related_to'] = 'fashion';
                $data['PostDetail']['status'] = 'active';
                $this->PostDetail->save($data);
            }
           $this->redirect(array('action' => 'view_advice', $postId));

        }
    }

    public function index() {
        $this->layout = 'three-column';
//        $posts = $this->Post->find('all', array('conditions' => array('PostDetail.related_to' => 'fashion')));
        $this->paginate = array(
            'conditions' => array('PostDetail.related_to' => 'fashion', 'PostDetail.type !=' => 'comment'),
            'limit' => 5,'order'=>array('Post.created DESC')
        );
        $posts = $this->paginate('Post');
        //pr($posts);
        $this->set('posts', $posts);
        $this->set('type', 'fashion');
        
        $userIds = array();
        foreach ($posts as $postData) {
            if (!empty($postData['Comment'])) {
                //print_r($postData['Reply']);
                foreach ($postData['Comment'] as $repl) {
                    $repUser = $repl['user_id'];
                    if (!in_array($repUser, $userIds)) {
                        $userIds[] = $repUser;
                        $userData[$repUser] = $this->User->find('first', array('conditions' => array('User.id' => $repUser)));
                    }
                }
            }
            elseif (!empty($postData['Reply'])) {
                //print_r($postData['Reply']);
                foreach ($postData['Reply'] as $repl) {
                    $repUser = $repl['user_id'];
                    if (!in_array($repUser, $userIds)) {
                        $userIds[] = $repUser;
                        $userData[$repUser] = $this->User->find('first', array('conditions' => array('User.id' => $repUser)));
                    }
                }
            }
        }
        
        if (!empty($userData)) {
            $this->set('users', $userData);
        }
    }

    public function discussions() {
        $this->layout = 'three-column';
        // $posts = $this->Post->find('all', array('conditions' => array('PostDetail.related_to' => 'fashion','PostDetail.type' => 'discussion')));
        $this->paginate = array(
            'conditions' => array('PostDetail.related_to' => 'fashion', 'PostDetail.type' => 'discussion'),
            'limit' => 4,'order'=>array('Post.created DESC')
        );

        $posts = $this->paginate('Post');

        $this->set('posts', $posts);
        $this->set('type', 'discussion');
        
        $userIds = array();
        foreach ($posts as $postData) {
            if (!empty($postData['Comment'])) {
                //print_r($postData['Reply']);
                foreach ($postData['Comment'] as $repl) {
                    $repUser = $repl['user_id'];
                    if (!in_array($repUser, $userIds)) {
                        $userIds[] = $repUser;
                        $userData[$repUser] = $this->User->find('first', array('conditions' => array('User.id' => $repUser)));
                    }
                }
            }
        }
        
        if (!empty($userData)) {
            $this->set('users', $userData);
        }
    }

    public function news() {
        $this->layout = 'three-column';
        //  $posts = $this->Post->find('all', array('conditions' => array('PostDetail.related_to' => 'fashion','PostDetail.type' => 'news')));
        $this->paginate = array(
            'conditions' => array('PostDetail.related_to' => 'fashion', 'PostDetail.type' => 'news'),
            'limit' => 4,'order'=>array('Post.created DESC')
        );

        $posts = $this->paginate('Post');

        $this->set('posts', $posts);
        $this->set('type', 'news');
        
        $userIds = array();
        foreach ($posts as $postData) {
            if (!empty($postData['Comment'])) {
                //print_r($postData['Reply']);
                foreach ($postData['Comment'] as $repl) {
                    $repUser = $repl['user_id'];
                    if (!in_array($repUser, $userIds)) {
                        $userIds[] = $repUser;
                        $userData[$repUser] = $this->User->find('first', array('conditions' => array('User.id' => $repUser)));
                    }
                }
            }
        }
        
        if (!empty($userData)) {
            $this->set('users', $userData);
        }
    }

    public function SOS() {

        $this->layout = 'three-column';
        // $posts = $this->Post->find('all', array('conditions' => array('PostDetail.related_to' => 'fashion','PostDetail.type' => 'sos')));
        $timeLimit = date('Y-m-d',(strtotime("-1 day")));
        $this->paginate = array(
            'conditions' => array('PostDetail.related_to' => 'fashion', 'PostDetail.type' => 'sos','Post.created >' => $timeLimit),
            'limit' => 4,'order'=>array('Post.created DESC')
        );

        $posts = $this->paginate('Post');
        //pr($posts);
        $userIds = array();
        foreach ($posts as $postData) {
            if (!empty($postData['Reply'])) {
                //print_r($postData['Reply']);
                foreach ($postData['Reply'] as $repl) {
                    $repUser = $repl['user_id'];
                    if (!in_array($repUser, $userIds)) {
                        $userIds[] = $repUser;
                        $userData[$repUser] = $this->User->find('first', array('conditions' => array('User.id' => $repUser)));
                    }
                }
            }
        }
        //pr($userIds);
        //pr($userData);
        if (!empty($userData)) {
            $this->set('users', $userData);
        }
        $this->set('posts', $posts);
        $this->set('type', 'sos');

        //$replies=$this->Reply->find('all');
        //pr($replies);
    }

    public function expert_advice() {
        $this->layout = 'three-column';
        // $posts = $this->Post->find('all', array('conditions' => array('PostDetail.related_to' => 'fashion','PostDetail.type' => 'advice')));
        $this->paginate = array(
            'conditions' => array('PostDetail.related_to' => 'fashion', 'PostDetail.type' => 'expert advice'),
            'limit' => 4,'order'=>array('Post.created DESC')
        );

        $posts = $this->paginate('Post');

        $this->set('posts', $posts);
        $this->set('type', 'advice');

        $userIds = array();
        foreach ($posts as $postData) {
            if (!empty($postData['Comment'])) {
                //print_r($postData['Reply']);
                foreach ($postData['Comment'] as $repl) {
                    $repUser = $repl['user_id'];
                    if (!in_array($repUser, $userIds)) {
                        $userIds[] = $repUser;
                        $userData[$repUser] = $this->User->find('first', array('conditions' => array('User.id' => $repUser)));
                    }
                }
            }
        }
        
        if (!empty($userData)) {
            $this->set('users', $userData);
        }
    }

    public function view($id) {

        $post = $this->Post->find('first', array('conditions' => array('Post.id' => $id)));
        $this->set('post', $post);

        $views = $post['PostDetail']['total_views'] + 1;

        $this->PostDetail->id = $post['PostDetail']['post_id'];
        $this->PostDetail->saveField('total_views', $views);
        $comments = $this->Comment->find('all', array('conditions' => array('post_id' => $id)));
        
        if(!empty($comments)){
        $this->set('comments', $comments);
        }
        $beats = $this->Heartbeat->find('count', array('conditions' => array('post_id' => $id)));
        $this->set('beats', $beats);
    }
    
    public function view_news($id) {

        $post = $this->Post->find('first', array('conditions' => array('Post.id' => $id)));
        $this->set('post', $post);

        $views = $post['PostDetail']['total_views'] + 1;

        $this->PostDetail->id = $post['PostDetail']['post_id'];
        $this->PostDetail->saveField('total_views', $views);
        $comments = $this->Comment->find('all', array('conditions' => array('post_id' => $id)));
        
        if(!empty($comments)){
        $this->set('comments', $comments);
        }
        $beats = $this->Heartbeat->find('count', array('conditions' => array('post_id' => $id)));
        $this->set('beats', $beats);
    }

    function delete($id) {
        $this->render(false);
        if ($this->Post->delete($id)) {
            $this->PostDetail->delete(array('post_id' => $id));
            $this->Session->setFlash('The post has been deleted.');
            $this->redirect(array('action' => 'index'));
        }
    }
    
    public function add_beat() {
        $this->layout = false;
        if (!empty($this->data)) {
            $beatIs=$this->Heartbeat->find('first',array('conditions'=>array('post_id'=>$this->data['Heartbeat']['post_id'],'Heartbeat.user_id'=>$this->data['Heartbeat']['user_id'])));
            if($beatIs){
                $this->Heartbeat->delete($beatIs['Heartbeat']['id']);  
            }else{
                $this->Heartbeat->save($this->data);
                $postId = $this->data['Heartbeat']['post_id'];
            }
            
            $beats = $this->Heartbeat->find('count', array('conditions' => array('post_id' => $this->data['Heartbeat']['post_id'])));
            $this->set('beats', $beats);
        }
    }

    public function view_sos($id) {
        $post = $this->Post->find('first', array('conditions' => array('Post.id' => $id)));
        $this->set('post', $post);
        
         $views = $post['PostDetail']['total_views'] + 1;

        $this->PostDetail->id = $post['PostDetail']['post_id'];
        $this->PostDetail->saveField('total_views', $views);
        
        $replies = $this->Reply->find('all', array('conditions' => array('post_id' => $id)));
        $this->set('replies', $replies);
    }

    public function add_sos_reply() {
        $this->render(false);
        if (!empty($this->data)) {
            $this->Reply->save($this->data);
            $this->redirect(array('action' => 'view_sos', $this->data['Reply']['post_id']));
        }
    }

    public function view_advice($id) {
        $post = $this->Post->find('first', array('conditions' => array('Post.id' => $id)));
        $this->set('post', $post);
        
         $views = $post['PostDetail']['total_views'] + 1;

        $this->PostDetail->id = $post['PostDetail']['post_id'];
        $this->PostDetail->saveField('total_views', $views);

        $advices = $this->Advice->find('all', array('conditions' => array('post_id' => $id)));
        $this->set('advices', $advices);

        $comments = $this->Comment->find('all', array('conditions' => array('post_id' => $id)));
        $this->set('comments', $comments);
    }

    public function add_advice_reply() {
        $this->render(false);
        if (!empty($this->data)) {
            $this->Advice->save($this->data);
            $this->redirect(array('action' => 'view_advice', $this->data['Advice']['post_id']));
        }
    }

    public function coming_soon() {
        $this->layout = false;
    }
    
    public function pink_me_ups() {
        
        $this->layout = 'three-column';
        // $posts = $this->Post->find('all', array('conditions' => array('PostDetail.related_to' => 'fashion','PostDetail.type' => 'advice')));
        $this->paginate = array(
            'conditions' => array('PostDetail.related_to' => 'fashion', 'PostDetail.type' => 'pink up'),
            'limit' => 4
        );

        $posts = $this->paginate('Post');

        $this->set('posts', $posts);
        $this->set('type', 'pinkup');

        $userIds = array();
        foreach ($posts as $postData) {
            if (!empty($postData['Reply'])) {
                //print_r($postData['Reply']);
                foreach ($postData['Reply'] as $repl) {
                    $repUser = $repl['user_id'];
                    if (!in_array($repUser, $userIds)) {
                        $userIds[] = $repUser;
                        $userData[$repUser] = $this->User->find('first', array('conditions' => array('User.id' => $repUser)));
                    }
                }
            }
        }
        //pr($userIds);
        //pr($userData);
        if (!empty($userData)) {
            $this->set('users', $userData);
        }
    }
    
    public function add_pink_me_up() {
        if (!empty($this->data)) {
            $this->Post->create();
            $this->data['Post'] = $this->data['Fashion'];
            if ($this->Post->save($this->data)) {
                $postId = $this->Post->getInsertId();
                $data['PostDetail']['type'] = 'pink up';
                $data['PostDetail']['post_id'] = $postId;
                $data['PostDetail']['related_to'] = 'fashion';
                $data['PostDetail']['status'] = 'active';
                $this->PostDetail->save($data);
            }
                        $this->redirect(array('action' => 'view_pink_me_up', $postId));

        }
    }
    
    public function add_pink_me_up_reply() {
        $this->render(false);
        if (!empty($this->data)) {
            $this->Reply->save($this->data);
            $this->redirect(array('action' => 'view_pink_me_up', $this->data['Reply']['post_id']));
        }
    }
    
    public function view_pink_me_up($id) {
        $post = $this->Post->find('first', array('conditions' => array('Post.id' => $id)));
        $this->set('post', $post);
        
        $views = $post['PostDetail']['total_views'] + 1;

        $this->PostDetail->id = $post['PostDetail']['post_id'];
        $this->PostDetail->saveField('total_views', $views);


        $replies = $this->Reply->find('all', array('conditions' => array('post_id' => $id)));
        $this->set('replies', $replies);
    }
    
    public function sos_useful(){
        $this->layout=false;
        if(!empty($this->data)){
        if($this->data['Reply']['useful']=="yes"){
            
            $this->Reply->id=$this->data['Reply']['reply_id'];
            $this->Reply->saveField('useful','yes');
            
            
        }
        else{
            $this->Reply->id=$this->data['Reply']['reply_id'];
            $this->Reply->saveField('useful','no');
        }
        
    }
    }
    
    public function edit_discussion($id = null) {
        $post = $this->Post->find('first', array('conditions' => array('Post.id' => $id)));
        //pr($post);
        $this->set('post', $post);
        if (!empty($this->data)) {


            $this->data['Post'] = $this->data['Fashion'];

            if ($this->Post->save($this->data)) {
                $this->Session->setFlash('Your post has been updated.');
                $this->redirect(array('action' => 'view',$this->data['Post']['id']));
            }
        }
    }
    public function edit_news($id = null) {
        $post = $this->Post->find('first', array('conditions' => array('Post.id' => $id)));
        //pr($post);
        $this->set('post', $post);
        if (!empty($this->data)) {


            $this->data['Post'] = $this->data['Fashion'];

            if ($this->Post->save($this->data)) {
                $this->Session->setFlash('Your post has been updated.');
                $this->redirect(array('action' => 'view_news',$this->data['Post']['id']));
            }
        }
    }
    public function edit_sos($id = null) {
        $post = $this->Post->find('first', array('conditions' => array('Post.id' => $id)));
        //pr($post);
        $this->set('post', $post);
        if (!empty($this->data)) {


            $this->data['Post'] = $this->data['Fashion'];

            if ($this->Post->save($this->data)) {
                $this->Session->setFlash('Your post has been updated.');
                $this->redirect(array('action' => 'view_sos',$this->data['Post']['id']));
            }
        }
    }
    
    public function edit_expert_advice($id = null) {
        $post = $this->Post->find('first', array('conditions' => array('Post.id' => $id)));
        //pr($post);
        $this->set('post', $post);
        if (!empty($this->data)) {


            $this->data['Post'] = $this->data['Fashion'];

            if ($this->Post->save($this->data)) {
                $this->Session->setFlash('Your post has been updated.');
                $this->redirect(array('action' => 'view_advice',$this->data['Post']['id']));
            }
        }
    }
    
    public function edit_pink_me_up($id = null) {
        $post = $this->Post->find('first', array('conditions' => array('Post.id' => $id)));
        //pr($post);
        $this->set('post', $post);
        if (!empty($this->data)) {


            $this->data['Post'] = $this->data['Fashion'];

            if ($this->Post->save($this->data)) {
                $this->Session->setFlash('Your post has been updated.');
                $this->redirect(array('action' => 'view_pink_me_up',$this->data['Post']['id']));
            }
        }
    }
    
    public function subscribe(){
        $this->layout = false;
        $userId = $this->Authsome->get('User.id');

        $communities = $this->User->find('list', array('fields' => 'communities', 'conditions' => array('User.id' => $userId)));
        $commList = $communities[$userId];
        $commArray = explode(",", $commList);
        
        array_push($commArray,$this->data['community']);
        
        $newList=implode(",",$commArray);
        $this->Session->write('User.User.communities', $commList);
        $this->set('list',$newList);
        $this->User->id=$userId;
        $this->User->saveField('communities',$newList);
    }
    
    public function unsubscribe(){
        $this->layout = false;
        $userId = $this->Authsome->get('User.id');

        $communities = $this->User->find('list', array('fields' => 'communities', 'conditions' => array('User.id' => $userId)));
        $commList = $communities[$userId];
        $commArray = explode(",", $commList);
        $comm= $this->data['community'];
        $newArray = array_diff($commArray,array($comm));
        
        $newList=implode(",",$newArray);
        
        $this->set('list',$newList);
        $this->User->id=$userId;
        $this->User->saveField('communities',$newList);
    }
}

?>