<?php

class Model_install extends Model {
    
    public function tryInstall() {
        
        $sql = "
        
        --
        -- Структура таблицы `comments`
        --

        CREATE TABLE IF NOT EXISTS `comments` (
          `comment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
          `comment` blob NOT NULL,
          `email` varbinary(255) NOT NULL,
          `time_add` int(11) NOT NULL,
          `time_update` int(11) NOT NULL,
          `image` varchar(255) NOT NULL,
          `username` varchar(255) NOT NULL,
          `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0- не одобрен, 1 - одобрен, 2- изменен админом',
          PRIMARY KEY (`comment_id`)
        ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

        -- --------------------------------------------------------

        --
        -- Структура таблицы `users`
        --

        CREATE TABLE IF NOT EXISTS `users` (
          `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
          `login` varchar(255) NOT NULL,
          `password` varchar(255) NOT NULL,
          `time_add` int(11) NOT NULL,
          `status` int(11) NOT NULL,
          PRIMARY KEY (`user_id`)
        ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
        
        REPLACE INTO `users` (`user_id`, `login`, `password`, `time_add`, `status`) VALUES
(1, 'admin', '127218481409b5bb39ea8463d45a297a', 0, 1);
        ";
        
        
        try {
     
            $this->db->query($sql);
            return array(
                'success' => 'data created'
            );

       } catch(PDOException $e) {
           return array(
                'error' => $e->getMessage()
            ); 
       }
        
    }
    
    
    
    
    

}