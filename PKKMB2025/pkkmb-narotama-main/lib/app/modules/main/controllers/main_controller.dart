import 'package:flutter/widgets.dart';
import 'package:flutter_remix/flutter_remix.dart';
import 'package:get/get.dart';
import 'package:pkkmb/app/data/models/ketentuan_model.dart';
import 'package:pkkmb/app/data/models/master_model.dart';
import 'package:pkkmb/app/data/models/user_model.dart';
import 'package:pkkmb/app/data/providers/master_api.dart';
import 'package:pkkmb/app/modules/home/bindings/home_binding.dart';
import 'package:pkkmb/app/modules/home/views/home_view.dart';
import 'package:pkkmb/app/modules/home/views/home_panitia_view.dart';
import 'package:pkkmb/app/modules/kelulusan/bindings/kelulusan_binding.dart';
import 'package:pkkmb/app/modules/kelulusan/views/kelulusan_view.dart';
import 'package:pkkmb/app/modules/pelanggaran/bindings/pelanggaran_binding.dart';
import 'package:pkkmb/app/modules/pelanggaran/views/pelanggaran_view.dart';
import 'package:pkkmb/app/modules/presensi/bindings/presensi_binding.dart';
import 'package:pkkmb/app/modules/presensi/views/presensi_view.dart';
import 'package:pkkmb/app/modules/profile/bindings/profile_binding.dart';
import 'package:pkkmb/app/modules/profile/controllers/profile_controller.dart';
import 'package:pkkmb/app/modules/profile/views/profile_view.dart';
import 'package:pkkmb/app/modules/tugas/bindings/tugas_binding.dart';
import 'package:pkkmb/app/modules/tugas/views/tugas_panitia_view.dart';
import 'package:pkkmb/app/modules/tugas/views/tugas_view.dart';
import 'package:pkkmb/app/routes/app_pages.dart';

class MainController extends GetxController {
  RxInt currentPage = 0.obs;
  PageController mainPageController = PageController();
  RxList<MainPageModel> mainPageList = <MainPageModel>[].obs;
  final ProfileController _profileController = Get.find<ProfileController>();
  RxBool loadingQr = false.obs;

  // master data
  RxList<MasterModel> kelompokList = <MasterModel>[].obs;
  RxList<MasterModel> jenisKetentuan = <MasterModel>[].obs;
  RxList<KetentuanModel> ketentuanList = <KetentuanModel>[].obs;
  RxList<UserModel> panitiaList = <UserModel>[].obs;
  RxList<UserModel> pesertaList = <UserModel>[].obs;

  initMainPage() {
    currentPage.value = 0;

    if (_profileController.userData.value.roleId == 3) {
      mainPageList.value = pesertaPageList;
    } else {
      mainPageList.value = panitiaPageList;
    }
  }

  RxList<MainPageModel> pesertaPageList = <MainPageModel>[
    MainPageModel(
      text: 'Beranda',
      index: 0,
      icon: FlutterRemix.home_4_fill,
      view: HomeView(),
      route: Routes.HOME,
      dependencies: () => HomeBinding().dependencies(),
    ),
    MainPageModel(
      text: 'Kelulusan',
      index: 1,
      icon: FlutterRemix.shield_check_fill,
      view: KelulusanView(),
      route: Routes.KELULUSAN,
      dependencies: () => KelulusanBinding().dependencies(),
    ),
    MainPageModel(
      text: 'Tugas',
      index: 2,
      icon: FlutterRemix.book_open_fill,
      view: TugasView(),
      route: Routes.TUGAS,
      dependencies: () => TugasBinding().dependencies(),
    ),
    MainPageModel(
      text: 'Profile',
      index: 3,
      icon: FlutterRemix.account_circle_fill,
      view: ProfileView(),
      route: Routes.PROFILE,
      dependencies: () => ProfileBinding().dependencies(),
    ),
  ].obs;

  RxList<MainPageModel> panitiaPageList = <MainPageModel>[
    MainPageModel(
      text: 'Beranda',
      index: 0,
      icon: FlutterRemix.home_4_fill,
      view: HomePanitiaView(),
      route: Routes.HOME_PANITIA,
      dependencies: () => HomeBinding().dependencies(),
    ),
    MainPageModel(
      text: 'Presensi',
      index: 1,
      icon: FlutterRemix.file_user_fill,
      view: PresensiView(),
      route: Routes.PRESENSI,
      dependencies: () => PresensiBinding().dependencies(),
    ),
    MainPageModel(
      text: 'Tugas',
      index: 2,
      icon: FlutterRemix.book_open_fill,
      view: TugasPanitiaView(),
      route: Routes.TUGAS,
      dependencies: () => TugasBinding().dependencies(),
    ),
    MainPageModel(
      text: 'Pelanggaran',
      index: 3,
      icon: FlutterRemix.alarm_warning_fill,
      view: PelanggaranView(),
      route: Routes.PELANGGARAN,
      dependencies: () => PelanggaranBinding().dependencies(),
    ),
    MainPageModel(
      text: 'Profile',
      index: 4,
      icon: FlutterRemix.account_circle_fill,
      view: ProfileView(),
      route: Routes.PROFILE,
      dependencies: () => ProfileBinding().dependencies(),
    ),
  ].obs;

  jumpToPage(index) {
    mainPageList[index].dependencies();
    mainPageController.jumpToPage(index);
    currentPage.value = index;
  }

  getKelompokList() async {
    try {
      kelompokList.value = await MasterApi.getKelompok();
    } catch (e) {
      print('error get kelompok $e');
    }
  }

  getJenisKetentuanList() async {
    try {
      jenisKetentuan.value = await MasterApi.getJenisKetentuan();
    } catch (e) {
      print('error get jenis ketentuan $e');
    }
  }

  getKetentuanList() async {
    try {
      ketentuanList.value = await MasterApi.getKetentuan();
    } catch (e) {
      print('error get ketentuan $e');
    }
  }

  getPesertaList() async {
    pesertaList.value = [];

    try {
      pesertaList.value = await MasterApi.getListPeserta();
    } catch (e) {
      print('error get peserta $e');
    }
  }

  getPanitiaList() async {
    panitiaList.value = [];

    try {
      panitiaList.value = await MasterApi.getListPanitia();
    } catch (e) {
      print('error get panitia $e');
    }
  }

  @override
  void onInit() {
    super.onInit();

    getKelompokList();
    getJenisKetentuanList();
    getKetentuanList();
    getPesertaList();
    getPanitiaList();
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

class MainPageModel {
  String text;
  int index;
  IconData icon;
  Widget view;
  Function dependencies;
  String route;

  MainPageModel({
    required this.text,
    required this.index,
    required this.icon,
    required this.view,
    required this.dependencies,
    required this.route,
  });
}
