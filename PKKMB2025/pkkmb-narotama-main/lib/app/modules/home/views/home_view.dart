import 'dart:convert';

import 'package:cached_network_image/cached_network_image.dart';
import 'package:flutter/material.dart';
import 'package:flutter_remix/flutter_remix.dart';

import 'package:get/get.dart';
import 'package:pkkmb/app/data/models/news_model.dart';
import 'package:pkkmb/app/modules/home/views/home_panitia_view.dart';
import 'package:pkkmb/app/modules/home/views/news_detail.dart';
import 'package:pkkmb/app/modules/home/views/report_view.dart';
import 'package:pkkmb/app/modules/profile/controllers/profile_controller.dart';
import 'package:pkkmb/app/widgets/input/naro_button.dart';
import 'package:pkkmb/app/widgets/misc/naro_card.dart';
import 'package:pkkmb/core/theme/naro_theme.dart';
import 'package:pkkmb/core/utils/date_format.dart';
import 'package:pkkmb/core/utils/encryption.dart';
import 'package:pretty_qr_code/pretty_qr_code.dart';
import 'package:url_launcher/url_launcher.dart';

import '../controllers/home_controller.dart';

class HomeView extends GetView<HomeController> {
  const HomeView({super.key});
  @override
  Widget build(BuildContext context) {
    ProfileController profileController = Get.find<ProfileController>();

    showQrCode() {
      final text = {
        "id": profileController.userData.value.id.toString(),
        "expired_date":
            DateTime.now().add(Duration(minutes: 5)).toIso8601String(),
      };
      final encryptedId = InternalEncryption.encrypt(jsonEncode(text));

      showDialog(
          context: context,
          builder: (context) {
            return Dialog(
              backgroundColor: Colors.transparent,
              shape: RoundedRectangleBorder(
                  borderRadius: BorderRadius.circular(8)),
              child: Column(
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  SizedBox(
                    width: MediaQuery.of(context).size.width * 0.8,
                    height: MediaQuery.of(context).size.width * 0.8,
                    child: NaroCard(
                      child: PrettyQrView.data(
                        data: encryptedId,
                      ),
                    ),
                  ),
                  SizedBox(height: 16),
                  NaroButton(
                    variant: NaroButtonVariant.elevated,
                    height: 48,
                    text: 'Tutup',
                    onPressed: () => Get.back(closeOverlays: true),
                  )
                ],
              ),
            );
          });
    }

    return GetX<HomeController>(
        init: HomeController(),
        builder: (controller) {
          return Scaffold(
              body: Stack(
            children: [
              Container(
                height: 200,
                width: MediaQuery.of(context).size.width,
                decoration: BoxDecoration(
                    gradient: LinearGradient(colors: const [
                  Color.fromARGB(255, 147, 42, 245),
                  Color(0xFFAF62F8)
                ])),
              ),
              Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  const SizedBox(height: 48),
                  Padding(
                    padding: const EdgeInsets.all(20),
                    child: Row(
                      mainAxisAlignment: MainAxisAlignment.spaceBetween,
                      children: [
                        Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            Text(
                              'Halo,  ${profileController.userData.value.name}!',
                              style: NaroTheme.text.body.copyWith(
                                color: NaroTheme.color.white,
                                fontWeight: FontWeight.w500,
                              ),
                            ),
                            SizedBox(height: 8),
                            Text(
                              'Semangat terus yaa!',
                              style: NaroTheme.text.body2.copyWith(
                                color: NaroTheme.color.white,
                              ),
                            ),
                          ],
                        ),
                        GestureDetector(
                          onTap: () => showQrCode(),
                          child: Container(
                            padding: EdgeInsets.all(4),
                            decoration: BoxDecoration(
                              color: Colors.white,
                              borderRadius: BorderRadius.circular(4),
                            ),
                            child: Icon(
                              FlutterRemix.qr_code_line,
                              color: NaroTheme.color.primary,
                              size: 40,
                            ),
                          ),
                        ),
                      ],
                    ),
                  ),
                  const SizedBox(height: 16),
                  Expanded(
                    child: Container(
                      decoration: BoxDecoration(
                        borderRadius: const BorderRadius.only(
                            topLeft: Radius.circular(8),
                            topRight: Radius.circular(8)),
                        color: NaroTheme.color.white,
                      ),
                      width: MediaQuery.of(context).size.width,
                      padding: const EdgeInsets.symmetric(horizontal: 16),
                      child: RefreshIndicator(
                        onRefresh: () async {
                          await controller.getNewsList();
                        },
                        child: ListView(
                          shrinkWrap: true,
                          children: [
                            DailyHistory(),
                            SizedBox(height: 16),
                            QuickMenu(),
                            SizedBox(height: 24),
                            InformationList(),
                            SizedBox(height: 200),
                          ],
                        ),
                      ),
                    ),
                  ),
                ],
              )
            ],
          ));
        });
  }
}

class InformationList extends StatelessWidget {
  const InformationList({
    super.key,
  });

