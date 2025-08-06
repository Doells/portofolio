import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:pkkmb/core/theme/naro_theme.dart';

export 'input/naro_textfield.dart';
export 'input/naro_button.dart';
export 'input/naro_dropdown.dart';
export 'misc/naro_card.dart';
export 'misc/naro_chip.dart';

showToast(
  String title,
  String content, {
  ToastType? type = ToastType.primary,
  SnackPosition? position = SnackPosition.TOP,
}) {
  Color resolveColor() {
    if (type == ToastType.error) return NaroTheme.color.red;
    if (type == ToastType.warn) return NaroTheme.color.yellow;
    if (type == ToastType.success) return NaroTheme.color.green;

    return NaroTheme.color.primary;
  }

  return Get.snackbar(
    title,
    content,
    duration: const Duration(milliseconds: 4000),
    backgroundColor: NaroTheme.color.white,
    colorText: NaroTheme.color.darkergrey,
    padding: const EdgeInsets.symmetric(vertical: 12, horizontal: 14),
    snackPosition: position,
    margin: const EdgeInsets.all(24),
    borderRadius: 4,
    animationDuration: const Duration(milliseconds: 500),
    forwardAnimationCurve: Curves.easeInOutSine,
    reverseAnimationCurve: Curves.easeInOutExpo,
    leftBarIndicatorColor: resolveColor(),
    boxShadows: [
      BoxShadow(
        offset: const Offset(0, 2),
        color: Colors.black.withOpacity(0.1),
        blurRadius: 8,
      ),
    ],
  );
}

enum ToastType {
  success,
  warn,
  error,
  primary,
}

showNaroBottomSheet({
  required BuildContext context,
  String? title,
  BottomSheetType type = BottomSheetType.optional,
  required Widget child,
}) {
  return Get.bottomSheet(
    StatefulBuilder(builder: (context, snapshot) {
      return Container(
        decoration: BoxDecoration(
          borderRadius: const BorderRadius.only(
              topLeft: Radius.circular(8), topRight: Radius.circular(8)),
          color: NaroTheme.color.white,
        ),
        constraints: BoxConstraints(
          maxHeight: MediaQuery.of(context).size.height - 120,
          minHeight: 72,
        ),
        padding: const EdgeInsets.fromLTRB(16, 8, 16, 0),
        child: Column(
          mainAxisSize: MainAxisSize.min,
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Center(
              child: Container(
                height: 4,
                width: 48,
                margin: const EdgeInsets.only(bottom: 8),
                decoration: BoxDecoration(
                  color: NaroTheme.color.grey,
                  borderRadius: BorderRadius.circular(8),
                ),
              ),
            ),
            title != null || type == BottomSheetType.optional
                ? Padding(
                    padding: const EdgeInsets.only(bottom: 12),
                    child: Row(
                      mainAxisAlignment: MainAxisAlignment.spaceBetween,
                      children: [
                        Flexible(
                          child: Text(
                            title ?? '',
                            style: NaroTheme.text.subtitle.copyWith(
                              color: NaroTheme.color.primary,
                            ),
                          ),
                        ),
                        type == BottomSheetType.optional
                            ? GestureDetector(
                                onTap: () => Get.back(),
                                child: Icon(
                                  Icons.close,
                                  size: 24,
                                  color: NaroTheme.color.grey,
                                ),
                              )
                            : const SizedBox(),
                      ],
                    ),
                  )
                : const SizedBox(),
            Flexible(child: child),
            const SizedBox(height: 36),
          ],
        ),
      );
    }),
    enableDrag: true,
    enterBottomSheetDuration: const Duration(milliseconds: 250),
    isScrollControlled: true,
  );
}

enum BottomSheetType {
  optional,
  mandatory,
}
