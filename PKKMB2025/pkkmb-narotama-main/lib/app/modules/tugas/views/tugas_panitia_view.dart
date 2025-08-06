import 'package:flutter/material.dart';
import 'package:flutter_remix/flutter_remix.dart';

import 'package:get/get.dart';
import 'package:pkkmb/app/data/models/tugas_model.dart';
import 'package:pkkmb/app/modules/tugas/views/pengumpulan_tugas_view.dart';
import 'package:pkkmb/app/widgets/misc/naro_card.dart';
import 'package:pkkmb/core/theme/naro_theme.dart';
import 'package:pkkmb/core/utils/date_format.dart';

import '../controllers/tugas_controller.dart';

class TugasPanitiaView extends GetView<TugasController> {
  const TugasPanitiaView({super.key});
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: Text('Tugas Peserta PKKMB'), centerTitle: false),
      body: Obx(() => SafeArea(
        child: controller.loading.value 
          ? Center(child: CircularProgressIndicator())
          : RefreshIndicator(
            onRefresh: () async {
              await controller.getTugasList();
            },
            child: SingleChildScrollView(
              padding: EdgeInsets.all(16),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  ListTugas(),
                  SizedBox(height: 600),
                ],
              ),
            ),
          ),
      ))
    );
  }
}

class ListTugas extends StatelessWidget {
  const ListTugas({
    super.key,
  });

  @override
  Widget build(BuildContext context) {
    return GetX<TugasController>(
      builder: (controller) {
        return ListView.builder(
          shrinkWrap: true,
          physics: NeverScrollableScrollPhysics(),
          itemCount: controller.tugasList.length,
          itemBuilder: (context, index) {
            TugasModel tugas = controller.tugasList[index];

            return GestureDetector(
              onTap: () => Get.to(PengumpulanTugasView(tugas: tugas)),
              child: NaroCard(
                color: NaroTheme.color.yellow,
                margin: const EdgeInsets.only(bottom: 16),
                child: Row(
                  children: [
                    Icon(
                      FlutterRemix.book_2_line,
                      color: NaroTheme.color.white,
                      size: 40,
                    ),
                    SizedBox(width: 16),
                    Expanded(
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Text(
                            'Tugas ${index + 1}',
                            style: NaroTheme.text.caption.copyWith(
                              color: NaroTheme.color.white.withOpacity(0.8),
                            ),
                          ),
                          SizedBox(height: 4),
                          Text(
                            tugas.title,
                            style: NaroTheme.text.body.copyWith(
                              color: NaroTheme.color.white,
                            ),
                          ),
                          SizedBox(height: 4),
                          Text(
                            'Batas Waktu : ${FormatDate.type1.format(tugas.deadline)}',
                            style: NaroTheme.text.caption.copyWith(
                              color: NaroTheme.color.white,
                            ),
                          ),
                        ],
                      ),
                    )
                  ],
                ),
              ),
            );
          }
        );
      }
    );
  }
}
