<?php
    include_once 'data.php';
    
    if (isset($_GET['status'])){
        $status = $_GET['status'];
        //echo $status;
        
        foreach ($data as $key => $val){
            if($val['status'] != $status){
                unset($data[$key]);
            }
        }
    }
    
    echo json_encode($data);