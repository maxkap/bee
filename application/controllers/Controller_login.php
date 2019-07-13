<?php

class Controller_login extends Controller {
    
    

    public function Action_index() {
        view::Generate('login');
    }
    
    public function Action_run() {
        
        
        
        $result = array('error'=>'Ошибка данных');
        
        if ($this->input->post()){
            
            $data = array(
                'login' => $this->input->post('login'),
                'password' => $this->input->post('password')
                
            ); 
            
            $login_model = load::Model('login');
            
            $result = $login_model->canLogin($data);
                        
        }
        
        echo json_encode($result);
    }
    
    public function Action_logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_login']);
        header('Location: ' . view::GetPath() . 'login');
        
    }

    

}
