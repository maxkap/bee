<?php
class Load{
    
    static function Model($name = "index"){
        
        include ROOT.'/application/models/Model_'.$name.'.php';
        $class_name = 'Model_'.$name;
        return new $class_name();
        
    }
    
    static function Helper($name = "index"){
        
        return include ROOT.'/application/helpers/Helper_'.$name.'.php';
        
    }
    
    
    
    
}
