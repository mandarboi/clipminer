import runpod
import subprocess
import whisper

def download_audio(url):
    output = "/tmp/audio.wav"
    subprocess.run([
        "yt-dlp", "-x", "--audio-format", "wav",
        "--postprocessor-args", "-t 30",
        "-o", output, url
    ], check=True)
    return output

def transcribe(audio_path):
    model = whisper.load_model("small")
    result = model.transcribe(audio_path)
    return result["segments"]

def handler(job):
    url = job["input"]["url"]

    audio_path = download_audio(url)
    segments = transcribe(audio_path)

    return {
        "status": "success",
        "segments": segments
    }

runpod.serverless.start({
    "handler": handler
})
