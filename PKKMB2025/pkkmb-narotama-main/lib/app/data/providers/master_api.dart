import 'package:dio/dio.dart';
import 'package:pkkmb/app/data/models/ketentuan_model.dart';
import 'package:pkkmb/app/data/models/master_model.dart';
import 'package:pkkmb/app/data/models/news_model.dart';
import 'package:pkkmb/app/data/models/user_model.dart';
import 'package:pkkmb/app/data/services/dio_service.dart';

class MasterApi {
  static Future<List<MasterModel>> getKelompok() async {
    List<MasterModel> list = [];

    try {
      Response response = await DioService.get('/dashboard/admin/kelompok');

      print('/dashboard/admin/kelompok ${response.data['data']}');

      if (response.data['data'] != null) {
        list = response.data['data']
          .map<MasterModel>((e) => MasterModel.fromJson(e))
          .toList();
      }
    } on DioException catch (e) {
      throw Exception(e);
    }

    return list;
  }

  static Future<List<MasterModel>> getJenisKetentuan() async {
    List<MasterModel> list = [];

    try {
      Response response = await DioService.get('/dashboard/admin/jenis-ketentuan');

      print('/dashboard/admin/jenisketentuan ${response.data['data']}');

      if (response.data['data'] != null) {
        list = response.data['data']
          .map<MasterModel>((e) => MasterModel.fromJson({
            "id": e['id'],
            "name": e['title'],
          }))
          .toList();
      }
    } on DioException catch (e) {
      throw Exception(e);
    }

    return list;
  }

  static Future<List<KetentuanModel>> getKetentuan() async {
    List<KetentuanModel> list = [];

    try {
      Response response = await DioService.get('/dashboard/admin/ketentuan');

      print('/dashboard/admin/ketentuan ${response.data['data']}');

      if (response.data['data'] != null) {
        list = response.data['data']
          .map<KetentuanModel>((e) => KetentuanModel.fromJson(e))
          .toList();
      }
    } on DioException catch (e) {
      throw Exception(e);
    }

    return list;
  }

  static Future<List<UserModel>> getListPeserta() async {
    List<UserModel> list = [];

    try {
      Response response = await DioService.get('/dashboard/admin/peserta');

      print('/dashboard/admin/peserta ${response.data['data']}');

      if (response.data['data'] != null) {
        list = response.data['data']
          .map<UserModel>((e) => UserModel.fromJson(e))
          .toList();
      }
    } on DioException catch (e) {
      throw Exception(e);
    }

    return list;
  }

  static Future<List<UserModel>> getListPanitia() async {
    List<UserModel> list = [];

    try {
      Response response = await DioService.get('/dashboard/admin/akun-admin');

      print('/dashboard/admin/akun-admin ${response.data['data']}');

      if (response.data['data'] != null) {
        list = response.data['data']
          .map<UserModel>((e) => UserModel.fromJson(e))
          .toList();
      }
    } on DioException catch (e) {
      throw Exception(e);
    }

    return list.where((e) => e.id != 275).toList();
  }

  static Future<List<NewsModel>> getNews() async {
    List<NewsModel> list = [];

    try {
      Response response = await DioService.get('/dashboard/admin/news');

      print('/dashboard/admin/news ${response.data['data']}');

      if (response.data['data'] != null) {
        list = response.data['data']
          .map<NewsModel>((e) => NewsModel.fromJson(e))
          .toList();
      }
    } on DioException catch (e) {
      throw Exception(e);
    }

    return list;
  }
}