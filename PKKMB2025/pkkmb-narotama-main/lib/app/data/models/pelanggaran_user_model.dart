class PelanggaranUserModel {
  final int id;
  final String name;
  final String nim;
  final int positionId;
  final int roleId;
  final int kelompokId;
  final int totalPoint;
  final List<PelanggaranDetail> detail;

  PelanggaranUserModel({
    required this.id,
    required this.name,
    required this.nim,
    required this.positionId,
    required this.roleId,
    required this.kelompokId,
    this.totalPoint = 0,
    this.detail = const <PelanggaranDetail>[],
  });

  factory PelanggaranUserModel.fromJson(
    Map<String, dynamic> json,
    int totalPoint,
    List<dynamic> pelanggaranDetail
  ) {
    return PelanggaranUserModel(
      id: json['id'],
      name: json['name'],
      nim: json['nim'],
      positionId: json['position_id'],
      roleId: json['role_id'],
      kelompokId: json['kelompok_id'],
      totalPoint: totalPoint,
      detail: pelanggaranDetail.map<PelanggaranDetail>((e) => PelanggaranDetail.fromJson(e)).toList()
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'id': id,
      'name': name,
      'nim': nim,
      'position_id': positionId,
      'role_id': roleId,
      'kelompok_id': kelompokId,
    };
  }
}

class PelanggaranDetail {
  final int ketentuanId;
  final String title;
  final int poin;
  final String createdAt;

  PelanggaranDetail({
    required this.ketentuanId,
    required this.title,
    required this.poin,
    required this.createdAt,
  });

  factory PelanggaranDetail.fromJson(Map<String, dynamic> json) {
    return PelanggaranDetail(
      ketentuanId: json['ketentuan_id'],
      title: json['title'],
      poin: int.parse(json['poin']),
      createdAt: json['created_at'],
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'ketentuan_id': ketentuanId,
      'title': title,
      'poin': poin,
    };
  }
}
