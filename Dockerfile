FROM runpod/pytorch:2.2.1-py3.10-cuda12.1.1-devel-ubuntu22.04

# Instal FFmpeg dan library AI
RUN apt-get update && apt-get install -y ffmpeg
RUN pip install runpod opencv-python mediapipe yt-dlp
RUN pip install yt-dlp openai-whisper runpod

# Salin script ke server
COPY handler.py /handler.py

# Jalankan worker
CMD [ "python", "-u", "/handler.py" ]