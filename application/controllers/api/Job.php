<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'controllers/api/BaseApi.php';

class Job extends BaseApi {

    public function preview()
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        if (!isset($_SESSION['preview_count'])) {
            $_SESSION['preview_count'] = 0;
        }

        if ($_SESSION['preview_count'] >= 3) {
            return $this->error('Free preview limit reached');
        }

        $_SESSION['preview_count']++;


        $url = $this->input->post('youtube_url');

        if (!$url) {
            return $this->error('youtube_url is required');
        }

        // PREVIEW LIGHT (dummy tapi realistis)
        $previews = [
            [
                'title' => 'Potential clip #1',
                'start' => 12,
                'end'   => 57,
                'duration' => 45
            ],
            [
                'title' => 'Potential clip #2',
                'start' => 128,
                'end'   => 190,
                'duration' => 62
            ],
            [
                'title' => 'Potential clip #3',
                'start' => 420,
                'end'   => 500,
                'duration' => 80
            ]
        ];

        $this->ok([
            'source' => $url,
            'clips'  => $previews,
            'note'   => 'Preview only. Unlock to process full clips.'
        ]);
    }
}
