class UserModel {
  final int id;
  final String name;
  final String nim;
  final int positionId;
  final int roleId;
  final int kelompokId;

  UserModel({
    required this.id,
    required this.name,
    required this.nim,
    required this.positionId,
    required this.roleId,
    required this.kelompokId,
  });

  factory UserModel.fromJson(Map<String, dynamic> json) {
    return UserModel(
      id: json['id'],
      name: json['name'],
      nim: json['nim'],
      positionId: json['position_id'],
      roleId: json['role_id'],
      kelompokId: json['kelompok_id'],
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