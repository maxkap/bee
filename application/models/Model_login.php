<?php

class Model_login extends Model {
    
    public function canLogin($data) {
        $sql = "SELECT * FROM `users` WHERE `login` = :login AND password = :password";
        
        $placeholders = array(            
            'login' => $data['login'],
            'password'  => md5($data['password'].'bee')
        );
        
        $result =  $this->db->select_one($sql, $placeholders);

        if ($result){
            $this->enter($result);
            return array('success' => 'Вход выполнен');
        }
        else{
            return array('error' => 'Логин/пароль не пожходят');
        }
        
    }
    
    private function enter($user_data){
        
        $_SESSION['user_id'] = $user_data['user_id'];
        $_SESSION['user_login'] = $user_data['login'];
        
    }
    
    
    

}