  @override
  Widget build(BuildContext context) {
    return GetX<HomeController>(
      init: HomeController(),
      builder: (controller) {
        return controller.loadingNews.value
            ? SizedBox(
                height: 200,
                child: Center(child: CircularProgressIndicator()),
              )
            : ListView.builder(
                shrinkWrap: true,
                physics: NeverScrollableScrollPhysics(),
                itemCount: controller.informationList.length,
                itemBuilder: (context, index) {
                  NewsModel information = controller.informationList[index];

                  return GestureDetector(
                    onTap: () {
                      if (information.link != null) {
                        final Uri url = Uri.parse(information.link!);
                        launchUrl(url);
                      } else {
                        Get.to(() => NewsDetail(news: information));
                      }
                    },
                    child: NaroCard(
                      padding: EdgeInsets.all(12),
                      outlined: true,
                      margin: EdgeInsets.only(bottom: 16),
                      child: Row(
                        mainAxisAlignment: MainAxisAlignment.spaceBetween,
                        crossAxisAlignment: CrossAxisAlignment.center,
                        children: [
                          Expanded(
                            child: Column(
                              crossAxisAlignment: CrossAxisAlignment.start,
                              children: [
                                Text(
                                  information.title ?? '-',
                                  style: NaroTheme.text.subtitle.copyWith(
                                    color: NaroTheme.color.primary,
                                  ),
                                ),
                                SizedBox(height: 16),
                                Text(
                                  information.createdAt != null
                                      ? FormatDate.type4
                                          .format(information.createdAt!)
                                      : '-',
                                  style: NaroTheme.text.caption.copyWith(
                                    color: NaroTheme.color.darkgrey,
                                  ),
                                ),
                              ],
                            ),
                          ),
                          SizedBox(width: 8),
                          information.imageUrl != null
                              ? ClipRRect(
                                  borderRadius: BorderRadius.circular(4),
                                  child: SizedBox(
                                    width: 100,
                                    height: 75,
                                    child: CachedNetworkImage(
                                      imageUrl:
                                          'https://pkkmb.narotama.ac.id/storage/${information.imageUrl}',
                                      progressIndicatorBuilder:
                                          (context, url, downloadProgress) =>
                                              Padding(
                                        padding: const EdgeInsets.all(16),
                                        child: CircularProgressIndicator(
                                            value: downloadProgress.progress),
                                      ),
                                      errorWidget: (context, url, error) =>
                                          Icon(Icons.error),
                                      fit: BoxFit.cover,
                                    ),
                                  ),
                                )
                              : Icon(
                                  FlutterRemix.file_mark_fill,
                                  size: 56,
                                  color: NaroTheme.color.primary,
                                ),
                        ],
                      ),
                    ),
                  );
                });
      },
    );
  }
}

class DailyHistory extends StatelessWidget {
  const DailyHistory({
    super.key,
  });

  @override
  Widget build(BuildContext context) {
    return GridView.count(
      crossAxisCount: 2,
      shrinkWrap: true,
      physics: NeverScrollableScrollPhysics(),
      crossAxisSpacing: 12,
      mainAxisSpacing: 12,
      childAspectRatio: (1 / .5),
      children: [
        GestureDetector(
          onTap: () {
            final Uri url =
                Uri.parse('https://www.instagram.com/reel/Cmsv7Z1IQIW/');
            launchUrl(url);
          },
          child: NaroCard(
            padding: EdgeInsets.all(12),
            color: NaroTheme.color.green,
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  'Video PKKMB',
                  style: NaroTheme.text.caption.copyWith(
                    color: NaroTheme.color.white.withOpacity(0.8),
                  ),
                ),
                Text(
                  '2022',
                  style: NaroTheme.text.title.copyWith(
                    color: NaroTheme.color.white,
                  ),
                ),
                Spacer(),
                Text(
                  'After Movie',
                  style: NaroTheme.text.caption.copyWith(
                    color: NaroTheme.color.white.withOpacity(0.8),
                  ),
                ),
              ],
            ),
          ),
        ),
        GestureDetector(
          onTap: () {
            final Uri url =
                Uri.parse('https://www.instagram.com/reel/CzFbdmUSabk/');
            launchUrl(url);
          },
          child: NaroCard(
            color: NaroTheme.color.green,
            padding: EdgeInsets.all(12),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  'Video PKKMB',
                  style: NaroTheme.text.caption.copyWith(
                    color: NaroTheme.color.white.withOpacity(0.8),
                  ),
                ),
                Text(
                  '2023',
                  style: NaroTheme.text.title.copyWith(
                    color: NaroTheme.color.white,
                  ),
                ),
                Spacer(),
                Text(
                  'After Movie',
                  style: NaroTheme.text.caption.copyWith(
                    color: NaroTheme.color.white.withOpacity(0.8),
                  ),
                ),
              ],
            ),
          ),
        ),
      ],
    );
  }
}

class UserStats extends StatelessWidget {
  const UserStats({
    super.key,
  });

  @override
  Widget build(BuildContext context) {
    return NaroCard(
        outlined: true,
        padding: EdgeInsets.all(12),
        child: Row(
          mainAxisAlignment: MainAxisAlignment.spaceBetween,
          children: [
            SizedBox(width: 0),
            Column(
              children: [
                Text(
                  '80%',
                  style: NaroTheme.text.title,
                ),
                Text(
                  'Tugas',
                  style: NaroTheme.text.caption.copyWith(
                    color: NaroTheme.color.grey,
                  ),
                ),
              ],
            ),
            SizedBox(width: 0),
            Column(
              children: [
                Text(
                  '100',
                  style: NaroTheme.text.title,
                ),
                Text(
                  'Point',
                  style: NaroTheme.text.caption.copyWith(
                    color: NaroTheme.color.grey,
                  ),
                ),
              ],
            ),
            SizedBox(width: 0),
            Column(
              children: [
                Text(
                  '0',
                  style: NaroTheme.text.title,
                ),
                Text(
                  'Pelanggaran',
                  style: NaroTheme.text.caption.copyWith(
                    color: NaroTheme.color.grey,
                  ),
                ),
              ],
            ),
            SizedBox(width: 0),
            SizedBox(
              width: 90,
              child: NaroButton(
                variant: NaroButtonVariant.elevated,
                height: 40,
                onPressed: () => Get.to(ReportView()),
                child: Text(
                  'Report',
                  style: NaroTheme.text.caption.copyWith(
                    color: NaroTheme.color.white,
                  ),
                ),
              ),
            )
          ],
        ));
  }
}
