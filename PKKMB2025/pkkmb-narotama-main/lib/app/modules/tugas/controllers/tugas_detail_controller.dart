import 'package:adaptive_dialog/adaptive_dialog.dart';
import 'package:dio/dio.dart' as dio;
import 'package:file_selector/file_selector.dart';
import 'package:get/get.dart';
import 'package:pkkmb/app/data/models/tugas_model.dart';
import 'package:pkkmb/app/data/providers/tugas_api.dart';
import 'package:pkkmb/app/modules/profile/controllers/profile_controller.dart';
import 'package:pkkmb/app/modules/tugas/controllers/tugas_controller.dart';
import 'package:pkkmb/app/widgets/naro_widgets.dart';

class TugasDetailController extends GetxController {
  final TugasModel tugas;

  RxBool loading = false.obs;
  Rx<String?> fileName = Rx<String?>(null);
  XFile? file;
  String description = '';
  ProfileController profileController = Get.find<ProfileController>();
  TugasController tugasController = Get.find<TugasController>();

  TugasDetailController({ required this.tugas });

  submit() async {
    if (
      (tugas.inputType.toLowerCase() == 'file' && fileName.value == null) ||
      (tugas.inputType.toLowerCase() == 'text' && description.isEmpty)
    ) {
      showToast('Invalid', 'Harap lengkapi tugas terlebih dahulu!', type: ToastType.error);

      return;
    }

    loading.value = true;

    try {
      if (tugas.inputType.toLowerCase() == 'file') {
        dio.Response response = await TugasAPI.submitTugasFile(tugas.id, file!, profileController.userData.value.id);

        print(response);
      }

      if (tugas.inputType.toLowerCase() == 'text') {
        dio.Response response = await TugasAPI.submitTugasText(tugas.id, description, profileController.userData.value.id);

        print(response);
      }

      loading.value = false;

      final OkCancelResult result = await showOkAlertDialog(
        context: Get.context!,
        title: 'Berhasil!',
        message: 'Berhasil menambahkan data tugas!',
        okLabel: 'Selesai',
        canPop: false,
      );

      if (result == OkCancelResult.ok) {
        Get.back();

        tugasController.getTugasList();
      }
    } on dio.DioException catch (e) {
      print(e.response?.data);
      loading.value = false;

      String message = e.response?.data?['message'] ?? 'Terjadi kesalahan saat menginputkan data presensi';
      showToast('Terjadi Kesalahan', message, type: ToastType.error);
    }
  }

  @override
  void onInit() {
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
