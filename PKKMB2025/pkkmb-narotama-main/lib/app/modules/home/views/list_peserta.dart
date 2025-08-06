import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:pkkmb/app/data/models/user_model.dart';
import 'package:pkkmb/app/modules/main/controllers/main_controller.dart';
import 'package:pkkmb/app/widgets/naro_widgets.dart';
import 'package:pkkmb/core/theme/naro_theme.dart';

class ListPeserta extends StatelessWidget {
  const ListPeserta({super.key});

  @override
  Widget build(BuildContext context) {
    return GetX<MainController>(
      builder: (controller) {
        var groupedData = <int, List<UserModel>>{};

        for (var person in controller.pesertaList) {
          if (!groupedData.containsKey(person.kelompokId)) {
            groupedData[person.kelompokId] = [];
          }
          groupedData[person.kelompokId]!.add(person);
        }

        var groupedEntries = groupedData.entries.toList();
        List<int> order = [17, 18, 19, 20, 21, 22, 23];
        groupedEntries.sort((a, b) {
          int indexA = order.indexOf(a.key);
          int indexB = order.indexOf(b.key);

          if (indexA == -1) indexA = order.length;
          if (indexB == -1) indexB = order.length;

          return indexA.compareTo(indexB);
        });

        return Scaffold(
          appBar: AppBar(
            title: const Text('Daftar Peserta'),
            centerTitle: true,
          ),
          body: SafeArea(
            child: RefreshIndicator(
              onRefresh: () async {
                await controller.getPesertaList();
              },
              child: SingleChildScrollView(
                padding: EdgeInsets.all(16),
                child: ListView.builder(
                  shrinkWrap: true,
                  physics: NeverScrollableScrollPhysics(),
                  itemCount: groupedEntries.length,
                  itemBuilder: (context, index) {
                    final group = groupedEntries[index];
                    final kelompok = controller.kelompokList.firstWhereOrNull((e) => e.id == group.key);
              
                    return NaroCard(
                      margin: EdgeInsets.only(bottom: 12),
                      outlined: true,
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Text(
                            kelompok?.name ?? 'Kelompok ${group.key}',
                            style: NaroTheme.text.title,
                          ),
                          SizedBox(height: 8),
                          ...group.value.map((e) => Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              Text(
                                e.name,
                              ),
                              SizedBox(height: 4),
                            ],
                          )),
                        ],
                      ),
                    );
                  },
                ),
              ),
            ),
          ),
        );
      }
    );
  }
}