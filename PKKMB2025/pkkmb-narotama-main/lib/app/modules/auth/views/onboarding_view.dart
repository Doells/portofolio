import 'package:flutter/material.dart';
import 'package:flutter_svg/svg.dart';

import 'package:get/get.dart';
import 'package:introduction_screen/introduction_screen.dart';
import 'package:pkkmb/app/routes/app_pages.dart';
import 'package:pkkmb/core/theme/naro_theme.dart';

class OnboardingView extends GetView {
  OnboardingView({super.key});

  final List<PageViewModel> list = [
    PageViewModel(
      title: 'Halo! Selamat datang di Naro APK',
      body: 'Kami sangat senang Anda bergabung!',
      image: Center(
        child: Image.asset(
          'assets/images/onboarding1.png',
          fit: BoxFit.cover,
          width: 200,
        ),
      ),
      decoration: PageDecoration(
        bodyAlignment: Alignment.center,
        imageFlex: 3,
      ),
    ),
    PageViewModel(
      title: 'Semangat memulai PKKMB',
      body: 'Kami di sini untuk membantu Anda mencapai tujuan Anda.',
      image: Center(
        child: Image.asset(
          'assets/images/onboarding2.png',
          fit: BoxFit.cover,
          width: 200,
        ),
      ),
      decoration: PageDecoration(
        bodyAlignment: Alignment.center,
        imageFlex: 3,
      ),
    ),
    PageViewModel(
      title: 'Ingat Tugas anda!',
      body:
          'Jika ada yang membingungkan, jangan ragu untuk menghubungi naradamping kapan saja.',
      image: Center(
        child: Image.asset(
          'assets/images/onboarding3.png',
          fit: BoxFit.cover,
          width: 200,
        ),
      ),
      decoration: PageDecoration(
        bodyAlignment: Alignment.center,
        imageFlex: 3,
      ),
    ),
  ];

  @override
  Widget build(BuildContext context) {
    return Scaffold(
        body: SafeArea(
      child: IntroductionScreen(
        pages: list,
        showSkipButton: true,
        onDone: () => Get.toNamed(Routes.AUTH),
        onSkip: () => Get.toNamed(Routes.AUTH),
        skip: Text(
          'Lewati',
          style: NaroTheme.text.caption.copyWith(
            color: NaroTheme.color.grey,
            fontSize: 14,
          ),
        ),
        next: Text(
          'Selanjutnya',
          style: NaroTheme.text.caption.copyWith(
            fontSize: 14,
          ),
        ),
        done: Text(
          'Mulai',
          style: NaroTheme.text.caption.copyWith(
            color: NaroTheme.color.primary,
            fontSize: 14,
          ),
        ),
        globalBackgroundColor: NaroTheme.color.white,
        dotsDecorator: DotsDecorator(
          size: const Size(8, 8),
          color: NaroTheme.color.grey,
          activeColor: NaroTheme.color.primary,
          activeSize: const Size(16, 8),
          spacing: const EdgeInsets.all(4),
          activeShape: const RoundedRectangleBorder(
            borderRadius: BorderRadius.all(Radius.circular(25.0)),
          ),
        ),
        dotsFlex: 1,
      ),
    ));
  }
}
