import 'package:cached_network_image/cached_network_image.dart';
import 'package:flutter/material.dart';
import 'package:linkfy_text/linkfy_text.dart';
import 'package:pkkmb/app/data/models/news_model.dart';
import 'package:pkkmb/core/theme/naro_theme.dart';
import 'package:pkkmb/core/utils/format.dart';
import 'package:url_launcher/url_launcher.dart';

class NewsDetail extends StatelessWidget {
  final NewsModel news;

  const NewsDetail({super.key, required this.news});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Detail Berita'),
        centerTitle: true,
      ),
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(16),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            news.imageUrl != null ? Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                ClipRRect(
                  borderRadius: BorderRadius.circular(8),
                  child: CachedNetworkImage(
                    imageUrl: 'https://pkkmb.narotama.ac.id/storage/${news.imageUrl}',
                    progressIndicatorBuilder: (context, url, downloadProgress) => Padding(
                      padding: const EdgeInsets.all(16),
                      child: CircularProgressIndicator(value: downloadProgress.progress),
                    ),
                    errorWidget: (context, url, error) => Icon(Icons.error),
                  ),
                ),
                SizedBox(height: 16),
              ],
            ) : SizedBox(),
            Text(
              news.title ?? '-',
              style: NaroTheme.text.heading.copyWith(
                color: NaroTheme.color.primary,
              ),
            ),
            Divider(height: 32),
            LinkifyText(
              news.description ?? '',
              linkStyle: TextStyle(color: NaroTheme.color.primary),
              onTap: (link) async {
                print(link.value);
                if (link.value != null) {
                  final Uri url = Uri.parse(ensureHttps(link.value!));
            
                  try {
                    await launchUrl(url, mode: LaunchMode.inAppBrowserView);
                  } catch (err) {
                    print(err);
                  }
                }
              },
            ),
            SizedBox(height: 200),
          ],
        ),
      ),
    );
  }
}