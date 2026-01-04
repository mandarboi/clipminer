import runpod

# Fungsi utama yang akan dipanggil oleh dashboard laptop Anda
def handler(job):
    job_input = job['input']
    # Placeholder: Di sini nanti kita masukkan logika AI Face Crop
    return {
        "status": "success",
        "message": "GPU RunPod siap! Perintah diterima dari laptop.",
        "received_input": job_input
    }

runpod.serverless.start({"handler": handler})