class PresensiModel {
  final int id;
  final String title;
  final String description;
  final DateTime date;
  final String startTime;
  final String batasStartTime;
  final String? endTime;
  final String? batasEndTime;
  final String code;
  final DateTime createdAt;
  final DateTime updatedAt;

  PresensiModel({
    required this.id,
    required this.title,
    required this.description,
    required this.date,
    required this.startTime,
    required this.batasStartTime,
    this.endTime,
    this.batasEndTime,
    required this.code,
    required this.createdAt,
    required this.updatedAt,
  });

  factory PresensiModel.fromJson(Map<String, dynamic> json) {
    return PresensiModel(
      id: json['id'],
      title: json['title'],
      description: json['description'],
      date: DateTime.parse(json['date']).toLocal(),
      startTime: json['start_time'] != null ? json['start_time'].substring(0, 5) : '-',
      batasStartTime: json['batas_start_time'] != null ? json['batas_start_time'].substring(0, 5) : '-',
      endTime: json['end_time'],
      batasEndTime: json['batas_end_time'],
      code: json['code'],
      createdAt: DateTime.parse(json['created_at']).toLocal(),
      updatedAt: DateTime.parse(json['updated_at']).toLocal(),
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'id': id,
      'title': title,
      'description': description,
      'date': date.toIso8601String(),
      'start_time': startTime,
      'batas_start_time': batasStartTime,
      'end_time': endTime,
      'batas_end_time': batasEndTime,
      'code': code,
      'created_at': createdAt.toIso8601String(),
      'updated_at': updatedAt.toIso8601String(),
    };
  }
}
