import 'package:encrypt/encrypt.dart' as enc;

class InternalEncryption {
  static String encrypt(String text) {
    final key = enc.Key.fromBase64('c+R8LGJChPU+1zoZ1BgJmqaivpKn/Ly/RsapBKI55fY=');
    final iv = enc.IV.fromBase64('UHvpaORuxDGSu+LQuPZmSg==');
    final encrypter = enc.Encrypter(enc.AES(key));

    return encrypter.encrypt(text, iv: iv).base64;
  }

  static String decrypt(String text) {
    final key = enc.Key.fromBase64('c+R8LGJChPU+1zoZ1BgJmqaivpKn/Ly/RsapBKI55fY=');
    final iv = enc.IV.fromBase64('UHvpaORuxDGSu+LQuPZmSg==');
    final encrypter = enc.Encrypter(enc.AES(key));

    return encrypter.decrypt(enc.Encrypted.fromBase64(text), iv: iv);
  }
}