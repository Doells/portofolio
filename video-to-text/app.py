import os
from flask import Flask, render_template, request
from pytube import YouTube
from pydub import AudioSegment
import speech_recognition as sr

app = Flask(__name__)

# Path untuk menyimpan file sementara
UPLOAD_FOLDER = 'uploads'
os.makedirs(UPLOAD_FOLDER, exist_ok=True)
app.config['UPLOAD_FOLDER'] = UPLOAD_FOLDER

# Fungsi untuk mengunduh audio dari video YouTube
def download_audio(url):
    yt = YouTube(url)
    stream = yt.streams.filter(only_audio=True).first()
    audio_file = stream.download(output_path=UPLOAD_FOLDER, filename='audio.mp4')
    
    # Mengonversi file mp4 ke wav agar bisa diproses oleh speech recognition
    audio = AudioSegment.from_file(audio_file)
    audio.export(os.path.join(UPLOAD_FOLDER, 'audio.wav'), format='wav')
    
    return os.path.join(UPLOAD_FOLDER, 'audio.wav')

# Fungsi untuk mengonversi audio ke teks
def audio_to_text(audio_path):
    recognizer = sr.Recognizer()
    with sr.AudioFile(audio_path) as source:
        audio = recognizer.record(source)  # Membaca seluruh audio
    try:
        text = recognizer.recognize_google(audio)  # Menggunakan Google Web Speech API
        return text
    except sr.UnknownValueError:
        return "Audio tidak dapat dikenali"
    except sr.RequestError as e:
        return f"Error dengan layanan Speech Recognition; {e}"

# Route utama untuk halaman web
@app.route('/')
def index():
    return render_template('index.html')

# Route untuk mengunduh dan mengonversi video YouTube
@app.route('/convert', methods=['POST'])
def convert():
    video_url = request.form['video_url']
    
    # Download audio dan konversi ke teks
    audio_path = download_audio(video_url)
    text = audio_to_text(audio_path)
    
    # Hapus file audio setelah diproses
    os.remove(audio_path)
    
    return render_template('result.html', text=text)

if __name__ == '__main__':
    app.run(debug=True)
