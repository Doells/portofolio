// index.test.js

import test from 'node:test';
import assert from 'node:assert';
import sum from './index.js'; // Pastikan fungsi sum diekspor dari index.js

// Pengujian dasar untuk menjumlahkan dua angka
test('fungsi sum menjumlahkan dua angka dengan benar', (t) => {
  assert.strictEqual(sum(1, 2), 3); // Menguji 1 + 2 = 3
  assert.strictEqual(sum(-1, 1), 0); // Menguji -1 + 1 = 0 (karena nilai negatif)
  assert.strictEqual(sum(-1, -1), 0); // Menguji -1 + -1 = 0 (karena nilai negatif)
  assert.strictEqual(sum(0, 0), 0); // Menguji 0 + 0 = 0
});

// Pengujian dengan tipe data yang salah (memeriksa 0 jika bukan angka)
test('fungsi sum dengan tipe data yang salah', (t) => {
  assert.strictEqual(sum(1, 'a'), 0); // Menguji 1 + 'a' harus menghasilkan 0 (karena bukan angka)
  assert.strictEqual(sum('a', 'b'), 0); // Menguji 'a' + 'b' harus menghasilkan 0 (karena bukan angka)
});
