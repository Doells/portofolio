import 'package:dio/dio.dart' as dio;
import 'package:get/get.dart';
import 'package:pkkmb/app/data/models/submission_detail_model.dart';
import 'package:pkkmb/app/data/models/submission_model.dart';
import 'package:pkkmb/app/data/models/tugas_model.dart';
import 'package:pkkmb/app/data/providers/tugas_api.dart';
import 'package:pkkmb/app/widgets/naro_widgets.dart';

class SubmissionDetailController extends GetxController {
  final SubmissionModel submission;
  final TugasModel tugas;

  RxBool loading = false.obs;
  Rx<SubmissionDetailModel?> detail = Rx<SubmissionDetailModel?>(null);

  SubmissionDetailController({
    required this.submission,
    required this.tugas,
  });

  getSubmissionDetail() async {
    try {
      loading.value = true;
      detail.value = await TugasAPI.getSubmissionDetail(submission.id);

      loading.value = false;
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

    getSubmissionDetail();
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