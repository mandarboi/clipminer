FROM runpod/pytorch:2.2.1-py3.10-cuda12.1.1-devel-ubuntu22.04

# 1. Install System Dependencies + Certs
RUN apt-get update && apt-get install -y \
    ffmpeg \
    libgl1-mesa-glx \
    ca-certificates \
    && update-ca-certificates \
    && rm -rf /var/lib/apt/lists/*

# 2. Install Library
RUN pip install --no-cache-dir runpod opencv-python mediapipe yt-dlp openai-whisper

# 3. Pre-load Model (Gunakan python3)
# Jika baris ini masih error, hapus saja.
RUN python3 -c "import whisper; whisper.load_model('base')"

COPY handler.py /handler.py
CMD [ "python3", "-u", "/handler.py" ]