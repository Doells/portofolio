class SubmissionModel {
  final int id;
  final String userName;
  final int kelompokId;
  final String? status;
  final String createdAt;
  final String? text;
  final String? submitDate;
  final String? submitEnterTime;

  SubmissionModel({
    required this.id,
    required this.userName,
    required this.kelompokId,
    this.status,
    required this.createdAt,
    this.text,
    this.submitDate,
    this.submitEnterTime,
  });

  factory SubmissionModel.fromJson(Map<String, dynamic> json) {
    return SubmissionModel(
      id: json['id'],
      userName: json['user']['name'],
      kelompokId: json['user']['kelompok_id'],
      status: json['status'],
      createdAt: json['created_at'],
      text: json['text'],
      submitDate: json['submit_date'],
      submitEnterTime: json['submit_enter_time'],
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'id': id,
      'user_name': userName,
      'kelompok_id': kelompokId,
      'status': status,
      'created_at': createdAt,
      'text': text,
      'submit_date': submitDate,
      'submit_enter_time': submitEnterTime,
    };
  }
}
