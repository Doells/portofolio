class NewsModel {
  int? id;
  int? usersId;
  String? title;
  String? description;
  String? link;
  String? imageUrl;
  DateTime? deletedAt;
  DateTime? createdAt;
  DateTime? updatedAt;

  NewsModel({
    this.id,
    this.usersId,
    this.title,
    this.description,
    this.deletedAt,
    this.createdAt,
    this.link,
    this.updatedAt,
    this.imageUrl,
  });

  factory NewsModel.fromJson(Map<String, dynamic> json) {
    return NewsModel(
      id: json['id'],
      usersId: json['users_id'],
      title: json['title'],
      description: json['description'],
      deletedAt: json['deleted_at'] != null ? DateTime.parse(json['deleted_at']) : null,
      createdAt: DateTime.parse(json['created_at']),
      updatedAt: DateTime.parse(json['updated_at']),
      imageUrl: json['thumbnail_news']?.first?['thumbnail'],
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'id': id,
      'users_id': usersId,
      'title': title,
      'description': description,
      'deleted_at': deletedAt?.toIso8601String(),
      'created_at': createdAt?.toIso8601String(),
      'updated_at': updatedAt?.toIso8601String(),
    };
  }
}
