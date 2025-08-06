import 'package:flutter/material.dart';

import 'package:get/get.dart';
import 'package:pkkmb/app/widgets/input/naro_button.dart';
import 'package:pkkmb/core/theme/naro_theme.dart';
import 'package:pkkmb/core/utils/format.dart';
import 'package:url_launcher/url_launcher.dart';

import '../controllers/kelulusan_controller.dart';

class KelulusanView extends GetView<KelulusanController> {
  const KelulusanView({super.key});
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Center(
        child: Padding(
          padding: const EdgeInsets.symmetric(horizontal: 16),
          child: Column(
            mainAxisSize: MainAxisSize.min,
            children: [
              Text(
                'Pengumuman Kelulusan',
                style: NaroTheme.text.title,
                textAlign: TextAlign.center,
              ),
              SizedBox(height: 12),
              Text(
                'Silahkan akses link di bawah untuk informasi kelulusan',
                style: NaroTheme.text.body2.copyWith(
                  color: NaroTheme.color.grey,
                ),
                textAlign: TextAlign.center,
              ),
              SizedBox(height: 20),
              SizedBox(
                width: 160,
                child: NaroButton(
                  onPressed: () {
                    final Uri url = Uri.parse(ensureHttps('https://drive.google.com/drive/folders/1KaF_dkb7Go1HLZ8EljGs9ghLxS1jTIH8?usp=sharing'));
                    launchUrl(url);
                  },
                  variant: NaroButtonVariant.outlined,
                  height: 40,
                  text: 'Buka Link',
                ),
              )
            ],
          ),
        ),
      ),
    );
  }
}
