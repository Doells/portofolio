import 'package:flutter/material.dart';
import 'package:flutter_remix/flutter_remix.dart';

import 'package:get/get.dart';
import 'package:linkfy_text/linkfy_text.dart';
import 'package:pkkmb/app/data/models/submission_detail_model.dart';
import 'package:pkkmb/app/data/models/submission_model.dart';
import 'package:pkkmb/app/data/models/tugas_model.dart';
import 'package:pkkmb/app/modules/main/controllers/main_controller.dart';
import 'package:pkkmb/app/modules/profile/views/profile_view.dart';
import 'package:pkkmb/app/modules/tugas/controllers/submission_detail_controller.dart';
import 'package:pkkmb/app/widgets/input/naro_button.dart';
import 'package:pkkmb/app/widgets/misc/naro_card.dart';
import 'package:pkkmb/core/theme/naro_theme.dart';
import 'package:pkkmb/core/utils/date_format.dart';
import 'package:pkkmb/core/utils/format.dart';
import 'package:url_launcher/url_launcher.dart';

class PengumpulanTugasDetailView extends StatelessWidget {
  final TugasModel tugas;
  final SubmissionModel submission;

  const PengumpulanTugasDetailView({
    super.key,
    required this.tugas,
    required this.submission,
  });

  @override
  Widget build(BuildContext context) {
    final MainController mainController = Get.find<MainController>();
    final kelompok = mainController.kelompokList.firstWhereOrNull((e) => e.id == submission.kelompokId);

    return GetX(
      init: SubmissionDetailController(submission: submission, tugas: tugas),
      builder: (controller) {
        final SubmissionDetailModel? detail = controller.detail.value;

        return Scaffold(
          appBar: AppBar(
            title: const Text('Detail Tugas'),
            centerTitle: true,
          ),
          body: RefreshIndicator(
            onRefresh: () async {
              await controller.getSubmissionDetail();
            },
            child: controller.loading.value
              ? Center(child: CircularProgressIndicator())
              : SingleChildScrollView(
                padding: EdgeInsets.fromLTRB(16, 0, 16, 16),
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
                    SizedBox(height: 24),
                    NaroCard(
                      outlined: true,
                      shadowed: true,
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          InfoWidget(label: 'Nama', value: submission.userName),
                          InfoWidget(label: 'Kelompok', value: kelompok?.name ?? '-'),
                          InfoWidget(label: 'Waktu Pengumpulan', value: FormatDate.type1.format(DateTime.parse(submission.createdAt).toLocal())),
                          detail != null && detail.text.isNotEmpty ? Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              Divider(height: 36),
                              Text(
                                'Teks',
                                style: NaroTheme.text.body2.copyWith(
                                  color: NaroTheme.color.darkgrey,
                                  fontWeight: FontWeight.bold,
                                ),
                              ),
                              SizedBox(height: 2),
                              LinkifyText(
                                detail.text,
                                linkStyle: TextStyle(color: NaroTheme.color.primary),
                                onTap: (link) async {
                                  print(link.value);
                                  if (link.value != null) {
                                    final Uri url = Uri.parse(ensureHttps(link.value!));
                              
                                    try {
                                      await launchUrl(url, mode: LaunchMode.inAppBrowserView);
                                    } catch (err) {
                                      print(err);
                                    }
                                  }
                                },
                              ),
                            ],
                          ) : SizedBox(),
                           detail != null && detail.files!.isNotEmpty ? Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              Divider(height: 36),
                              Text(
                                'File Tugas',
                                style: NaroTheme.text.body2.copyWith(
                                  color: NaroTheme.color.darkgrey,
                                  fontWeight: FontWeight.bold,
                                ),
                              ),
                              SizedBox(height: 8),
                              NaroButton(
                                variant: NaroButtonVariant.elevated,
                                text: detail.files!.first.fileName,
                                height: 52,
                                icon: FlutterRemix.file_fill,
                                onPressed: () {
                                  final Uri url = Uri.parse('https://pkkmb.narotama.ac.id/storage/${detail.files!.first.filePath}');
                                  launchUrl(url);
                                },
                              ),
                            ],
                          ) : SizedBox(),
                        ],
                      ),
                    ),
                    SizedBox(height: MediaQuery.of(context).size.height * 0.6)
                  ],
                ),
              ),
          ),
        );
      }
    );
  }
}
