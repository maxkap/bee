<?php

class Controller {
    
    public $input;
    
    function __construct() {
        load::Helper('input');
        
        $this->input = new Input();
        
    }

}
