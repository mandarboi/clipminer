import runpod
import subprocess
import os
import uuid
from faster_whisper import WhisperModel

# Load model di awal agar tidak di-load berulang kali
# Gunakan 'tiny' untuk testing, ganti 'base' atau 'small' jika sudah stabil
model_size = "base"
model = WhisperModel(model_size, device="cuda", compute_type="float16")

def download_audio(url):
    output = f"/tmp/{uuid.uuid4()}.wav"
    # Pastikan yt-dlp dan ffmpeg tersedia di system
    command = [
        "yt-dlp",
        "-x",
        "--audio-format", "wav",
        "-o", output,
        url
    ]
    result = subprocess.run(command, capture_output=True, text=True)
    if result.returncode != 0:
        raise Exception(f"yt-dlp error: {result.stderr}")
    return output

def handler(job):
    audio_path = None
    try:
        url = job["input"].get("url")
        if not url:
            return {"status": "error", "message": "URL missing"}

        # 1. Download
        audio_path = download_audio(url)

        # 2. Transcribe
        segments, info = model.transcribe(audio_path, beam_size=5)
        
        results = []
        for segment in segments:
            results.append({
                "start": segment.start,
                "end": segment.end,
                "text": segment.text
            })

        return {
            "status": "success",
            "language": info.language,
            "segments": results
        }

    except Exception as e:
        return {"status": "error", "message": str(e)}
    
    finally:
        # Hapus file sampah agar disk container tidak penuh
        if audio_path and os.path.exists(audio_path):
            os.remove(audio_path)

runpod.serverless.start({"handler": handler})