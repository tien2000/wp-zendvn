<?php
    $username       = 'tienle';
    $password   = '123456';
    $customID   = 'tls-123456';

    $msg['error'] = true;
    $msg['mes'] = "Bạn đang sử dụng plugin lậu. Có thể website của bạn đã bị dính mã độc";
    
    if(isset($_SERVER['HTTP_CUS_ID']) && $_SERVER['HTTP_CUS_ID'] == $customID){
        $key = md5($username . '-' . md5($password));        
        $postKey = md5($_POST['username'] . '-' . $_POST['password']);
        
        if($key == $postKey){
            $msg['error'] = false;
            $msg['mes'] = 'Bạn hãy <a href="#">nhấn vào đây</a> để nâng cấp plugin hiện thời';
        }
    }
       
    echo json_encode($msg);