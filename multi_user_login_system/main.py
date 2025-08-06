import sqlite3
import base64
from cryptography.fernet import Fernet
import getpass
import os

# Fungsi untuk menghasilkan kunci enkripsi
def generate_key():
    return Fernet.generate_key()

# Fungsi untuk mengenkripsi pesan atau file
def encrypt_message(key, message):
    fernet = Fernet(key)
    encrypted_message = fernet.encrypt(message.encode())
    return base64.b64encode(encrypted_message).decode()  # Encode to base64 string

# Fungsi untuk mendekripsi pesan atau file
def decrypt_message(key, encrypted_message):
    fernet = Fernet(key)
    encrypted_message_bytes = base64.b64decode(encrypted_message)
    decrypted_message = fernet.decrypt(encrypted_message_bytes).decode()
    return decrypted_message

# Fungsi untuk membuat database SQLite dan tabel pengguna
def create_db():
    db_path = os.path.join(os.getcwd(), 'multi_user_login_system', 'user_data.db')  # Path ke database
    conn = sqlite3.connect(db_path)
    c = conn.cursor()
    
    # Membuat tabel pengguna jika belum ada
    c.execute('''CREATE TABLE IF NOT EXISTS users (
                    username TEXT PRIMARY KEY,
                    password TEXT NOT NULL,
                    key BLOB NOT NULL)''')
    
    # Membuat tabel file jika belum ada
    c.execute('''CREATE TABLE IF NOT EXISTS files (
                    sender TEXT,
                    receiver TEXT,
                    file_name TEXT,
                    encrypted_file BLOB)''')
    
    conn.commit()
    conn.close()

# Fungsi untuk menyimpan data pengguna ke SQLite
def save_user_data(username, password, key):
    db_path = os.path.join(os.getcwd(), 'multi_user_login_system', 'user_data.db')  # Path ke database
    conn = sqlite3.connect(db_path)
    c = conn.cursor()
    
    # Enkripsi password
    encrypted_password = encrypt_message(key, password)
    
    # Menyimpan data pengguna
    c.execute('INSERT OR REPLACE INTO users (username, password, key) VALUES (?, ?, ?)',
              (username, encrypted_password, key))
    
    conn.commit()
    conn.close()

# Fungsi untuk memuat data pengguna dari SQLite
def load_user_data(username):
    db_path = os.path.join(os.getcwd(), 'multi_user_login_system', 'user_data.db')  # Path ke database
    conn = sqlite3.connect(db_path)
    c = conn.cursor()
    
    c.execute('SELECT username, password, key FROM users WHERE username = ?', (username,))
    user_data = c.fetchone()
    
    conn.close()
    
    if user_data:
        return {'username': user_data[0], 'password': user_data[1], 'key': user_data[2]}
    return None

# Fungsi untuk menyimpan file terenkripsi ke database
def save_file(sender, receiver, file_path):
    # Membaca dan mengenkripsi file
    with open(file_path, 'rb') as file:
        file_data = file.read()
    
    encrypted_file_data = encrypt_message(users_db[receiver]['key'], file_data.decode('latin1'))  # Enkripsi file
    
    db_path = os.path.join(os.getcwd(), 'multi_user_login_system', 'user_data.db')  # Path ke database
    conn = sqlite3.connect(db_path)
    c = conn.cursor()
    
    c.execute('INSERT INTO files (sender, receiver, file_name, encrypted_file) VALUES (?, ?, ?, ?)',
              (sender, receiver, os.path.basename(file_path), encrypted_file_data))
    
    conn.commit()
    conn.close()
    print(f"File {file_path} berhasil dikirim ke {receiver}")

# Fungsi untuk menerima file dari pengguna lain
def receive_file(receiver_username, sender_username, file_name):
    db_path = os.path.join(os.getcwd(), 'multi_user_login_system', 'user_data.db')  # Path ke database
    conn = sqlite3.connect(db_path)
    c = conn.cursor()
    
    c.execute('SELECT encrypted_file FROM files WHERE sender = ? AND receiver = ? AND file_name = ?',
              (sender_username, receiver_username, file_name))
    
    file_data = c.fetchone()
    
    if file_data:
        encrypted_file_data = file_data[0]
        
        # Dekripsi file
        decrypted_file_data = decrypt_message(users_db[receiver_username]['key'], encrypted_file_data)
        
        # Menyimpan file yang didekripsi
        with open(f"received_{file_name}", 'wb') as file:
            file.write(decrypted_file_data.encode('latin1'))
        
        print(f"File diterima dan disimpan sebagai received_{file_name}")
    else:
        print("File tidak ditemukan atau tidak ada akses ke file ini.")
    
    conn.close()

# Fungsi untuk registrasi pengguna baru
def register():
    print("=== Daftar Pengguna Baru ===")
    username = input("Masukkan Username: ")
    
    if load_user_data(username):
        print("Username sudah ada!")
        return None

    password = getpass.getpass("Masukkan Password: ")
    key = generate_key()

    # Simpan data pengguna
    save_user_data(username, password, key)
    print("Registrasi berhasil!")
    return username

# Fungsi untuk login pengguna
def login():
    print("=== Sistem Login ===")
    username = input("Masukkan Username: ")
    
    user_data = load_user_data(username)
    if not user_data:
        print("Username tidak ditemukan!")
        return None

    password = getpass.getpass("Masukkan Password: ")

    # Verifikasi password
    if decrypt_message(user_data['key'], user_data['password']) == password:
        print("Login berhasil!")
        return username
    else:
        print("Password salah!")
        return None

# Fungsi utama
def main():
    create_db()  # Membuat database dan tabel jika belum ada

    while True:
        print("\n=== Menu ===")
        print("1. Login")
        print("2. Register")
        print("3. Kirim File")
        print("4. Terima File")
        print("5. Keluar")

        choice = input("Pilih menu (1/2/3/4/5): ")

        if choice == '1':
            username = login()
            if username:
                print(f"Selamat datang, {username}!")
        elif choice == '2':
            username = register()
            if username:
                print(f"User {username} berhasil didaftarkan!")
        elif choice == '3':
            sender_username = input("Masukkan username pengirim: ")
            receiver_username = input("Masukkan username penerima: ")
            file_path = input("Masukkan path file untuk dikirim: ")
            save_file(sender_username, receiver_username, file_path)
        elif choice == '4':
            receiver_username = input("Masukkan username penerima: ")
            sender_username = input("Masukkan username pengirim: ")
            file_name = input("Masukkan nama file yang diterima: ")
            receive_file(receiver_username, sender_username, file_name)
        elif choice == '5':
            print("Keluar dari sistem...")
            break
        else:
            print("Pilihan tidak valid!")

if __name__ == "__main__":
    main()
