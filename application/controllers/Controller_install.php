<?php

class Controller_install extends Controller {

    public function Action_index() {

        $install_model = load::Model('install');
        
        $result = $install_model->tryInstall();
        
        echo "<pre>";
        print_r($result);
        echo "</pre>";
        
    }

  
    
    

}
