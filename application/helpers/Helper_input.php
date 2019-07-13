<?php

class Input {

    public function post($index = NULL, $clean = FALSE) {
        // Check if a field has been provided
        if ($index === NULL AND ! empty($_POST)) {
            $post = array();
            foreach (array_keys($_POST) as $key) {
                $post[$key] = $this->_fetch_from_array($_POST, $key, $clean);
            }
            return $post;
        }

        return $this->_fetch_from_array($_POST, $index, $clean);
    }

    public function get($index = NULL, $clean = FALSE) {

        if ($index === NULL AND ! empty($_GET)) {
            $get = array();
            foreach (array_keys($_GET) as $key) {
                $get[$key] = $this->_fetch_from_array($_GET, $key, $clean);
            }
            return $get;
        }

        return $this->_fetch_from_array($_GET, $index, $clean);
    }

    private function _fetch_from_array(&$array, $index = '', $clean = FALSE) {
        if (!isset($array[$index])) {
            return FALSE;
        }

        if ($clean === TRUE) {
            return $this->clean($array[$index]);
        }

        return $array[$index];
    }

    private function clean($data) {


        $quotes = array("\x27", "\x22", "\x60", "\t", "\n", "\r", "*", "%", "<", ">", "?", "!");
        $goodquotes = array("+", "#");
        $repquotes = array("\+", "\#");
        $text = trim(strip_tags($data));
        $text = str_replace($quotes, '', $text);
        $text = str_replace($goodquotes, $repquotes, $text);
        $text = preg_replace("/ +/", " ", $text);
        $text = htmlspecialchars($text);

        return $text;
    }
    
    public function file($name) {
        
        
        return (isset($_FILES[$name]) && !empty($_FILES[$name]['tmp_name']))?$_FILES[$name]:false;
    }
    
    
    

    public function uploadFile($name) {

        $imageinfo = getimagesize($_FILES[$name]['tmp_name']);
        if ($imageinfo['mime'] != 'image/gif' && $imageinfo['mime'] != 'image/jpg' && $imageinfo['mime'] != 'image/jpeg' && $imageinfo['mime'] != 'image/png') {
            return array('error' => 'неизвестный тип файла');
        }

        $uploaddir = ROOT . '/downloads/';
        
        $name_new = $this->resize($_FILES[$name]);
        
         if (!@copy('/tmp/'. $name_new, $uploaddir . $name)){
             
            return array('success' => 'изображение успешно загружено', 'name'=>$name_new);
        } else {
            return array('error' => 'ошибка загрузки');
        }
    }

    function resize($file) {
        
        $tmp_path = ROOT."/downloads/";
        
        $max_width_size = 320;
        $max_height_size = 240;

        
        $quality = 100;

        
        if ($file['type'] == 'image/jpeg')
            $src = imagecreatefromjpeg($file['tmp_name']);
        elseif ($file['type'] == 'image/jpg')
            $src = imagecreatefromjpeg($file['tmp_name']);
        elseif ($file['type'] == 'image/png')
            $src = imagecreatefrompng($file['tmp_name']);
        elseif ($file['type'] == 'image/gif')
            $src = imagecreatefromgif($file['tmp_name']);
        else
            return false;

        
        $w_src = imagesx($src);
        $h_src = imagesy($src);

       
        $w = $max_width_size;

        
        $h = $max_height_size;


        
        if ($h_src > $w_src){
            if ($h_src > $h) {
                // Вычисление пропорций
                $ratio = $h_src / $h;
                $w_dest = @round($w_src / $ratio);
                $h_dest = @round($h_src / $ratio);

                // Создаём пустую картинку
                $dest = @imagecreatetruecolor($w_dest, $h_dest);

                // Копируем старое изображение в новое с изменением параметров
                @imagecopyresampled($dest, $src, 0, 0, 0, 0, $w_dest, $h_dest, $w_src, $h_src);

                // Вывод картинки и очистка памяти
                @imagejpeg($dest, $tmp_path . $file['name'], $quality);

                @imagedestroy($dest);
                @imagedestroy($src);

                return $file['name'];
            } 
        }
        else{
            if ($w_src > $w) {
                // Вычисление пропорций
                $ratio = $w_src / $w;
                $w_dest = @round($w_src / $ratio);
                $h_dest = @round($h_src / $ratio);

                // Создаём пустую картинку
                $dest = @imagecreatetruecolor($w_dest, $h_dest);

                // Копируем старое изображение в новое с изменением параметров
                @imagecopyresampled($dest, $src, 0, 0, 0, 0, $w_dest, $h_dest, $w_src, $h_src);

                // Вывод картинки и очистка памяти
                @imagejpeg($dest, $tmp_path . $file['name'], $quality);

                @imagedestroy($dest);
                @imagedestroy($src);

                return $file['name'];
            }  
        }
        
        
            
            
        // Вывод картинки и очистка памяти
        @imagejpeg($src, $tmp_path . $file['name'], $quality);
        @imagedestroy($src);

        return $file['name'];
        
    }
    
    
}
