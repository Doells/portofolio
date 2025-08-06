import 'package:flutter/material.dart';
import 'package:flutter_remix/flutter_remix.dart';

import 'package:get/get.dart';
import 'package:pkkmb/app/widgets/naro_widgets.dart';
import 'package:pkkmb/core/theme/naro_theme.dart';

import '../controllers/auth_controller.dart';

class AuthView extends StatelessWidget {
  const AuthView({super.key});
  @override
  Widget build(BuildContext context) {
    return GetX(
      init: AuthController(),
      builder: (controller) {
        return Scaffold(
            body: Stack(
          children: [
            SizedBox(
              width: 900,
              child: Image.asset(
                'assets/images/bg-1-Diedit.png',
                fit: BoxFit.cover,
              ),
            ),
            Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                const SizedBox(height: 48),
                Padding(
                  padding: const EdgeInsets.all(20),
                  child: Text(
                    'PKKMB',
                    style: NaroTheme.text.heading
                        .copyWith(color: NaroTheme.color.white, fontSize: 24),
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
                    padding: const EdgeInsets.symmetric(
                        vertical: 36, horizontal: 20),
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Text(
                          'Selamat Datang! 👋',
                          style: NaroTheme.text.heading.copyWith(fontSize: 22),
                        ),
                        const SizedBox(height: 8),
                        Text('Silakan login terlebih dahulu',
                            style: NaroTheme.text.body
                                .copyWith(color: NaroTheme.color.grey)),
                        const SizedBox(height: 24),
                        NaroTextField(
                          hintText: 'NIM',
                          suffixIcon: Icon(
                            FlutterRemix.user_fill,
                            color: NaroTheme.color.grey,
                          ),
                          dense: true,
                          initialValue: controller.nim.value,
                          onChanged: (data) => controller.nim.value = data,
                        ),
                        const SizedBox(height: 16),
                        NaroTextField(
                          hintText: 'Password',
                          suffixIcon: GestureDetector(
                            onTap: () => controller.showPassword.value =
                                !controller.showPassword.value,
                            child: Icon(
                              controller.showPassword.value
                                  ? FlutterRemix.eye_off_fill
                                  : FlutterRemix.eye_fill,
                              color: NaroTheme.color.grey,
                            ),
                          ),
                          dense: true,
                          obsecure: !controller.showPassword.value,
                          onChanged: (data) => controller.password.value = data,
                        ),
                        const SizedBox(height: 16),
                        Text(
                          controller.errorText.value,
                          style: NaroTheme.text.body2.copyWith(
                            color: NaroTheme.color.red,
                          ),
                        ),
                        const Spacer(),
                        NaroButton(
                          variant: NaroButtonVariant.elevated,
                          text: 'Login',
                          icon: FlutterRemix.arrow_right_line,
                          loading: controller.loading.value,
                          onPressed: () => controller.login(),
                        )
                      ],
                    ),
                  ),
                )
              ],
            )
          ],
        ));
      },
    );
  }
}
