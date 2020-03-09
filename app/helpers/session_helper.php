<?php

session_start();

// Flash message helper
// EXAMPLE - flash('register_success','YOu are now registered','alert alert-danger'); alert alert-danger is optional
//DISPLAY IN VIEW - <?php echo flash('register_success');
function flash($name = '', $message='', $class='alert alert-success'){
    if(!empty($name)){
        if(!empty($message) && empty($_SESSION[$name])){
            if(!empty($_SESSION[$name])){
                unset($_SESSION[$name]);
            }
            if(!empty($_SESSION[$name . '_class'])){
                unset($_SESSION[$name . '_class']);
            }
            $_SESSION[$name] = $message;
            $_SESSION[$name. '_class'] = $class; //if not it will take the default class which is 'alert alert-success'
        }elseif(empty($message) && !empty($_SESSION[$name])){
            $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name. '_class'] : '';
            echo '<div class="'.$class.'" id="msg-flash">'.$_SESSION[$name].'</div>';
            unset($_SESSION[$name]);
            unset($_SESSION[$name. '_class']);
        }
    }
    // that would create a SESSION variable with the name "register_success_class" set to a
}

function isLogged(){
    if($_SESSION['user_id']){
        return true;
    }else{
        return false;
    }
}






?>