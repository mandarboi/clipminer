import runpod
import subprocess
import whisper
import uuid
import traceback

model = whisper.load_model("small")  # load SEKALI

def download_audio(url):
    output = f"/tmp/{uuid.uuid4()}.wav"
    subprocess.run(
        [
            "yt-dlp",
            "-x",
            "--audio-format", "wav",
            "--postprocessor-args", "-t 30",
            "-o", output,
            url
        ],
        check=False,  # PENTING
        stdout=subprocess.PIPE,
        stderr=subprocess.PIPE
    )
    return output

def handler(job):
    try:
        url = job["input"].get("url")
        if not url:
            return {"status": "error", "error": "URL missing"}

        audio_path = download_audio(url)
        segments = model.transcribe(audio_path)["segments"]

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

runpod.serverless.start({
    "handler": handler
})
