/**
 * Fungsi untuk menghitung faktorial dari bilangan n menggunakan rekursi.
 * @param {number} n - Bilangan positif untuk menghitung faktorial.
 * @returns {number} - Hasil faktorial dari n.
 */
function factorial(n) {
    if (n <= 1) {
      return 1; // basis kasus
    } else {
      return n * factorial(n - 1); // rekursi
    }
  }
  

// Jangan hapus kode di bawah ini!
export default factorial;
