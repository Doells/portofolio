import 'package:flutter/material.dart';

import 'package:get/get.dart';
import 'package:pkkmb/app/modules/main/widgets/main_bottom_navbar.dart';

import '../controllers/main_controller.dart';

class MainView extends GetView<MainController> {
  const MainView({super.key});
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Stack(
        children: [
          PageView(
            physics: NeverScrollableScrollPhysics(),
            controller: controller.mainPageController,
            children: controller.mainPageList.map((page) {
              return page.view;
            }).toList(),
          ),
          Align(
            alignment: Alignment.bottomCenter,
            child: MainBottomNavbar(),
          )
        ],
      )
    );
  }
}
