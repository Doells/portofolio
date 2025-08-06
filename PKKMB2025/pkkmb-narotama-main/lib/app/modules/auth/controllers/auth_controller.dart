import 'package:get/get.dart';
import 'package:get_storage/get_storage.dart';
import 'package:pkkmb/app/data/providers/auth_api.dart';
import 'package:pkkmb/app/modules/profile/controllers/profile_controller.dart';
import 'package:pkkmb/app/routes/app_pages.dart';
import 'package:pkkmb/app/widgets/naro_widgets.dart';
import 'package:dio/dio.dart' as dio;

class AuthController extends GetxController {
  GetStorage box = GetStorage();
  RxBool isAuthenticated = false.obs;
  RxString nim = ''.obs;
  RxString password = ''.obs;
  RxBool loading = false.obs;
  RxBool showPassword = false.obs;
  RxString errorText = ''.obs;

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

  authenticate() {
    isAuthenticated.value = true;
    ProfileController profileController =
        Get.put(ProfileController(), permanent: true);

    profileController.initUserData();
  }

  login() async {
    errorText.value = '';

    if (nim.isEmpty || password.isEmpty) {
      errorText.value = 'Harap isi NIM dan password terlebih dahulu.';
      return showToast('Invalid', 'Harap isi NIM dan password terlebih dahulu.',
          type: ToastType.error);
    }

    loading.value = true;

    try {
      dio.Response response =
          await AuthAPI.login(nim: nim.value, password: password.value);

      if (response.statusCode == 200) {
        showToast('Berhasil login', 'Selamat datang di PKKMB mobile!',
            type: ToastType.success);

        // --- PERBAIKAN DI DUA BARIS INI ---
        box.write('userData', response.data['data']); // Simpan data user
        box.write(
            'token', response.data['access_token']); // Simpan juga tokennya

        authenticate();

        Get.offAllNamed(Routes.MAIN);
      }
    } catch (e) {
      errorText.value = 'NIM atau password salah';
      showToast('Tidak Valid', 'Silakan cek kembali NIM dan password mu',
          type: ToastType.error);
    }

    loading.value = false;
  }
}
