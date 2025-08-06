import 'package:dio/dio.dart';
import 'package:file_selector/file_selector.dart';
import 'package:pkkmb/app/data/models/submission_detail_model.dart';
import 'package:pkkmb/app/data/models/submission_model.dart';
import 'package:pkkmb/app/data/models/tugas_model.dart';
import 'package:pkkmb/app/data/services/dio_service.dart';

class TugasAPI {
  static Future<List<TugasModel>> getTugasList({ int? userId }) async {
    List<TugasModel> list = [];

    try {
      Response response = await DioService.get('/dashboard/user/tugas?user_id=$userId');

      print(response.data['Data Tugas']);

      if (response.data['Data Tugas'] != null) {
        final dataHasil = response.data['Data Hasil'];

        list = response.data['Data Tugas']
          .map<TugasModel>((e) => TugasModel.fromJson(e, dataHasil))
          .toList();
      }
    } on DioException catch (e) {
      throw Exception(e);
    }

    return list;
  }

  static Future<Response> submitTugasText(int id, String text, int userId) async {
    try {
      Response response = await DioService.post('/dashboard/user/tugas/$id/unggah', data: {
        "tambahtugas_id": id,
        "text": text,
        "user_id": userId,
      });

      return response;
    } on DioException catch (_) {
      rethrow;
    }
  }

  static Future<Response> submitTugasFile(int id, XFile file, int userId) async {
    try {
      final formData = FormData.fromMap({
      "id_tambahtugas": id,
      "file": await MultipartFile.fromFile(file.path, filename: file.name),
      "user_id": userId,
    });

    Response response = await DioService.post(
      '/dashboard/user/tugas/file/$id',
      data: formData,
      options: Options(
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      ),
    );

    return response;
    } on DioException catch (_) {
      rethrow;
    }
  }

  static Future<List<SubmissionModel>> getSubmission(int id) async {
    List<SubmissionModel> list = [];

    try {
      Response response = await DioService.get('/dashboard/admin/tugas/pengumpulan/detail-tugas/$id');

      if (response.data['Hasil Tugas'] != null) {
        print(response.data);

        list = response.data['Hasil Tugas']
          .map<SubmissionModel>((e) => SubmissionModel.fromJson(e))
          .toList();
      }
    } on DioException catch (e) {
      throw Exception(e);
    }

    return list;
  }

  static Future<SubmissionDetailModel?> getSubmissionDetail(int id) async {
    SubmissionDetailModel? detail;

    try {
      Response response = await DioService.get('/dashboard/admin/tugas/pengumpulan/hasil/$id');

      if (response.data['data'] != null) {
        print(response.data['data']);

        detail = SubmissionDetailModel.fromJson(response.data['data']);
      }
    } on DioException catch (e) {
      throw Exception(e);
    }

    return detail;
  }
}