<?php

class Controller_admin extends Controller {
    
    function __construct() {
        
       parent::__construct();
       if (!isset($_SESSION['user_id'])){
           header('Location: ' . view::GetPath() . 'login');
       }
       
    }

    public function Action_index() {
        $admin_model = load::Model('admin');

        $data['comments'] = $admin_model->getComments();
        view::Generate('admin', $data);
    }
    
    public function Action_activate_comment() {
        
        $comment_id = $this->input->get('comment_id');
        
        if ($comment_id){            
            $admin_model = load::Model('admin');
            $admin_model->updateStatusComment($comment_id, 1);            
        }
    }
    
    public function Action_delete_comment() {
        
        $comment_id = $this->input->get('comment_id');
        
        if ($comment_id){            
            $admin_model = load::Model('admin');
            $admin_model->updateStatusComment($comment_id);            
        }
    }
    
    
    public function Action_save_comment() {
        
        $comment_id = $this->input->post('comment_id');
        
        if ($comment_id){  
            $comment = $this->input->post('comment');
            
            $admin_model = load::Model('admin');
            $admin_model->saveComment($comment_id, $comment);            
        }
    }

    

}
