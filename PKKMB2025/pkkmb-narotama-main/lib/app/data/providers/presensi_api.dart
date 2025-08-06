import 'package:dio/dio.dart';
import 'package:pkkmb/app/data/models/attendance_model.dart';
import 'package:pkkmb/app/data/models/presensi_model.dart';
import 'package:pkkmb/app/data/services/dio_service.dart';

class PresensiApi {
  static Future<List<PresensiModel>> getPresensiList() async {
    List<PresensiModel> list = [];

    try {
      Response response = await DioService.get('/dashboard/admin/presensi');

      if (response.data['data'] != null) {
        print(response.data);

        list = response.data['data']
          .map<PresensiModel>((e) => PresensiModel.fromJson(e))
          .toList();
      }
    } on DioException catch (e) {
      throw Exception(e);
    }

    return list;
  }

  static Future getDetailPresensi() async {}

  static Future<Response> addPresensi(String data) async {
    Response response = await DioService.post('/dashboard/admin/presensi/qrcode/kirim-presensi', data: {
      "qr_code": data,
    });
  
    return response;
  }

  static Future<List<AttendanceModel>> getAttendance(int id) async {
    List<AttendanceModel> list = [];

    try {
      Response response = await DioService.get('/dashboard/admin/presensi/$id');

      if (response.data['data-peserta-presensi'] != null) {
        print(response.data);

        list = response.data['data-peserta-presensi']
          .map<AttendanceModel>((e) => AttendanceModel.fromJson(e))
          .toList();
      }
    } on DioException catch (e) {
      throw Exception(e);
    }

    return list;
  }
}