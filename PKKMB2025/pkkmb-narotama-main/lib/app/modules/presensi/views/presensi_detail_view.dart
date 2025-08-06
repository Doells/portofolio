// ignore_for_file: use_build_context_synchronously

import 'dart:convert';

import 'package:adaptive_dialog/adaptive_dialog.dart';
import 'package:dio/dio.dart';
import 'package:flutter/material.dart';
import 'package:flutter_remix/flutter_remix.dart';

import 'package:get/get.dart';
import 'package:pkkmb/app/data/models/attendance_model.dart';
import 'package:pkkmb/app/data/models/presensi_model.dart';
import 'package:pkkmb/app/modules/main/controllers/main_controller.dart';
import 'package:pkkmb/app/modules/presensi/controllers/presensi_detail_controller.dart';
import 'package:pkkmb/app/widgets/naro_widgets.dart';
import 'package:pkkmb/app/widgets/qr_scanner.dart';
import 'package:pkkmb/core/theme/naro_theme.dart';
import 'package:pkkmb/core/utils/date_format.dart';
import 'package:pkkmb/core/utils/encryption.dart';
import 'package:pkkmb/core/utils/validations.dart';

class PresensiDetailView extends StatelessWidget {
  final PresensiModel presensi;

  const PresensiDetailView({super.key, required this.presensi});

  @override
  Widget build(BuildContext context) {
    MainController mainController = Get.find<MainController>();

    return GetX(
      init: PresensiDetailController(presensi: presensi),
      builder: (controller) {
        return Scaffold(
          appBar: AppBar(
            title: const Text('Presensi'),
            centerTitle: true,
          ),
          floatingActionButton: Padding(
            padding: const EdgeInsets.only(bottom: 8, right: 4),
            child: FloatingActionButton(
              onPressed: () => Get.to(() => QrScanner(
                onScanned: (data) async {
                  MainController mainController = Get.find<MainController>();
                  final String decryptedData = InternalEncryption.decrypt(data);
                  final parsedData = jsonDecode(decryptedData);
                  final isQrExpired = Validation.isExpired(DateTime.parse(parsedData["expired_date"]));
        
                  print(parsedData);
                  mainController.loadingQr.value = true;
        
                  if (isQrExpired) {
                    final OkCancelResult result = await showOkCancelAlertDialog(
                      context: context,
                      title: 'Terjadi Kesalahan',
                      message: 'Kode QR sudah kadaluarsa, harap generate QR kembali.',
                      okLabel: 'Kembali',
                      cancelLabel: 'Coba Lagi',
                      canPop: false,
                    );
        
                    mainController.loadingQr.value = false;
        
                    if (result == OkCancelResult.ok) {
                      Get.back();
                    }
                  }
        
                  try {
                    final String code = '${parsedData["id"]}-${presensi.code}';
                    print(code);
                    await controller.addPresensi(code);
        
                    final OkCancelResult result = await showOkCancelAlertDialog(
                      context: context,
                      title: 'Berhasil!',
                      message: 'Berhasil menambahkan presensi!',
                      okLabel: 'Selesai',
                      cancelLabel: 'Scan Lagi',
                      canPop: false,
                    );
        
                    mainController.loadingQr.value = false;
        
                    if (result == OkCancelResult.ok) {
                      Get.back();
                    }
                  } on DioException catch (e) {
                    print(e.response?.data);
                    String message = e.response?.data?['message'] ?? 'Terjadi kesalahan saat menginputkan data presensi';
        
                    final OkCancelResult result = await showOkCancelAlertDialog(
                      context: context,
                      title: 'Terjadi Kesalahan',
                      message: message,
                      okLabel: 'Kembali',
                      cancelLabel: 'Coba Lagi',
                      canPop: false,
                    );
        
                    mainController.loadingQr.value = false;
        
                    if (result == OkCancelResult.ok) {
                      Get.back();
                    }
                  }
                },
              )),
              child: Icon(FlutterRemix.qr_scan_2_line, color: Colors.white),
            ),
          ),
          body: controller.loading.value
            ? Center(child: CircularProgressIndicator())
            : RefreshIndicator(
              onRefresh: () async {
                await controller.getAttendanceList();
              },
              child: SingleChildScrollView(
                padding: const EdgeInsets.all(16),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text(
                      presensi.title,
                      style: NaroTheme.text.title.copyWith(
                        color: NaroTheme.color.primary,
                      ),
                    ),
                    SizedBox(height: 8),
                    Text(
                      'Waktu',
                      style: NaroTheme.text.body2.copyWith(
                        color: NaroTheme.color.grey,
                      ),
                    ),
                    Text(
                      '${FormatDate.type5.format(presensi.date)} ${presensi.startTime}-${presensi.batasStartTime}',
                      style: NaroTheme.text.body2.copyWith(
                        color: NaroTheme.color.darkgrey,
                      ),
                    ),
                    SizedBox(height: 32),
                    NaroCard(
                      padding: EdgeInsets.all(0),
                      outlined: true,
                      child: SingleChildScrollView(
                        scrollDirection: Axis.horizontal,
                        child: DataTable(
                          columns: const <DataColumn>[
                            DataColumn(label: Text('No')),
                            DataColumn(label: Text('Nama')),
                            DataColumn(label: Text('Kelompok')),
                            DataColumn(label: Text('Waktu')),
                            DataColumn(label: Text('Deskripsi')),
                          ],
                          rows: controller.attendanceList.asMap().entries.map((entry) {
                            int index = entry.key + 1; // Row number
                            AttendanceModel item = entry.value;
                            final kelompok = mainController.kelompokList.firstWhereOrNull((e) => e.id == item.kelompokId);
              
                            return DataRow(
                              cells: <DataCell>[
                                DataCell(Text(index.toString())), // Row number cell
                                DataCell(
                                  ConstrainedBox(
                                    constraints: BoxConstraints(maxWidth: 180),
                                    child: Text(item.userName, overflow: TextOverflow.ellipsis,)
                                  )
                                ),
                                DataCell(
                                  ConstrainedBox(
                                    constraints: BoxConstraints(maxWidth: 180),
                                    child: Text(kelompok?.name ?? '-', overflow: TextOverflow.ellipsis,)
                                  )
                                ),
                                DataCell(Text(FormatDate.type3.format(DateTime.parse(item.createdAt).toLocal()))),
                                DataCell(Text(item.permissionReason ?? 'Tepat Waktu')),
                              ],
                            );
                          }).toList(),
                        ),
                      ),
                    ),
                    SizedBox(height: MediaQuery.of(context).size.height * 0.3)
                  ],
                ),
              ),
            )
        );
      }
    );
  }
}
