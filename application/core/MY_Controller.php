<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Manual override (?lang=id / ?lang=en)
        if ($this->input->get('lang')) {
            $lang = $this->input->get('lang') === 'id'
                ? 'indonesian'
                : 'english';
            $this->session->set_userdata('site_lang', $lang);
        }

        // Ambil dari session
        $siteLang = $this->session->userdata('site_lang');

        // Auto-detect pertama kali
        if (!$siteLang) {
            $browser = $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? 'en';
            $browserLang = substr($browser, 0, 2);

            $siteLang = ($browserLang === 'id')
                ? 'indonesian'
                : 'english';

            $this->session->set_userdata('site_lang', $siteLang);
        }

        // Load language
        $this->lang->load('app', $siteLang);
    }
}
