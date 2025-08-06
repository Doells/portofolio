class KetentuanModel {
  final int id;
  final String title;
  final int jenisKetentuanId;
  final int poin;

  KetentuanModel({
    required this.id,
    required this.title,
    required this.jenisKetentuanId,
    required this.poin,
  });

  factory KetentuanModel.fromJson(Map<String, dynamic> json) {
    return KetentuanModel(
      id: json['id'],
      title: json['title'],
      jenisKetentuanId: json['jenis_ketentuan_id'],
      poin: json['poin'],
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'id': id,
      'title': title,
      'jenis_ketentuan_id': jenisKetentuanId,
      'poin': poin,
    };
  }
}
