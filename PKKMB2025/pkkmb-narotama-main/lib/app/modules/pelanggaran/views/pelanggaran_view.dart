import 'dart:convert';

import 'package:easy_debounce/easy_debounce.dart';
import 'package:flutter/material.dart';
import 'package:flutter_remix/flutter_remix.dart';

import 'package:get/get.dart';
import 'package:pkkmb/app/data/models/pelanggaran_user_model.dart';
import 'package:pkkmb/app/modules/main/controllers/main_controller.dart';
import 'package:pkkmb/app/modules/pelanggaran/views/pelanggaran_form_view.dart';
import 'package:pkkmb/app/modules/profile/views/profile_view.dart';
import 'package:pkkmb/app/widgets/naro_widgets.dart';
import 'package:pkkmb/app/widgets/qr_scanner.dart';
import 'package:pkkmb/core/theme/naro_theme.dart';
import 'package:pkkmb/core/utils/date_format.dart';
import 'package:pkkmb/core/utils/encryption.dart';

import '../controllers/pelanggaran_controller.dart';

class PelanggaranView extends StatelessWidget {
  const PelanggaranView({super.key});
  @override
  Widget build(BuildContext context) {
    return GetX(
      init: PelanggaranController(),
      builder: (controller) {
        return Scaffold(
          appBar: AppBar(
            title: const Text('Pelanggaran'),
            centerTitle: false,
            scrolledUnderElevation: 0,
          ),
          floatingActionButton: Padding(
            padding: const EdgeInsets.only(bottom: 72, right: 4),
            child: FloatingActionButton(
              onPressed: () => Get.to(() => QrScanner(
                onScanned: (data) {
                  print('got qr! $data');
                  final String decryptedData = InternalEncryption.decrypt(data);
                  final parsedData = jsonDecode(decryptedData);

                  Get.off(PelanggaranFormView(id: int.parse(parsedData['id'])));
                },
              )),
              child: Icon(FlutterRemix.qr_scan_2_line, color: Colors.white),
            ),
          ),
          body: controller.loading.value ? Center(
            child: CircularProgressIndicator(),
          ) : RefreshIndicator(
            onRefresh: () async {
              await controller.getPelanggaranList();
            },
            child: Stack(
              children: [
                CustomScrollView(
                  slivers: [
                    SliverAppBar(
                      expandedHeight: 72,
                      floating: true,
                      scrolledUnderElevation: 0,
                      flexibleSpace: FlexibleSpaceBar(
                        background: Padding(
                          padding: const EdgeInsets.symmetric(horizontal: 16),
                          child: NaroTextField(
                            hintText: 'Cari...',
                            suffixIcon: Icon(
                              FlutterRemix.search_line,
                              color: NaroTheme.color.grey,
                            ),
                            onChanged: (data) {
                              EasyDebounce.debounce('search-pelanggaran', Duration(milliseconds: 250), () {
                                controller.filteredPelanggaranList.value = controller.pelanggaranList
                                  .where((e) => e.name.toLowerCase().contains(data.toLowerCase()))
                                  .toList();
                              });
                            },
                          ),
                        ),
                      ),
                    ),
                    SliverList(
                      delegate: SliverChildListDelegate([
                        Padding(
                          padding: const EdgeInsets.symmetric(horizontal: 16),
                          child: Column(
                            children: [
                              ItemsTable(),
                              SizedBox(height: MediaQuery.of(context).size.height * 0.3)
                            ],
                          ),
                        )
                      ]),
                    )
                  ],
                ),
              ],
            ),
          ),
        );
      },
    );
  }
}

class ItemsTable extends StatelessWidget {
  const ItemsTable({super.key});

  @override
  Widget build(BuildContext context) {
    MainController mainController = Get.find<MainController>();

    return GetX<PelanggaranController>(
      builder: (controller) {
        return NaroCard(
          padding: EdgeInsets.all(0),
          outlined: true,
          child: SingleChildScrollView(
            scrollDirection: Axis.horizontal,
            child: DataTable(
              showCheckboxColumn: false,
              columnSpacing: 16,
              columns: const <DataColumn>[
                DataColumn(label: Text('No')),
                DataColumn(label: Text('Nama')),
                DataColumn(label: Text('Kelompok')),
                DataColumn(label: Text('Poin')),
              ],
              rows: controller.filteredPelanggaranList.asMap().entries.map((entry) {
                int index = entry.key + 1;
                PelanggaranUserModel item = entry.value;
                final kelompok = mainController.kelompokList.firstWhereOrNull((e) => e.id == item.kelompokId);

                return DataRow(
                  onSelectChanged: (value) {
                    showNaroBottomSheet(
                      context: context,
                      title: 'Detail',
                      child: SingleChildScrollView(
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            Text(item.name, style: NaroTheme.text.title),
                            SizedBox(height: 12),
                            InfoWidget(label: 'NIM', value: item.nim ?? '-'),
                            InfoWidget(label: 'Kelompok', value: kelompok?.name ?? '-'),
                            SizedBox(height: 12),
                            Text('Riwayat Pelanggaran', style: NaroTheme.text.subtitle),
                            SizedBox(height: 16),
                            item.detail.isNotEmpty ? ListView.builder(
                              shrinkWrap: true,
                              physics: NeverScrollableScrollPhysics(),
                              itemCount: item.detail.length,
                              itemBuilder: (context, index) {
                                final detail = item.detail[index];

                                return NaroCard(
                                  margin: EdgeInsets.only(bottom: 8),
                                  padding: EdgeInsets.all(8),
                                  outlined: true,
                                  child: Column(
                                    crossAxisAlignment: CrossAxisAlignment.start,
                                    children: [
                                      Row(
                                        children: [
                                          Expanded(
                                            child: Text(
                                              detail.title,
                                              style: NaroTheme.text.caption,
                                            ),
                                          ),
                                          SizedBox(width: 8),
                                          Text(
                                            '-${detail.poin} poin',
                                            style: NaroTheme.text.caption.copyWith(
                                              color: NaroTheme.color.red,
                                            ),
                                          ),
                                        ],
                                      ),
                                      Text(
                                        FormatDate.type3.format(DateTime.parse(detail.createdAt).toLocal()),
                                        style: NaroTheme.text.caption.copyWith(
                                          color: NaroTheme.color.grey,
                                        ),
                                      ),
                                    ],
                                  ),
                                );
                              }
                            ) : Text('Belum ada riwayat', style: NaroTheme.text.body2.copyWith(
                              color: NaroTheme.color.grey,
                            )),
                          ],
                        ),
                      )
                    );
                  },
                  cells: <DataCell>[
                    DataCell(Text(index.toString())), // Row number cell
                    DataCell(
                      ConstrainedBox(
                        constraints: BoxConstraints(maxWidth: 180),
                        child: Text(item.name, overflow: TextOverflow.ellipsis,)
                      )
                    ),
                    DataCell(Text(kelompok?.name ?? '-')),
                    DataCell(Text(item.totalPoint.toString())),
                  ],
                );
              }).toList(),
            ),
          ),
        );
      }
    );
  }
}
