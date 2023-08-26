<?php 

if ( ! function_exists('check_connection'))
{
    // Vérifier si l'utilisateur est bien connecté et il a le droit d'accéder à la page
    function check_connection(){

        $CI =& get_instance();
        
        $CI->config->load('global');

        $permissions = $CI->config->item('permissions');

        $user = $CI->session->userdata('user');

        if($user){
            $class = $CI->router->fetch_class();

            if(!in_array($class, $permissions[$user->role]['permittedRoutes'])){
                redirect($permissions[$user->role]['defaultRoute']);
            }
        }else{
            redirect('authentification');
        }
    }
}