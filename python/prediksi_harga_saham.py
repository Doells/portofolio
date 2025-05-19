# Import library yang diperlukan
import pandas as pd
import numpy as np
from sklearn.model_selection import train_test_split
from sklearn.linear_model import LinearRegression
from sklearn.metrics import mean_squared_error, r2_score
import matplotlib.pyplot as plt

# 1. Mengimpor Data
# Pastikan untuk mengganti file_path dengan path yang sesuai
file_path = 'C:/Users/DOELLS/Desktop/python/finance.csv'
data = pd.read_csv(file_path)

# Menyaring kolom yang diperlukan
data['Date'] = pd.to_datetime(data['Date'], errors='coerce')
data = data[['Date', 'Close']]

# Menghapus nilai yang hilang
data = data.dropna(subset=['Close'])

# 2. Preprocessing Data
# Mengonversi data 'Date' menjadi fitur numerik (misalnya, angka hari)
data['Day'] = (data['Date'] - data['Date'].min()).dt.days

# 3. Memisahkan data latih dan uji
X = data[['Day']]  # Fitur: hari (Day)
y = data['Close']  # Target: harga saham (Close)

# Membagi data menjadi data latih dan uji (80% latih, 20% uji)
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

# Menghapus NaN di X dan y secara bersamaan
data_cleaned = data.dropna(subset=['Day', 'Close'])

# Memperbarui X dan y dengan data yang telah dibersihkan
X = data_cleaned[['Day']]
y = data_cleaned['Close']

# Memisahkan data latih dan uji
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)


# 4. Pelatihan Model (Regresi Linier)
model = LinearRegression()
model.fit(X_train, y_train)

# 5. Evaluasi Model
# Prediksi harga saham untuk data uji
y_pred = model.predict(X_test)

# Menghitung error dan akurasi model
mse = mean_squared_error(y_test, y_pred)  # Mean Squared Error
r2 = r2_score(y_test, y_pred)  # Koefisien determinasi R^2


print(X_train.shape)
print(X_test.shape)
print(y_train.shape)
print(y_test.shape)

# Menampilkan hasil evaluasi
print(f'Mean Squared Error (MSE): {mse}')
print(f'R-squared (R²): {r2}')


# 6. Visualisasi Prediksi
plt.figure(figsize=(10,6))
plt.scatter(X_test, y_test, color='blue', label='Data Asli')
plt.plot(X_test, y_pred, color='red', linewidth=2, label='Prediksi')
plt.title('Prediksi Harga Saham dengan Regresi Linier')
plt.xlabel('Hari')
plt.ylabel('Harga Saham')
plt.legend()
plt.show()
