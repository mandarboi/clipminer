<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'controllers/api/BaseApi.php';

class Test extends BaseApi {

    public function index()
    {
        $this->ok([
            'message' => 'API works',
            'time' => date('Y-m-d H:i:s')
        ]);
    }
}
