class AttendanceModel {
  final int id;
  final int userId;
  final int kelompokId;
  final String userName;
  final String createdAt;
  final String? permissionReason;

  AttendanceModel({
    required this.id,
    required this.userId,
    required this.kelompokId,
    required this.userName,
    required this.createdAt,
    this.permissionReason,
  });

  factory AttendanceModel.fromJson(Map<String, dynamic> json) {
    return AttendanceModel(
      id: json['id'],
      userId: json['user_id'],
      kelompokId: json['user']['kelompok_id'],
      userName: json['user']['name'],
      createdAt: json['created_at'],
      permissionReason: json['permission_reason'],
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'user_id': userId,
      'user_name': userName,
      'created_at': createdAt,
      'permission_reason': permissionReason,
    };
  }
}
