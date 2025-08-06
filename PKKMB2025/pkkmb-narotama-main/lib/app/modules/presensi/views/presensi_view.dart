import 'package:flutter/material.dart';
import 'package:flutter_remix/flutter_remix.dart';

import 'package:get/get.dart';
import 'package:pkkmb/app/data/models/presensi_model.dart';
import 'package:pkkmb/app/modules/presensi/views/presensi_detail_view.dart';
import 'package:pkkmb/app/widgets/misc/naro_card.dart';
import 'package:pkkmb/core/theme/naro_theme.dart';
import 'package:pkkmb/core/utils/date_format.dart';

import '../controllers/presensi_controller.dart';

class PresensiView extends GetView<PresensiController> {
  const PresensiView({super.key});
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: Text('Presensi Peserta PKKMB'), centerTitle: false),
      body: Obx(() => SafeArea(
        child: controller.loading.value
          ? Center(child: CircularProgressIndicator())
          : RefreshIndicator(
              onRefresh: () async {
                await controller.getPresensiList();
              },
              child: SingleChildScrollView(
                padding: EdgeInsets.all(16),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    ListPresensi(),
                    SizedBox(height: 120),
                  ],
                ),
              ),
            ),
      ))
    );
  }
}

class ListPresensi extends StatelessWidget {
  const ListPresensi({
    super.key,
  });

  @override
  Widget build(BuildContext context) {
    return GetX<PresensiController>(
      init: PresensiController(),
      builder: (controller) {
        return ListView.builder(
          shrinkWrap: true,
          physics: NeverScrollableScrollPhysics(),
          itemCount: controller.presensiList.length,
          itemBuilder: (context, index) {
            PresensiModel presensi = controller.presensiList[index];

            return GestureDetector(
              onTap: () => Get.to(PresensiDetailView(presensi: presensi)),
              child: NaroCard(
                outlined: true,
                margin: const EdgeInsets.only(bottom: 16),
                child: Row(
                  children: [
                    SizedBox(
                      width: 72,
                      child: NaroCard(
                        shadowed: true,
                        color: NaroTheme.color.green,
                        child: Icon(
                          FlutterRemix.account_pin_circle_fill,
                          color: NaroTheme.color.white,
                          size: 40,
                        ),
                      ),
                    ),
                    SizedBox(width: 16),
                    Expanded(
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Text(
                            presensi.title,
                            style: NaroTheme.text.subtitle,
                          ),
                          Text(
                            '${FormatDate.type5.format(presensi.date)} ${presensi.startTime}-${presensi.batasStartTime}',
                            style: NaroTheme.text.body2.copyWith(
                              color: NaroTheme.color.darkgrey,
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

