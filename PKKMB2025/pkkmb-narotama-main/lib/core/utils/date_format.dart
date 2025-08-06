import 'package:intl/intl.dart';

class FormatDate {
  /// Rabu, 17 Agustus 2022 · 12.12
  static DateFormat type1 = DateFormat('EEEE, dd MMMM y · HH.mm', 'id_ID');

  /// Rabu, 17 Agustus 2022
  static DateFormat type2 = DateFormat('EEEE, dd MMMM y', 'id_ID');

  /// 17 Agustus 2022 · 12.12
  static DateFormat type3 = DateFormat('dd MMMM y · HH.mm', 'id_ID');

  /// 17 Agustus 2022
  static DateFormat type4 = DateFormat('dd MMMM y', 'id_ID');

  /// 17/08/2022
  static DateFormat type5 = DateFormat('dd/MM/y', 'id_ID');

  /// 17/08/22
  static DateFormat type6 = DateFormat('dd/MM/yy', 'id_ID');

  /// 12.12
  static DateFormat type7 = DateFormat('HH.mm', 'id_ID');

  /// 17/08/22 12.12
  static DateFormat type8 = DateFormat('dd/MM/yy HH.mm', 'id_ID');
}