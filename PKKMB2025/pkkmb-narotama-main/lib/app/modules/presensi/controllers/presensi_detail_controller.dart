import 'package:get/get.dart';
import 'package:dio/dio.dart' as dio;
import 'package:pkkmb/app/data/models/attendance_model.dart';
import 'package:pkkmb/app/data/models/presensi_model.dart';
import 'package:pkkmb/app/data/providers/presensi_api.dart';

class PresensiDetailController extends GetxController {
  final PresensiModel presensi;
  RxBool loading = false.obs;
  RxList<AttendanceModel> attendanceList = <AttendanceModel>[].obs;

  PresensiDetailController({ required this.presensi });

  Future<dio.Response> addPresensi(String code) async {
    dio.Response response = await PresensiApi.addPresensi(code);

    return response;
  }

  getAttendanceList() async {
    loading.value = true;

    try {
      attendanceList.value = await PresensiApi.getAttendance(presensi.id);
    } catch (e) {
      print('error get presensi $e');
    }

    loading.value = false;
  }

  @override
  void onInit() {
    super.onInit();

    getAttendanceList();
  }

  @override
  void onReady() {
    super.onReady();
  }

  @override
  void onClose() {
    super.onClose();
  }
}
