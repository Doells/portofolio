class TugasModel {
  final int id;
  final String title;
  final String description;
  final String startDate;
  final String startTime;
  final String inputType;
  final DateTime createdAt;
  final DateTime updatedAt;
  final DateTime deadline;
  final List<dynamic>? hasil;

  TugasModel({
    required this.id,
    required this.title,
    required this.description,
    required this.startDate,
    required this.startTime,
    required this.inputType,
    required this.createdAt,
    required this.updatedAt,
    required this.deadline,
    this.hasil,
  });

  factory TugasModel.fromJson(Map<String, dynamic> json, List<dynamic>? hasil) {
    final filteredList = hasil?.where((e) => e['tambahtugas_id'] == json['id']).toList();

    return TugasModel(
      id: json['id'],
      title: json['title'],
      description: json['description'],
      startDate: json['start_date'],
      startTime: json['start_time'],
      inputType: json['input_type'],
      createdAt: DateTime.parse(json['created_at']).toLocal(),
      updatedAt: DateTime.parse(json['updated_at']).toLocal(),
      deadline: DateTime.parse('${json['end_date']} ${json['batas_start_time']}'),
      hasil: filteredList,
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'id': id,
      'title': title,
      'description': description,
      'start_date': startDate,
      'start_time': startTime,
      'input_type': inputType,
      'created_at': createdAt.toIso8601String(),
      'updated_at': updatedAt.toIso8601String(),
      'deadline': deadline.toIso8601String(),
    };
  }
}
