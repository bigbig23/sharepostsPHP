<?php
// Simple redirect page
function redirect($page){
    header('Location: ' . URLROOT . '/' . $page);
}






?>