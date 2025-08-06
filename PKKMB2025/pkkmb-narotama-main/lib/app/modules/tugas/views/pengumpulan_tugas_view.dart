import 'package:flutter/material.dart';

import 'package:get/get.dart';
import 'package:pkkmb/app/data/models/submission_model.dart';
import 'package:pkkmb/app/data/models/tugas_model.dart';
import 'package:pkkmb/app/modules/main/controllers/main_controller.dart';
import 'package:pkkmb/app/modules/tugas/controllers/submission_controller.dart';
import 'package:pkkmb/app/modules/tugas/views/pengumpulan_tugas_detail_view.dart';
import 'package:pkkmb/app/widgets/naro_widgets.dart';
import 'package:pkkmb/core/theme/naro_theme.dart';
import 'package:pkkmb/core/utils/date_format.dart';

class PengumpulanTugasView extends StatelessWidget {
  final TugasModel tugas;

  const PengumpulanTugasView({super.key, required this.tugas});
  @override
  Widget build(BuildContext context) {
    return GetX(
      init: SubmissionController(tugas: tugas),
      builder: (controller) {
        return Scaffold(
          appBar: AppBar(
            title: const Text('Detail Tugas'),
            centerTitle: true,
          ),
          body: controller.loading.value
            ? Center(child: CircularProgressIndicator())
            : RefreshIndicator(
              onRefresh: () async {
                await controller.getSubmissionList();
              },
              child: SingleChildScrollView(
                padding: EdgeInsets.fromLTRB(16, 0, 16, 16),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text(
                      tugas.title,
                      style: NaroTheme.text.title.copyWith(
                        color: NaroTheme.color.primary,
                      ),
                    ),
                    SizedBox(height: 4),
                    Text(
                      'Batas Waktu : ${FormatDate.type1.format(tugas.deadline)}',
                      style: NaroTheme.text.body2.copyWith(
                        color: NaroTheme.color.darkgrey,
                      ),
                    ),
                    SizedBox(height: 32),
                    PengumpulanTugasTable(
                      items: controller.submissionList,
                      tugas: tugas,
                    ),
                    SizedBox(height: MediaQuery.of(context).size.height * 0.6)
                  ],
                ),
              ),
            )
        );
      }
    );
  }
}

class PengumpulanTugasTable extends StatelessWidget {
  final List<SubmissionModel> items;
  final TugasModel tugas;

  const PengumpulanTugasTable({
    super.key,
    required this.items,
    required this.tugas,
  });

  @override
  Widget build(BuildContext context) {
    MainController mainController = Get.find<MainController>();

    return NaroCard(
      padding: EdgeInsets.all(0),
      outlined: true,
      child: SingleChildScrollView(
        scrollDirection: Axis.horizontal,
        child: DataTable(
          showCheckboxColumn: false,
          columns: const <DataColumn>[
            DataColumn(label: Text('No')),
            DataColumn(label: Text('Nama')),
            DataColumn(label: Text('Kelompok')),
            DataColumn(label: Text('Status')),
          ],
          rows: items.asMap().entries.map((entry) {
            int index = entry.key + 1; // Row number
            SubmissionModel item = entry.value;
            final kelompok = mainController.kelompokList.firstWhereOrNull((e) => e.id == item.kelompokId);

            return DataRow(
              onSelectChanged: (value) {
                Get.to(PengumpulanTugasDetailView(
                  tugas: tugas,
                  submission: item,
                ));
              },
              cells: <DataCell>[
                DataCell(Text(index.toString())),
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
                DataCell(Text(item.status ?? '-')),
              ],
            );
          }).toList(),
        ),
      ),
    );
  }
}
