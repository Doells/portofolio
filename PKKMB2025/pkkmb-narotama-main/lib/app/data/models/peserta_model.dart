class PesertaModel {
  final int id;
  final int userId;
  final String photo;
  final String nim;
  final String namaLengkap;
  final String prodi;
  final String fakultas;
  final String noHp;
  final String email;
  final String sistemKuliah;
  final String tahunAngkatan;
  final String jalurPenerimaan;
  final String jenisKelamin;
  final String tglLahir;
  final String tempatLahir;
  final String agama;
  final String alamat;
  final DateTime createdAt;
  final DateTime updatedAt;

  PesertaModel({
    required this.id,
    required this.userId,
    required this.photo,
    required this.nim,
    required this.namaLengkap,
    required this.prodi,
    required this.fakultas,
    required this.noHp,
    required this.email,
    required this.sistemKuliah,
    required this.tahunAngkatan,
    required this.jalurPenerimaan,
    required this.jenisKelamin,
    required this.tglLahir,
    required this.tempatLahir,
    required this.agama,
    required this.alamat,
    required this.createdAt,
    required this.updatedAt,
  });

  factory PesertaModel.fromJson(Map<String, dynamic> json) {
    return PesertaModel(
      id: json['id'] ?? 0,
      userId: json['user_id'] ?? 0,
      photo: json['photo'] ?? '',
      nim: json['nim'] ?? '',
      namaLengkap: json['nama_lengkap'] ?? '',
      prodi: json['prodi'] ?? '',
      fakultas: json['fakultas'] ?? '',
      noHp: json['no_hp'] ?? '',
      email: json['email'] ?? '',
      sistemKuliah: json['sistem_kuliah'] ?? '',
      tahunAngkatan: json['tahun_angkatan'] ?? '',
      jalurPenerimaan: json['jalur_penerimaan'] ?? '',
      jenisKelamin: json['jenis_kelamin'] ?? '',
      tglLahir: json['tgl_lahir'] ?? '',
      tempatLahir: json['tempat_lahir'] ?? '',
      agama: json['agama'] ?? '',
      alamat: json['alamat'] ?? '',
      createdAt: DateTime.tryParse(json['created_at'] ?? '') ?? DateTime.now(),
      updatedAt: DateTime.tryParse(json['updated_at'] ?? '') ?? DateTime.now(),
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'id': id,
      'user_id': userId,
      'photo': photo,
      'nim': nim,
      'nama_lengkap': namaLengkap,
      'prodi': prodi,
      'fakultas': fakultas,
      'no_hp': noHp,
      'email': email,
      'sistem_kuliah': sistemKuliah,
      'tahun_angkatan': tahunAngkatan,
      'jalur_penerimaan': jalurPenerimaan,
      'jenis_kelamin': jenisKelamin,
      'tgl_lahir': tglLahir,
      'tempat_lahir': tempatLahir,
      'agama': agama,
      'alamat': alamat,
      'created_at': createdAt.toIso8601String(),
      'updated_at': updatedAt.toIso8601String(),
    };
  }
}
