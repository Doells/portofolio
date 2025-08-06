import 'package:get/get.dart';
import 'package:pkkmb/app/data/models/presensi_model.dart';
import 'package:pkkmb/app/data/providers/presensi_api.dart';

class PresensiController extends GetxController {
  RxBool loading = false.obs;
  RxList<PresensiModel> presensiList = <PresensiModel>[].obs;

  getPresensiList() async {
    loading.value = true;

    try {
      presensiList.value = await PresensiApi.getPresensiList();
    } catch (e) {
      print('error get presensi $e');
    }

    loading.value = false;
  }

  @override
  void onInit() {
    super.onInit();

    getPresensiList();
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

class Presensi {
  final int id;
  final String title;
  final String time;
  final int total;
  final int count;

  Presensi({
    required this.id,
    required this.title,
    required this.time,
    required this.total,
    required this.count,
  });

  factory Presensi.fromJson(json) {
    return Presensi(
      time: json['time'],
      id: json['id'],
      title: json['title'],
      total: json['total'],
      count: json['count'],
    );
  }
}
