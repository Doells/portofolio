import 'package:get/get.dart';
import 'package:pkkmb/app/data/models/submission_model.dart';
import 'package:pkkmb/app/data/models/tugas_model.dart';
import 'package:pkkmb/app/data/providers/tugas_api.dart';

class SubmissionController extends GetxController {
  final TugasModel tugas;
  RxBool loading = false.obs;
  RxList<SubmissionModel> submissionList = <SubmissionModel>[].obs;

  SubmissionController({ required this.tugas });

  getSubmissionList() async {
    loading.value = true;

    try {
      submissionList.value = await TugasAPI.getSubmission(tugas.id);
    } catch (e) {
      print('error get tugas $e');
    }

    loading.value = false;
  }

  @override
  void onInit() {
    super.onInit();

    getSubmissionList();
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