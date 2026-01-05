# Base image dengan CUDA pendukung AI
FROM runpod/pytorch:2.2.1-py3.10-cuda12.1.1-devel-ubuntu22.04

# 1. Instal FFmpeg (Wajib di awal)
# libgl1-mesa-glx ditambahkan untuk mendukung OpenCV (cv2)
RUN apt-get update && apt-get install -y \
    ffmpeg \
    libgl1-mesa-glx \
    && rm -rf /var/lib/apt/lists/*

# 2. Instal Library Python (Gunakan --no-cache-dir agar hemat ruang)
RUN pip install --no-cache-dir \
    runpod \
    opencv-python \
    mediapipe \
    yt-dlp \
    openai-whisper

# 3. Pre-load Model Whisper (PENTING!)
# Ini memastikan FFmpeg bisa dipanggil oleh Whisper saat proses build
RUN python -c "import whisper; whisper.load_model('base')"

# 4. Salin script dan jalankan
COPY handler.py /handler.py
CMD [ "python", "-u", "/handler.py" ]