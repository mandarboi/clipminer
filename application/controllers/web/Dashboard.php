
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function index()
    {
        $path = APPPATH . '../storage/jobs.json';
        $jobs = [];

        if (file_exists($path)) {
            $jobs = json_decode(file_get_contents($path), true);
        }

        $this->load->view('dashboard', ['jobs' => $jobs]);
    }


    public function submit()
    {
        $url = trim($this->input->post('youtube_url'));

        if (!$url || (!str_contains($url, 'youtube.com') && !str_contains($url, 'youtu.be'))) {
            show_error('Invalid YouTube URL', 400);
            return;
        }

        $storageDir = APPPATH . '../storage';
        $filePath   = $storageDir . '/jobs.json';

        if (!is_dir($storageDir)) {
            mkdir($storageDir, 0775, true);
        }

        if (!file_exists($filePath)) {
            file_put_contents($filePath, json_encode([]));
        }

        $jobs = json_decode(file_get_contents($filePath), true);

        $jobId = 'job_' . time();

        $jobs[] = [
            'id' => $jobId,
            'youtube_url' => $url,
            'status' => 'preview_ready',
            'created_at' => date('Y-m-d H:i:s')
        ];

        file_put_contents($filePath, json_encode($jobs, JSON_PRETTY_PRINT));

        redirect('/web/dashboard/preview/' . $jobId);
    }


    public function preview($jobId)
    {
        $path = APPPATH . '../storage/jobs.json';

        if (!file_exists($path)) {
            show_404();
            return;
        }

        $jobs = json_decode(file_get_contents($path), true);

        $job = null;
        foreach ($jobs as $j) {
            if ($j['id'] === $jobId) {
                $job = $j;
                break;
            }
        }

        if (!$job) {
            show_404();
            return;
        }

        // FAKE PREVIEW DATA (UI ONLY)
        $previews = [
            [
                'title' => 'Viral Clip 1',
                'thumbnail' => '/assets/thumb1.jpg',
                'duration' => '0:45'
            ],
            [
                'title' => 'Viral Clip 2',
                'thumbnail' => '/assets/thumb2.jpg',
                'duration' => '1:02'
            ],
            [
                'title' => 'Viral Clip 3',
                'thumbnail' => '/assets/thumb3.jpg',
                'duration' => '0:58'
            ]
        ];

        $this->load->view('preview', [
            'job' => $job,
            'previews' => $previews
        ]);
    }

}
