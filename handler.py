import runpod
import subprocess
import os

def download_audio(url):
    output = "/tmp/audio.wav"
    cmd = [
        "yt-dlp",
        "-x",
        "--audio-format", "wav",
        "--postprocessor-args", "-t 30",
        "-o", output,
        url
    ]
    subprocess.run(cmd, check=True)
    return output

def handler(job):
    url = job["input"]["url"]

    audio_path = download_audio(url)

    return {
        "status": "success",
        "audio_path": audio_path
    }

runpod.serverless.start({
    "handler": handler
})
