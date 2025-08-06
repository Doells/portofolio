import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:pkkmb/core/theme/naro_theme.dart';

import '../controllers/main_controller.dart';
import 'menu_navbar.dart';

class MainBottomNavbar extends GetView<MainController> {
  const MainBottomNavbar({super.key});

  @override
  Widget build(BuildContext context) {
    return Container(
      width: double.infinity,
      padding: EdgeInsets.all(4),
      decoration: BoxDecoration(
        color: NaroTheme.color.white,
        border: Border(top: BorderSide(color: NaroTheme.color.grey.withOpacity(0.5)))
      ),
      child: Obx(() => Row(
        mainAxisAlignment: MainAxisAlignment.spaceAround,
        children: [
          ...controller.mainPageList
              .map((element) => MenuNavbar(
                  text: element.text,
                  icon: element.icon,
                  index: element.index))
        ],
      )),
    );
  }
}
