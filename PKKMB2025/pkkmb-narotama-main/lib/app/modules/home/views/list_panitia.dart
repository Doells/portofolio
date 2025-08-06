import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:pkkmb/app/data/models/user_model.dart';
import 'package:pkkmb/app/modules/main/controllers/main_controller.dart';
import 'package:pkkmb/app/widgets/naro_widgets.dart';
import 'package:pkkmb/core/theme/naro_theme.dart';

class ListPanitia extends StatelessWidget {
  const ListPanitia({super.key});

  @override
  Widget build(BuildContext context) {
    return GetX<MainController>(
      builder: (controller) {
        var groupedData = <int, List<UserModel>>{};

        for (var person in controller.panitiaList) {
          if (!groupedData.containsKey(person.kelompokId)) {
            groupedData[person.kelompokId] = [];
          }
          groupedData[person.kelompokId]!.add(person);
        }

        var groupedEntries = groupedData.entries.toList();
        List<int> order = [
          14, 15, 8, 9, 11,
          3, 2, 7, 16, 4, 13,
          5, 12, 6, 10, 1,
        ];
        groupedEntries.sort((a, b) {
          int indexA = order.indexOf(a.key);
          int indexB = order.indexOf(b.key);

          if (indexA == -1) indexA = order.length;
          if (indexB == -1) indexB = order.length;

          return indexA.compareTo(indexB);
        });

        return Scaffold(
          appBar: AppBar(
            title: const Text('Daftar Panitia'),
            centerTitle: true,
          ),
          body: SafeArea(
            child: RefreshIndicator(
              onRefresh: () async {
                await controller.getPanitiaList();
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