<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BaseApi extends CI_Controller {

    protected function ok($data = [])
    {
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'ok',
            'data' => $data
        ]);
        exit;
    }

    protected function error($message, $code = 400)
    {
        header('Content-Type: application/json');
        http_response_code($code);
        echo json_encode([
            'status' => 'error',
            'message' => $message
        ]);
        exit;
    }
}
