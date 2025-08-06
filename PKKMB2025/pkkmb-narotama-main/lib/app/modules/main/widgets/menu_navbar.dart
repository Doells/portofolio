import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:pkkmb/core/theme/naro_theme.dart';

import '../controllers/main_controller.dart';

class MenuNavbar extends StatelessWidget {
  final String text;
  final IconData icon;
  final int index;
  final Function()? onTap;

  MenuNavbar({
    super.key,
    required this.text,
    required this.icon,
    required this.index,
    this.onTap,
  });

  final controller = Get.find<MainController>();

  @override
  Widget build(BuildContext context) {
    return GestureDetector(
      onTap: () {
        if (onTap == null) {
          controller.jumpToPage(index);
        } else {
          onTap!();
        }
      },
      child: Tooltip(
        margin: const EdgeInsets.only(bottom: 10),
        padding: const EdgeInsets.all(8),
        message: text,
        child: Obx(() => SizedBox(
          height: 58,
          child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            mainAxisSize: MainAxisSize.min,
            children: [
              Icon(
                icon,
                color: controller.currentPage.value == index
                  ? NaroTheme.color.primary
                  : NaroTheme.color.grey,
              ),
              const SizedBox(height: 2),
              Text(
                text,
                style: NaroTheme.text.caption.copyWith(
                  color: controller.currentPage.value == index
                    ? NaroTheme.color.primary
                    : NaroTheme.color.grey,
                ),
              ),
            ],
          ),
        )),
      ),
    );
  }
}
