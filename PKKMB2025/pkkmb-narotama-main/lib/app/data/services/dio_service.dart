import 'package:dio/dio.dart';

class DioService {
  static Dio dio = Dio();

  static void init() {
    // LUPAKAN .ENV, KITA PAKAI URL LANGSUNG DI SINI
    final String baseUrl =
        'http://192.168.1.172/nlhotness-pkkmb-un-2024-2a5c1b240200/public/api';

    print("--- MENGGUNAKAN URL HARDCODE ---");
    print("URL: $baseUrl");
    print("--------------------------------");

    dio = Dio(BaseOptions(
      baseUrl: baseUrl, // URL dimasukkan langsung
      connectTimeout: const Duration(seconds: 60),
      receiveTimeout: const Duration(seconds: 60),
    ));
  }

  // Kode di bawah ini tidak perlu diubah
  static void setToken(String token) {
    dio.options.headers['authorization'] = 'Bearer $token';
  }

  static Future<Response> get(
    String path, {
    Map<String, dynamic>? queryParameters,
    Options? options,
    dynamic data,
  }) async {
    try {
      final response = await dio.get(
        path,
        queryParameters: queryParameters,
        data: data,
        options: options,
      );
      return response;
    } on DioException catch (e) {
      throw Exception(e);
    }
  }

  static Future<Response> post(String path,
      {Map<String, dynamic>? queryParameters,
      dynamic data,
      Options? options}) async {
    try {
      final response = await dio.post(path,
          queryParameters: queryParameters, data: data, options: options);
      return response;
    } on DioException catch (e) {
      print('err post $e');
      rethrow;
    }
  }

  // ... (sisa method patch dan delete) ...
}
