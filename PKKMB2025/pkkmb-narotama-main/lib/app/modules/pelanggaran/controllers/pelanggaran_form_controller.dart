import 'package:adaptive_dialog/adaptive_dialog.dart';
import 'package:get/get.dart';
import 'package:pkkmb/app/data/models/ketentuan_model.dart';
import 'package:pkkmb/app/data/models/peserta_model.dart';
import 'package:pkkmb/app/data/providers/auth_api.dart';
import 'package:pkkmb/app/data/providers/pelanggaran_api.dart';
import 'package:pkkmb/app/modules/main/controllers/main_controller.dart';
import 'package:pkkmb/app/modules/profile/controllers/profile_controller.dart';
import 'package:pkkmb/app/widgets/naro_widgets.dart';
import 'package:dio/dio.dart' as dio;

class PelanggaranFormController extends GetxController {
  final int userId;

  PelanggaranFormController({ required this.userId });

  MainController mainController = Get.find<MainController>();
  ProfileController profileController = Get.find<ProfileController>();
  RxBool loading = false.obs;
  Rx<PesertaModel?> selectedPeserta = Rx<PesertaModel?>(null);
  Rx<KetentuanModel?> selectedKetentuan = Rx<KetentuanModel?>(null);
  RxList<KetentuanModel> ketentuanList = <KetentuanModel>[].obs;
  String description = '';

  submit() async {
    if (selectedKetentuan.value == null) {
      return showToast('Error', 'Harap isi jenis ketentuan terlebih dahulu', type: ToastType.error);
    }

    Map<String, dynamic> data = {
      "title": selectedKetentuan.value!.title,
      "poin": selectedKetentuan.value!.poin,
      "peserta_id": selectedPeserta.value!.id,
      "panitia_id": profileController.userData.value.id,
      "ketentuan_id": selectedKetentuan.value!.id,
    };

    print(data);

    loading.value = true;

    try {
      dio.Response response = await PelanggaranApi.addPelanggaran(data);
      
      print(response);

      loading.value = false;

      final OkCancelResult result = await showOkAlertDialog(
        context: Get.context!,
        title: 'Berhasil!',
        message: 'Berhasil menambahkan data pelanggaran!',
        okLabel: 'Selesai',
        canPop: false,
      );

      if (result == OkCancelResult.ok) {
        Get.back();
      }
    } catch (err) {
      print(err);

      loading.value = false;
      showToast('Terjadi Kesalahan', 'Terjadi kesalahan pada sistem kami', type: ToastType.error);
    }
  }

  @override
  void onInit() async {
    ketentuanList.value = mainController.ketentuanList;
    selectedPeserta.value = await AuthAPI.getUserDetail(userId);

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
