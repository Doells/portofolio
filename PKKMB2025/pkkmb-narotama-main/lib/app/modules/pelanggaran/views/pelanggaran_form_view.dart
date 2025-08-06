import 'package:flutter/material.dart';

import 'package:get/get.dart';
import 'package:pkkmb/app/modules/main/controllers/main_controller.dart';
import 'package:pkkmb/app/modules/pelanggaran/controllers/pelanggaran_form_controller.dart';
import 'package:pkkmb/app/modules/profile/views/profile_view.dart';
import 'package:pkkmb/app/widgets/naro_widgets.dart';
import 'package:pkkmb/app/widgets/option_selector.dart';
import 'package:pkkmb/core/theme/naro_theme.dart';

class PelanggaranFormView extends StatelessWidget {
  final int id;
  const PelanggaranFormView({super.key, required this.id});

  @override
  Widget build(BuildContext context) {
    return GetX<PelanggaranFormController>(
      init: PelanggaranFormController(userId: id),
      builder: (controller) {
        MainController mainController = Get.find<MainController>();

        return Scaffold(
          appBar: AppBar(
            title: const Text('Input Pelanggaran'),
            centerTitle: true,
          ),
          body: SingleChildScrollView(
            padding: const EdgeInsets.all(16),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                NaroCard(
                  outlined: true,
                  shadowed: true,
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      InfoWidget(label: 'Nama', value: controller.selectedPeserta.value?.namaLengkap ?? '-'),
                      InfoWidget(label: 'NIM', value: controller.selectedPeserta.value?.nim ?? '-'),
                      InfoWidget(label: 'Fakultas', value: controller.selectedPeserta.value?.fakultas ?? '-'),
                      InfoWidget(label: 'Prodi', value: controller.selectedPeserta.value?.prodi ?? '-'),
                    ],
                  ),
                ),
                SizedBox(height: 32),
                Text(
                  'Pengisian Pelanggaran',
                  style: NaroTheme.text.subtitle.copyWith(
                    color: NaroTheme.color.darkergrey,
                  ),
                ),
                SizedBox(height: 4),
                Text(
                  'Silahkan isi informasi di bawah untuk pencatatan pelanggaran',
                  style: NaroTheme.text.body2.copyWith(
                    color: NaroTheme.color.darkgrey,
                  ),
                ),
                SizedBox(height: 16),
                Text(
                  'Jenis Pelanggaran',
                  style: NaroTheme.text.body2.copyWith(
                    color: NaroTheme.color.darkgrey,
                    fontWeight: FontWeight.bold
                  ),
                ),
                SizedBox(height: 8),
                GestureDetector(
                  onTap: () => showNaroBottomSheet(
                    type: BottomSheetType.mandatory,
                    context: context,
                    child: Obx(() => OptionSelector(
                      enableSearch: true,
                      onSearch: (keyword) {
                        controller.ketentuanList.value = mainController.ketentuanList
                          .where((e) => e.title.toLowerCase().contains(keyword.toLowerCase())).toList();
                      },
                      options: controller.ketentuanList.map<Option>((data) => Option(
                        onTap: () {
                          controller.selectedKetentuan.value = data;

                          Get.back();
                        },
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            Text(
                              data.title,
                              style: NaroTheme.text.caption,
                            ),
                            SizedBox(height: 4),
                            Text(
                              '-${data.poin} poin',
                              style: NaroTheme.text.caption.copyWith(
                                color: NaroTheme.color.red,
                              ),
                            ),
                          ],
                        ),
                      )).toList(),
                    ))
                  ),
                  child: NaroCard(
                    color: NaroTheme.color.lightgrey,
                    padding: const EdgeInsets.all(14),
                    borderRadius: BorderRadius.circular(4),
                    child: Row(
                      mainAxisAlignment: MainAxisAlignment.spaceBetween,
                      children: [
                        Expanded(
                          child: Text(
                            controller.selectedKetentuan.value == null
                              ? 'Pilih Jenis Pelanggaran' : controller.selectedKetentuan.value!.title,
                            style: NaroTheme.text.body2.copyWith(
                              color: controller.selectedKetentuan.value == null
                                ? NaroTheme.color.grey
                                : NaroTheme.color.darkgrey
                            ),
                            overflow: TextOverflow.ellipsis,
                          ),
                        ),
                        SizedBox(width: 12),
                        controller.selectedKetentuan.value == null
                          ? SizedBox()
                          : Text(
                            '-${controller.selectedKetentuan.value!.poin}',
                            style: NaroTheme.text.caption.copyWith(
                              color: NaroTheme.color.red,
                            ),
                          ),
                      ],
                    ),
                  ),
                ),
                SizedBox(height: 16),
                Text(
                  'Catatan',
                  style: NaroTheme.text.body2.copyWith(
                    color: NaroTheme.color.darkgrey,
                    fontWeight: FontWeight.bold
                  ),
                ),
                SizedBox(height: 8),
                NaroTextField(
                  hintText: 'Catatan...',
                  dense: true,
                  maxLines: 2,
                  onChanged: (value) => controller.description = value,
                ),
                SizedBox(height: 16),
                NaroButton(
                  variant: NaroButtonVariant.elevated,
                  text: 'Kirim',
                  loading: controller.loading.value,
                  height: 48,
                  onPressed: () => controller.submit(),
                ),
              ],
            ),
          )
        );
      }
    );
  }
}
