class SubmissionDetailModel {
  final int id;
  final int tambahtugasId;
  final String text;
  final String submitDate;
  final String submitEnterTime;
  final String status;
  final String createdAt;
  final List<SubmissionFile>? files;

  SubmissionDetailModel({
    required this.id,
    required this.tambahtugasId,
    required this.text,
    required this.submitDate,
    required this.submitEnterTime,
    required this.status,
    required this.createdAt,
    this.files,
  });

  factory SubmissionDetailModel.fromJson(Map<String, dynamic> json) {
    return SubmissionDetailModel(
      id: json['id'],
      tambahtugasId: json['tambahtugas_id'],
      text: json['text'],
      submitDate: json['submit_date'],
      submitEnterTime: json['submit_enter_time'],
      status: json['status'],
      createdAt: json['created_at'],
      files: json['files'] != null
          ? (json['files'] as List).map((file) => SubmissionFile.fromJson(file)).toList()
          : null,
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'id': id,
      'tambahtugas_id': tambahtugasId,
      'text': text,
      'submit_date': submitDate,
      'submit_enter_time': submitEnterTime,
      'status': status,
      'created_at': createdAt,
      'files': files?.map((file) => file.toJson()).toList(),
    };
  }
}

class SubmissionFile {
  final int id;
  final int? taskId;
  final int? tambahtugasId;
  final String fileName;
  final String filePath;
  final String fileExtension;
  final String createdAt;
  final String updatedAt;

  SubmissionFile({
    required this.id,
    this.taskId,
    this.tambahtugasId,
    required this.fileName,
    required this.filePath,
    required this.fileExtension,
    required this.createdAt,
    required this.updatedAt,
  });

  factory SubmissionFile.fromJson(Map<String, dynamic> json) {
    return SubmissionFile(
      id: json['id'],
      taskId: json['task_id'],
      tambahtugasId: json['tambahtugas_id'],
      fileName: json['file_name'],
      filePath: json['file_path'],
      fileExtension: json['file_extension'],
      createdAt: json['created_at'],
      updatedAt: json['updated_at'],
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'id': id,
      'task_id': taskId,
      'tambahtugas_id': tambahtugasId,
      'file_name': fileName,
      'file_path': filePath,
      'file_extension': fileExtension,
      'created_at': createdAt,
      'updated_at': updatedAt,
    };
  }
}
