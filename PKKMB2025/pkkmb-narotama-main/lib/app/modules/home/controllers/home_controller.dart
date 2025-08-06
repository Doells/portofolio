import 'package:get/get.dart';
import 'package:pkkmb/app/data/models/news_model.dart';
import 'package:pkkmb/app/data/providers/master_api.dart';

class HomeController extends GetxController {
  RxBool loadingNews = false.obs;
  RxList<NewsModel> informationList = <NewsModel>[
    NewsModel(
      id: 1111,
      title: 'Pedoman PKKMB 2024 Kelas A & B',
      createdAt: DateTime(2024, 9, 4),
      link: 'https://drive.google.com/drive/folders/1SmFTBeBes9sb6WO-QTvF2OkP1oFj6DQ8?usp=drive_link',
    ),
    NewsModel(
      id: 2222,
      title: 'Pedoman PKKMB 2024 Kelas C',
      createdAt: DateTime(2024, 9, 4),
      link: 'https://drive.google.com/drive/folders/1shVDJozkszCn8Xq5lBj3zv8WWcIfKSba',
    ),
    NewsModel(
      id: 3333,
      title: 'Seragam PKKMB 2024',
      createdAt: DateTime(2024, 9, 4),
      link: 'https://drive.google.com/drive/folders/1ctE0IQ4j3ZAQh3TCojALdPpfwSlBS2NP?usp=drive_link'
    ),
  ].obs;

  getNewsList() async {
    loadingNews.value = true;

    try {
      List<NewsModel> data = await MasterApi.getNews();
      
      informationList.addAll(data);
    } catch (e) {
      print('error get news $e');
    }

    loadingNews.value = false;
  }

  @override
  void onInit() {
    super.onInit();

    getNewsList();
  }

  @override
  void onReady() {
    super.onReady();
  }

  @override
  void onClose() {
    super.onClose();
  }
}
