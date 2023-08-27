<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Rest_Controller extends CI_Controller{

    const HTTP_OK = 200;
    const HTTP_INTERNAL_ERROR = 500;

    public function __construct()
    {
        parent::__construct();   
    }

    public function response($data = NULL, $http_code = NULL)
    {
        return $this
            ->output
            ->set_content_type('application/json')
            ->set_status_header($http_code)
            ->set_output(json_encode($data));
    }

}