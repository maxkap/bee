<?php

class Model_admin extends Model {

    public function getComments() {
        $sql = "SELECT * FROM `comments` ORDER BY `time_add` DESC";
        return $this->db->select($sql);
    }

    public function saveComment($comment_id, $comment = '') {
        $sql = "UPDATE `comments` SET `text` = :text, time_update = ".time().", status = 2 WHERE comment_id = :comment_id";            

        $insert = array(
            'text' => htmlspecialchars($comment),
            'comment_id' => $comment_id
        );

        return $this->db->set($sql, $insert);
    }
    
    public function updateStatusComment($comment_id, $status = '-1') {
        $sql = "UPDATE `comments` SET  time_update = ".time().", status = '$status' WHERE comment_id = :comment_id";           

        $insert = array(            
            'comment_id' => $comment_id
        );

        return $this->db->set($sql, $insert);
    }

}
