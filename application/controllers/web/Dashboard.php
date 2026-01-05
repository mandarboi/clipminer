<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{

    private $jobPath;

    public function __construct()
    {
        parent::__construct();
        // Set path satu pintu agar konsisten di semua fungsi
        $this->jobPath = APPPATH . '../storage/jobs.json';
        $this->load->helper('url');
        // Session otomatis di-load untuk membedakan Ahmad & Jokowi
        $this->load->library('session');
    }

    public function index()
    {
        $jobs = [];

        if (file_exists($this->jobPath)) {
            $all_jobs = json_decode(file_get_contents($this->jobPath), true) ?: [];

            // Filter: Hanya tampilkan data milik user_id saat ini
            $jobs = array_filter($all_jobs, function ($job) {
                return isset($job['user_id']) && $job['user_id'] === session_id();
            });
        }

        // Gunakan array_values agar index kembali berurutan 0,1,2...
        $this->load->view('dashboard', ['jobs' => array_reverse(array_values($jobs))]);
    }

    public function submit()
    {
        $url = trim($this->input->post('youtube_url'));

        if (!$url || (strpos($url, 'youtube.com') === false && strpos($url, 'youtu.be') === false)) {
            show_error('Invalid YouTube URL', 400);
            return;
        }

        $storageDir = dirname($this->jobPath);
        if (!is_dir($storageDir)) {
            mkdir($storageDir, 0775, true);
        }

        if (!file_exists($this->jobPath)) {
            file_put_contents($this->jobPath, json_encode([]));
        }

        $jobs = json_decode(file_get_contents($this->jobPath), true) ?: [];
        $jobId = 'job_' . time();

        // Tambahkan data baru dengan identitas user_id
        $jobs[] = [
            'id'          => $jobId,
            'user_id'     => session_id(),
            'youtube_url' => $url,
            'status'      => 'preview_ready',
            'created_at'  => date('Y-m-d H:i:s')
        ];

        file_put_contents($this->jobPath, json_encode($jobs, JSON_PRETTY_PRINT));
        redirect(base_url('dashboard/preview/' . $jobId));
    }

    public function preview($jobId)
    {
        if (!file_exists($this->jobPath)) show_404();
        $all_jobs = json_decode(file_get_contents($this->jobPath), true) ?: [];

        $job = null;
        foreach ($all_jobs as $j) {
            if ($j['id'] === $jobId && $j['user_id'] === session_id()) {
                $job = $j;
                break;
            }
        }

        // 🔍 DEBUG DI SINI
        log_message('error', 'JOB DATA PREVIEW: ' . print_r($job, true));

        if (!$job) {
            show_404();
            return;
        }


        // Hanya load view rangka, data diisi via AJAX agar bisa muncul loading
        $this->load->view('preview', ['job' => $job]);
    }

    public function get_clips_data($jobId)
    {
        while (ob_get_level()) {
            ob_end_clean();
        }
        header('Content-Type: application/json');

        $job = $this->_get_job_by_id($jobId);
        if (!$job) {
            echo json_encode(['status' => 'error']);
            exit;
        }

        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $job['youtube_url'], $match);
        $video_id = $match[1] ?? '';

        // Sumber 1: API Scraper Primer
        $api_url = "https://youtube-transcript-api-alpha.vercel.app/api/transcript?v=" . $video_id;
        $raw_content = @file_get_contents($api_url);

        // Sumber 2: API Scraper Sekunder (Backup jika Sumber 1 gagal/bool)
        if ($raw_content === false) {
            $api_url = "https://subtitles-youtube.vercel.app/api/transcript?videoId=" . $video_id;
            $raw_content = @file_get_contents($api_url);
        }

        $transcript = $raw_content ? json_decode($raw_content, true) : null;

        // Ambil durasi via oEmbed agar timestamp 30%, 45%, 80% akurat
        $total_seconds = 600; // Default 10 menit jika oembed gagal

        $points = [0.30, 0.45, 0.80];
        $previews = [];
        foreach ($points as $index => $percent) {
            $target_sec = floor($total_seconds * $percent);
            $previews[] = [
                'title'     => "Potential Clip #" . ($index + 1),
                'thumbnail' => "https://img.youtube.com/vi/{$video_id}/hq" . ($index + 1) . ".jpg",
                'duration'  => gmdate("i:s", rand(45, 90)),
                'caption'   => $this->_find_exact_text($transcript, $target_sec)
            ];
        }

        echo json_encode(['status' => 'success', 'previews' => $previews]);
        exit;
    }

    private function _find_exact_text($data, $second)
    {
        if (!is_array($data) || empty($data)) {
            return "CLICK TO UNLOCK TEXT"; // Masih gagal ambil data
        }

        $target_ms = $second * 1000;
        $found_text = "";

        foreach ($data as $line) {
            // Deteksi apakah API kirim dalam milidetik (offset) atau detik (start)
            $start_ms = isset($line['offset']) ? $line['offset'] : ($line['start'] * 1000);

            if ($start_ms <= $target_ms) {
                $found_text = $line['text'];
            } else {
                break;
            }
        }

        // Bersihkan teks agar tampil rapi di kotak kuning
        $clean_text = str_replace(["\n", "\r", "&quot;", "&#39;"], " ", $found_text);
        return !empty($clean_text) ? strtoupper(trim($clean_text)) : "SPEECH AT " . gmdate("i:s", $second);
    }


    private function _get_job_by_id($jobId)
    {
        $all_jobs = json_decode(file_get_contents($this->jobPath), true) ?: [];
        foreach ($all_jobs as $job) {
            // Pastikan job ID cocok dan milik user yang sedang aktif (session_id)
            if ($job['id'] === $jobId && $job['user_id'] === session_id()) {
                return $job;
            }
        }
        return null;
    }
}
