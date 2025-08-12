import 'package:flutter/material.dart';
import 'package:animated_splash_screen/animated_splash_screen.dart';
import 'package:flutter_dotenv/flutter_dotenv.dart';
import 'package:flutter_easyloading/flutter_easyloading.dart';
import 'package:flutter_svg/svg.dart';
import 'package:get/get.dart';
import 'package:get_storage/get_storage.dart';
import 'package:intl/date_symbol_data_local.dart';
import 'package:pkkmb/app/data/services/dio_service.dart';
import 'package:pkkmb/app/modules/auth/controllers/auth_controller.dart';
import 'package:pkkmb/app/modules/auth/views/onboarding_view.dart';
import 'package:pkkmb/app/modules/main/controllers/main_controller.dart';
import 'package:pkkmb/app/modules/main/views/main_view.dart';
import 'package:pkkmb/app/modules/profile/controllers/profile_controller.dart';
import 'package:pkkmb/core/theme/app_theme.dart';
import 'package:pkkmb/core/theme/naro_theme.dart';
import 'package:page_transition/page_transition.dart';
import 'app/routes/app_pages.dart';

Future<void> main() async {
  print("--- APLIKASI MULAI ---");
  WidgetsFlutterBinding.ensureInitialized();

  try {
    print("Mencoba memuat file .env...");
    await dotenv.load(fileName: ".env");
    print("✅ File .env BERHASIL dimuat.");

    // Tes paling penting: cetak isi BASE_URL
    print(
        "Isi BASE_URL dari .env: ${dotenv.env['http://192.168.1.6/nlhotness-pkkmb-un-2024-2a5c1b240200/public/api']}");
  } catch (e) {
    print("🔥 GAGAL memuat file .env: $e");
  }

  print("Inisialisasi DioService...");
  DioService.init();
  print("✅ DioService BERHASIL diinisialisasi.");
  await GetStorage.init();
  DioService.init(); // Dio diinisialisasi setelah .env dimuat
  await initializeDateFormatting('id_ID', null);
  EasyLoading.instance.indicatorType = EasyLoadingIndicatorType.pulse;

  // 2. Jalankan aplikasi SETELAH semua setup selesai
  runApp(const MyApp());
}

// Buat widget baru untuk membungkus aplikasi Anda
class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return GetMaterialApp(
      title: "PKKMB",
      debugShowCheckedModeBanner: false,
      getPages: AppPages.routes,
      theme: apptheme(),
      home: AnimatedSplashScreen.withScreenFunction(
        duration: 1000,
        splash: const SplashScreen(),
        splashIconSize: double.infinity,
        splashTransition: SplashTransition.fadeTransition,
        pageTransitionType: PageTransitionType.fade,
        backgroundColor: NaroTheme.color.white,
        // 3. screenFunction sekarang hanya berisi logika navigasi & inisialisasi controller
        screenFunction: () async {
          AuthController authController =
              Get.put<AuthController>(AuthController(), permanent: true);
          Get.put(ProfileController(), permanent: true);
          Get.put(MainController(), permanent: true);

          GetStorage box = GetStorage();
          final userData = box.read('userData');

          if (userData == null) {
            return OnboardingView();
          } else {
            authController.authenticate();
            return MainView();
          }
        },
      ),
    );
  }
}

// Widget SplashScreen tidak perlu diubah
class SplashScreen extends StatelessWidget {
  const SplashScreen({super.key});

  @override
  Widget build(BuildContext context) {
    // ... isi widget SplashScreen Anda tetap sama ...
    return Material(
      child: Container(
        decoration: BoxDecoration(
          color: NaroTheme.color.primary,
        ),
        width: double.infinity,
        height: double.infinity,
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          crossAxisAlignment: CrossAxisAlignment.center,
          children: [
            const Spacer(),
            Padding(
              padding: const EdgeInsets.only(right: 16),
              child: Image.asset(
                'assets/images/logo-white2.png',
                width: MediaQuery.of(context).size.width * 0.4,
              ),
            ),
            const Spacer(),
            Text(
              'Version 1.0.0',
              style: NaroTheme.text.body.copyWith(
                color: NaroTheme.color.white.withOpacity(0.6),
              ),
            ),
            const SizedBox(height: 28),
          ],
        ),
      ),
    );
  }
}
