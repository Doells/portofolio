import 'package:get/get.dart';
import 'package:get_storage/get_storage.dart';
import 'package:pkkmb/app/data/models/peserta_model.dart';
import 'package:pkkmb/app/data/models/user_model.dart';
import 'package:pkkmb/app/data/providers/auth_api.dart';
import 'package:pkkmb/app/modules/main/controllers/main_controller.dart';
import 'package:pkkmb/app/routes/app_pages.dart';

class ProfileController extends GetxController {
  Rx<UserModel> userData = UserModel(
    id: 0,
    name: "",
    nim: "",
    positionId: 3,
    roleId: 3,
    kelompokId: 1,
  ).obs;
  Rx<PesertaModel?> userDetail = Rx<PesertaModel?>(null);
  GetStorage box = GetStorage();

  initUserData() async {
    print(box.read('userData'));

    userData.value = UserModel.fromJson(box.read('userData'));
    MainController mainController = Get.find<MainController>();
    mainController.initMainPage();

    userDetail.value = await AuthAPI.getUserDetail(userData.value.id);
  }

  logout() {
    userData.value = UserModel(
      id: 0,
      name: "",
      nim: "",
      positionId: 3,
      roleId: 3,
      kelompokId: 1,
    );
    userDetail.value = null;

    box.erase();
    Get.offAllNamed(Routes.AUTH);
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
