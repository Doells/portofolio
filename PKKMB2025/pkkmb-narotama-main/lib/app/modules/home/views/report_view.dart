import 'package:flutter/material.dart';
import 'package:flutter_remix/flutter_remix.dart';

import 'package:get/get.dart';
import 'package:pkkmb/app/widgets/naro_widgets.dart';
import 'package:pkkmb/core/theme/naro_theme.dart';

class ReportView extends GetView {
  const ReportView({super.key});
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Report'),
        centerTitle: true,
      ),
      body: SafeArea(
        child: SingleChildScrollView(
          padding: EdgeInsets.all(16),
          child: Column(
            children: [
              Presensi(),
              Tugas(),
              NaroCard(
                outlined: true,
                margin: EdgeInsets.only(bottom: 16),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text(
                      'Pelanggaran',
                      style: NaroTheme.text.title,
                    ),
                    SizedBox(height: 8),
                    ListView.builder(
                      shrinkWrap: true,
                      physics: NeverScrollableScrollPhysics(),
                      itemCount: 3,
                      itemBuilder: (context, index) {
                        return Container(
                          margin: EdgeInsets.only(bottom: 4),
                          child: Row(
                            mainAxisAlignment: MainAxisAlignment.spaceBetween,
                            children: [
                              Text('Tidak Membawa Tugas'),
                              Text(
                                '-15',
                                style: TextStyle(
                                  color: NaroTheme.color.red,
                                ),
                              ),
                            ],
                          ),
                        );
                      },
                    )
                  ],
                ),
              )
            ],
          ),
        ),
      )
    );
  }
}

class Tugas extends StatelessWidget {
  const Tugas({
    super.key,
  });

  @override
  Widget build(BuildContext context) {
    return NaroCard(
      outlined: true,
      margin: EdgeInsets.only(bottom: 16),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Text(
            'Tugas',
            style: NaroTheme.text.title,
          ),
          SizedBox(height: 8),
          ListView.builder(
            shrinkWrap: true,
            physics: NeverScrollableScrollPhysics(),
            itemCount: 3,
            itemBuilder: (context, index) {
              return Container(
                margin: EdgeInsets.only(bottom: 4),
                child: Row(
                  mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  children: [
                    Text('Tugas 1'),
                    Icon(
                      FlutterRemix.checkbox_circle_fill,
                      size: 20,
                      color: NaroTheme.color.green,
                    )
                  ],
                ),
              );
            },
          )
        ],
      ),
    );
  }
}

class Presensi extends StatelessWidget {
  const Presensi({
    super.key,
  });

  @override
  Widget build(BuildContext context) {
    return NaroCard(
      margin: EdgeInsets.only(bottom: 16),
      outlined: true,
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Text(
            'Presensi',
            style: NaroTheme.text.title,
          ),
          SizedBox(height: 8),
          ListView.builder(
            shrinkWrap: true,
            physics: NeverScrollableScrollPhysics(),
            itemCount: 3,
            itemBuilder: (context, index) {
              return Container(
                margin: EdgeInsets.only(bottom: 4),
                child: Row(
                  mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  children: [
                    Text('Hari 1'),
                    Icon(
                      FlutterRemix.checkbox_circle_fill,
                      size: 20,
                      color: NaroTheme.color.green,
                    )
                  ],
                ),
              );
            },
          )
        ],
      ),
    );
  }
}
