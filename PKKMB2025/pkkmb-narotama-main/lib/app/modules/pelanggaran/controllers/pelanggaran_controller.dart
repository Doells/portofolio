import 'package:get/get.dart';
import 'package:pkkmb/app/data/models/pelanggaran_user_model.dart';
import 'package:pkkmb/app/data/providers/pelanggaran_api.dart';

class PelanggaranController extends GetxController {
  RxBool loading = false.obs;
  String keyword = '';
  RxList<PelanggaranUserModel> pelanggaranList = <PelanggaranUserModel>[].obs;
  RxList<PelanggaranUserModel> filteredPelanggaranList = <PelanggaranUserModel>[].obs;

  getPelanggaranList() async {
    loading.value = true;

    try {
      pelanggaranList.value = await PelanggaranApi.getPelanggaranList();
      filteredPelanggaranList.value = pelanggaranList;
    } catch (e) {
      print('error get tugas $e');
    }

    loading.value = false;
  }

  @override
  void onInit() {
    getPelanggaranList();

    super.onInit();
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
