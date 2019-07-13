<?php

class Controller_index extends Controller {

    public function Action_index() {

        $index_model = load::Model('index');
        
        
        $data['order_name'] = $data['order_email'] =  'none';
        $data['order_time_add'] = 'desc';
        
        if ($this->input->get('order_name'))
            $data['order_name'] = $this->input->get('order_name');
        
        if ($this->input->get('order_email'))
            $data['order_email'] = $this->input->get('order_email');
        
        if ($this->input->get('order_time_add'))
            $data['order_time_add'] = $this->input->get('order_time_add');
        
        
        $data['comments'] = $index_model->getComments($data);
        
        
        view::Generate('index', $data);
    }

    public function Action_add_comment() {

        $index_model = load::Model('index');
        
        $data = $this->prepareData();

        if ($this->input->post() && $data ) {

            $index_model->addComment($data);
            echo 'success';
        }
        else{
            echo 'error';
        }
    }

    public function Action_fast_view() {
        
        $index_model = load::Model('index');
        
        $data['new_comment'] = $this->prepareData();
        
        
        $data['comments'] = $index_model->getComments();
        
        view::Generate('fast_view', $data);
        
        
        
        
    }

    public function prepareData() {
        
        if (!$this->validate())
            return false;
        
        $data = array(
            'text' => $this->input->post('text'),
            'email' => $this->input->post('email'),
            'name' => $this->input->post('name'),
            'image' => ''
        );

        if ($this->input->file('image')) {
            $img_res = $this->input->uploadFile('image');
            if (!isset($img_res['error'])) {
                $data['image'] = $img_res['name'];
            }
        }
        
        return $data;
    }
    
    
    private function validate() {
        $text = $this->input->post('text');
        $email = preg_match("/^([a-zA-Z0-9])+([\.a-zA-Z0-9_-])*@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-]+)*\.([a-zA-Z]{2,6})$/",$this->input->post('email'));
        $name = $this->input->post('name');
        if (!$email || !$name || !$text){
            return false;
        }
        
        return true;
        
    }
    
    

}
