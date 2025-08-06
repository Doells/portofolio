import 'package:file_selector/file_selector.dart';
import 'package:flutter/material.dart';

import 'package:get/get.dart';
import 'package:pkkmb/app/data/models/tugas_model.dart';
import 'package:pkkmb/app/modules/tugas/controllers/tugas_detail_controller.dart';
import 'package:pkkmb/app/widgets/naro_widgets.dart';
import 'package:pkkmb/core/theme/naro_theme.dart';
import 'package:pkkmb/core/utils/date_format.dart';

class TugasDetailView extends StatelessWidget {
  final TugasModel tugas;

  const TugasDetailView({super.key, required this.tugas});

  @override
  Widget build(BuildContext context) {
    return GetX(
      init: TugasDetailController(tugas: tugas),
      builder: (controller) {
        return Scaffold(
          appBar: AppBar(
            title: const Text('Detail Tugas'),
            centerTitle: true,
          ),
          body: SingleChildScrollView(
            padding: EdgeInsets.all(16),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  tugas.title,
                  style: NaroTheme.text.title.copyWith(
                    color: NaroTheme.color.primary,
                  ),
                ),
                SizedBox(height: 4),
                Text(
                  'Batas Waktu : ${FormatDate.type1.format(tugas.deadline)}',
                  style: NaroTheme.text.body2.copyWith(
                    color: NaroTheme.color.darkgrey,
                  ),
                ),
                SizedBox(height: 16),
                NaroCard(
                  shadowed: true,
                  outlined: true,
                  child: Text(tugas.description),
                ),
                SizedBox(height: 32),
                Text(
                  'Pengumpulan Tugas',
                  style: NaroTheme.text.subtitle.copyWith(
                    color: NaroTheme.color.darkergrey,
                  ),
                ),
                SizedBox(height: 4),
                Text(
                  'Silahkan isi data jawabanmu di bawah ini untuk mengumpulkan tugas.',
                  style: NaroTheme.text.caption.copyWith(
                    color: NaroTheme.color.darkgrey,
                  ),
                ),
                SizedBox(height: 16),
                tugas.inputType.toLowerCase() == 'file' ? SizedBox() : NaroTextField(
                  hintText: 'Catatan...',
                  dense: true,
                  maxLines: 2,
                  onChanged: (data) => controller.description = data,
                ),
                SizedBox(height: 16),
                tugas.inputType.toLowerCase() == 'text' ? SizedBox() : NaroButton(
                  variant: NaroButtonVariant.outlined,
                  text: controller.fileName.value ?? 'Unggah File',
                  height: 48,
                  onPressed: () async {
                    final XFile? file = await openFile();
        
                    print('got file ${file?.name}');
                    controller.fileName.value = file?.name;
                    controller.file = file;
                  },
                ),
                SizedBox(height: 16),
                NaroButton(
                  variant: NaroButtonVariant.elevated,
                  text: 'Kirim Tugas',
                  height: 48,
                  loading: controller.loading.value,
                  onPressed: () => controller.submit(),
                ),
                SizedBox(height: 120),
              ],
            ),
          ),
        );
      }
    );
  }
}
