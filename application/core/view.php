<?php

class View {

    
    
    static public function Generate($view,$data=array()) {
        include ROOT.'/application/views/template.php';
    }
    
    static public function GetPath() {
        global $config;
               
        return $config['base_path'] ;
    }
    

}