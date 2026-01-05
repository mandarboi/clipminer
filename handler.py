import runpod
import subprocess
import os
import whisper
import uuid
import traceback

# Load model di level global agar tidak di-load setiap ada request (hemat waktu)
# Pastikan tipe model sama dengan yang ada di Dockerfile
try:
    model = whisper.load_model("tiny")
except Exception as e:
    print(f"Gagal load model: {e}")

def download_audio(url):
    output = f"/tmp/{uuid.uuid4()}.wav"
    # Menggunakan yt-dlp untuk ambil audio saja (cepat)
    command = [
        "yt-dlp",
        "-x",
        "--audio-format", "wav",
        "-o", output,
        url
    ]
    
    # Menangkap error jika yt-dlp gagal (misal link mati)
    result = subprocess.run(command, capture_output=True, text=True)
    if result.returncode != 0:
        raise Exception(f"yt-dlp error: {result.stderr}")
        
    return output

def handler(job):
    audio_path = None
    try:
        # 1. Ambil input URL
        url = job["input"].get("url")
        if not url:
            return {"status": "error", "message": "Link YouTube kosong kau masukkan!"}

        # 2. Download proses
        audio_path = download_audio(url)

        # 3. Transkripsi dengan Whisper
        # fp16=False jika kau menggunakan CPU, True jika menggunakan GPU (RunPod)
        result = model.transcribe(audio_path, fp16=True)

        # 4. Format hasil agar bersih
        segments = []
        for s in result["segments"]:
            segments.append({
                "start": round(s["start"], 2),
                "end": round(s["end"], 2),
                "text": s["text"].strip()
            })

        return {
            "status": "success",
            "segments": segments
        }

    except Exception as e:
        return {
            "status": "error",
            "message": str(e),
            "trace": traceback.format_exc()
        }
        
    finally:
        # Bersihkan file di folder /tmp agar storage tidak penuh
        if audio_path and os.path.exists(audio_path):
            os.remove(audio_path)

# Jalankan serverless
runpod.serverless.start({"handler": handler})