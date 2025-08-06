import 'package:dio/dio.dart';
import 'package:pkkmb/app/data/models/peserta_model.dart';
import 'package:pkkmb/app/data/services/dio_service.dart';

class AuthAPI {
  static Future<Response> login({
    required String nim,
    required String password
  }) async {
    Response response = await DioService.post('/login', data: {
      'nim': nim,
      'password': password
    });

    return response;
  }

  static Future<PesertaModel?> getUserDetail(int userId) async {
    Response response = await DioService.get('/dashboard/detail-user?user_id=$userId');

    print(response.data['dataDetail']);

    if (response.data['dataDetail'] != null && response.data['dataDetail'].length > 0) {
      return PesertaModel.fromJson(response.data['dataDetail'][0]);
    }

    return null;
  }
}