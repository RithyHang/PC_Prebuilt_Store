<?php
    class User{
        public function ConnectDB($host, $username, $password){
            $db = mysqli_connect($host, $username, $password);
            if(!$db->connect_error > 0){
                "erro number: " . $db->connect_errno . "<br>" .
                "error message: " . $db->connect_error;
            }
        }

    }

?>