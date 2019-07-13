<?php

class Model_index extends Model {
    
    public function addComment($data) {
        $sql = "INSERT INTO `comments`
            (
            text,
            email,
            time_add,
            time_update,
            name,
            image            
            ) VALUES (
            :text, 
            :email, 
            " . time() . ", 
            " . time() . ", 
            :name,
            :image
            )";

        $insert = array(
            'text'  => htmlspecialchars($data['text']),
            'email' => $data['email'],
            'name'  => $data['name'],
            'image' => $data['image'],
            
        );

        return $this->db->set($sql, $insert);
        
    }
    
    
    public function getComments($data = array()) {
        
        $order = " `time_add` DESC ";
        
        if (isset($data['order_time_add']) &&  $data['order_time_add']!= 'none'){
            $order = " `time_add` ".$data['order_time_add'];
        }
        if (isset($data['order_email']) &&  $data['order_email'] != 'none'){
            $order = " `email` ".$data['order_email'];
        }
        if (isset($data['order_name']) &&  $data['order_name'] != 'none'){
            $order = " `name` ".$data['order_name'];
        }
        
        $sql = "SELECT * FROM `comments` WHERE `status` > 0 ORDER BY ".$order;

        return $this->db->select($sql);
        
        
    }

}