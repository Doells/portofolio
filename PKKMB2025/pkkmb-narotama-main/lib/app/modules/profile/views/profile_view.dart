import 'package:adaptive_dialog/adaptive_dialog.dart';
import 'package:flutter/material.dart';

import 'package:get/get.dart';
import 'package:pkkmb/app/modules/main/controllers/main_controller.dart';
import 'package:pkkmb/app/widgets/naro_widgets.dart';
import 'package:pkkmb/core/theme/naro_theme.dart';

import '../controllers/profile_controller.dart';

class ProfileView extends GetView<ProfileController> {
  const ProfileView({super.key});
  @override
  Widget build(BuildContext context) {
    MainController mainController = Get.find<MainController>();
    final kelompok = mainController.kelompokList.firstWhereOrNull((e) => e.id == controller.userData.value.kelompokId);

    return Scaffold(
      appBar: AppBar(title: Text('Profile'), centerTitle: false),
      body: SingleChildScrollView(
        padding: EdgeInsets.fromLTRB(16, 0, 16, 16),
        child: SafeArea(
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Row(
                children: [
                  Expanded(
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Text(
                          controller.userData.value.name,
                          style: NaroTheme.text.title.copyWith(
                            color: NaroTheme.color.primary,
                          ),
                        ),
                        SizedBox(height: 4),
                        Text(
                          kelompok?.name ?? '-',
                          style: NaroTheme.text.body.copyWith(
                            color: NaroTheme.color.darkgrey,
                          ),
                        ),
                      ],
                    ),
                  ),
                ],
              ),
              SizedBox(height: 16),
              Row(
                mainAxisAlignment: MainAxisAlignment.spaceBetween,
                children: [
                  Text(
                    'Data Pribadi',
                    style: NaroTheme.text.body,
                  ),
                  // Text(
                  //   'Ubah',
                  //   style: NaroTheme.text.body.copyWith(
                  //     color: NaroTheme.color.primary,
                  //   ),
                  // ),
                ],
              ),
              SizedBox(height: 16),
              InfoWidget(label: 'NIM', value: controller.userDetail.value?.nim ?? '-'),
              InfoWidget(label: 'Kelas', value: 'Regular ${controller.userDetail.value?.sistemKuliah ?? '-'}'),
              InfoWidget(label: 'Fakultas', value: controller.userDetail.value?.fakultas ?? '-'),
              InfoWidget(label: 'Prodi', value: controller.userDetail.value?.prodi ?? '-'),
              InfoWidget(label: 'Tahun', value: controller.userDetail.value?.tahunAngkatan ?? '-'),
              InfoWidget(label: 'Jenis Kelamin', value: controller.userDetail.value?.jenisKelamin ?? '-'),
              InfoWidget(label: 'Tempat Tanggal Lahir', value: '${controller.userDetail.value?.tempatLahir ?? '-'}, ${controller.userDetail.value?.tglLahir ?? '-'}'),
              InfoWidget(label: 'Alamat Tinggal', value: controller.userDetail.value?.alamat ?? '-'),
              InfoWidget(label: 'Nomor HP', value: controller.userDetail.value?.noHp ?? '-'),
              InfoWidget(label: 'Email', value: controller.userDetail.value?.email ?? '-'),
              SizedBox(height: 16),
              NaroButton(
                variant: NaroButtonVariant.text,
                onPressed: () async {
                  final OkCancelResult result = await showOkCancelAlertDialog(
                    title: 'Logout?',
                    message: 'Kamu yakin untuk keluar dari aplikasi PKKMB?',
                    context: Get.context!,
                    cancelLabel: 'Batal'
                  );

                  if (result == OkCancelResult.ok) {
                    controller.logout();
                  }
                },
                child: Text(
                  'Keluar',
                  style: NaroTheme.text.body.copyWith(
                    color: NaroTheme.color.red
                  ),
                ),
              ),
              SizedBox(height: 200),
            ],
          ),
        ),
      )
    );
  }
}

class InfoWidget extends StatelessWidget {
  final String label;
  final String value;

  const InfoWidget({
    super.key,
    required this.label,
    required this.value,
  });

  @override
  Widget build(BuildContext context) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Text(
          label,
          style: NaroTheme.text.caption.copyWith(
            color: NaroTheme.color.darkgrey,
          ),
        ),
        SizedBox(height: 2),
        Text(
          value,
          style: NaroTheme.text.body2.copyWith(
            color: NaroTheme.color.primary,
          ),
        ),
        SizedBox(height: 8),
      ],
    );
  }
}
