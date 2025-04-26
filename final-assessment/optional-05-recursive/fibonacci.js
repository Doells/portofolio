/**
 * Fungsi untuk menghasilkan deret Fibonacci hingga elemen ke-n menggunakan rekursi.
 * Fungsi ini akan mengembalikan array yang berisi deret Fibonacci.
 * @param {number} n - Jumlah elemen dalam deret Fibonacci.
 * @returns {Array} - Deret Fibonacci hingga elemen ke-n.
 */
function fibonacci(n, result = [0, 1]) {
    if (result.length >= n) {
      return result.slice(0, n); // Kembalikan hasil yang sudah dipotong hingga elemen ke-n
    } else {
      result.push(result[result.length - 1] + result[result.length - 2]);
      return fibonacci(n, result); // Rekursi untuk menambah elemen berikutnya
    }
  }
// Jangan hapus kode di bawah ini!
export default fibonacci;
