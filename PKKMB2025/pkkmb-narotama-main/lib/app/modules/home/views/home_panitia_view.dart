import 'package:flutter/material.dart';

import 'package:get/get.dart';
import 'package:pkkmb/app/modules/home/controllers/home_controller.dart';
import 'package:pkkmb/app/modules/home/views/home_view.dart';
import 'package:pkkmb/app/modules/home/views/list_panitia.dart';
import 'package:pkkmb/app/modules/home/views/list_peserta.dart';
import 'package:pkkmb/app/modules/profile/controllers/profile_controller.dart';
import 'package:pkkmb/app/widgets/misc/naro_card.dart';
import 'package:pkkmb/core/theme/naro_theme.dart';

class HomePanitiaView extends GetView<HomeController> {
  const HomePanitiaView({super.key});
  @override
  Widget build(BuildContext context) {
    ProfileController profileController = Get.find<ProfileController>();

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
                      child: ListView(
                        shrinkWrap: true,
                        physics: NeverScrollableScrollPhysics(),
                        children: [
                          QuickMenu(),
                          SizedBox(height: 24),
                          InformationList(),
                        ],
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

class QuickMenu extends StatelessWidget {
  const QuickMenu({
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
      childAspectRatio: (1 / .4),
      children: [
        GestureDetector(
          onTap: () => Get.to(ListPanitia()),
          child: NaroCard(
            padding: EdgeInsets.all(12),
            color: NaroTheme.color.green,
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  'PKKMB 2024',
                  style: NaroTheme.text.caption.copyWith(
                    color: NaroTheme.color.white.withOpacity(0.8),
                  ),
                ),
                Spacer(),
                Text(
                  'Panitia',
                  style: NaroTheme.text.title.copyWith(
                    color: NaroTheme.color.white,
                  ),
                ),
              ],
            ),
          ),
        ),
        GestureDetector(
          onTap: () => Get.to(ListPeserta()),
          child: NaroCard(
            color: NaroTheme.color.green,
            padding: EdgeInsets.all(12),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  'PKKMB 2024',
                  style: NaroTheme.text.caption.copyWith(
                    color: NaroTheme.color.white.withOpacity(0.8),
                  ),
                ),
                Spacer(),
                Text(
                  'Peserta',
                  style: NaroTheme.text.title.copyWith(
                    color: NaroTheme.color.white,
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
