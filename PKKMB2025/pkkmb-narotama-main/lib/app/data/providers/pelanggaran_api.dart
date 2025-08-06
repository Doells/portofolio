import 'package:dio/dio.dart';
import 'package:pkkmb/app/data/models/pelanggaran_user_model.dart';
import 'package:pkkmb/app/data/services/dio_service.dart';

class PelanggaranApi {
  static Future<List<PelanggaranUserModel>> getPelanggaranList() async {
    List<PelanggaranUserModel> list = <PelanggaranUserModel>[];

    try {
      Response response = await DioService.get('/dashboard/admin/pelanggaran');

      response.data['dataPeserta'].forEach((user) {
        List<dynamic> filteredPelanggaran = response.data['dataPelanggaran'].where((e) => e['peserta_id'] == user['id']).toList();
        int totalPoints = filteredPelanggaran.fold(0, (sum, item) => sum + int.parse(item['poin']));

        list.add(PelanggaranUserModel.fromJson(user, totalPoints, filteredPelanggaran));
      });
    } on DioException catch (e) {
      throw Exception(e);
    }

    return list;
  }

  static Future<Response> addPelanggaran(Map<String, dynamic> data) async {
    Response response = await DioService.post('/dashboard/admin/pelanggaran/store', data: data);
  
    return response;
  }
}
