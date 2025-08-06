import 'package:get/get.dart';

import '../controllers/kelulusan_controller.dart';

class KelulusanBinding extends Bindings {
  @override
  void dependencies() {
    Get.lazyPut<KelulusanController>(
      () => KelulusanController(),
    );
  }
}
