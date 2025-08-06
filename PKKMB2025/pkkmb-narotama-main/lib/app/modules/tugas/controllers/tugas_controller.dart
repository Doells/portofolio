import 'package:get/get.dart';
import 'package:pkkmb/app/data/models/tugas_model.dart';
import 'package:pkkmb/app/data/providers/tugas_api.dart';
import 'package:pkkmb/app/modules/profile/controllers/profile_controller.dart';

class TugasController extends GetxController {
  RxBool loading = false.obs;
  RxList<TugasModel> tugasList = <TugasModel>[].obs;
  final ProfileController _profileController = Get.find<ProfileController>();

  @override
  void onInit() {
    super.onInit();

    getTugasList();
  }

  @override
  void onReady() {
    super.onReady();
  }

  @override
  void onClose() {
    super.onClose();
  }

  getTugasList() async {
    loading.value = true;

    try {
      tugasList.value = await TugasAPI.getTugasList(
        userId: _profileController.userData.value.id,
      );
    } catch (e) {
      print('error get tugas $e');
    }

    loading.value = false;
  }
}
