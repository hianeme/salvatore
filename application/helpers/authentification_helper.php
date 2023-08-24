<?php 

if ( ! function_exists('check_connection'))
{
    function check_connection(){
        $CI =& get_instance();
        $user = $CI->session->userdata('user');
        
        if(!$user){
            redirect('authentification');
        }
    }
}