import 'package:flutter/material.dart';
import 'package:pkkmb/core/theme/naro_theme.dart';

ThemeData apptheme() {
  final ThemeData base = ThemeData.light();

  return base.copyWith(
    primaryColorDark: NaroTheme.color.primary,
    primaryColorLight: NaroTheme.color.primary,
    appBarTheme: AppBarTheme(
      color: NaroTheme.color.white,
      elevation: 0,
      iconTheme: IconThemeData(
        color: NaroTheme.color.primary,
      ),
      titleTextStyle: NaroTheme.text.subtitle
          .copyWith(fontSize: 18, color: NaroTheme.color.primary),
      centerTitle: true,
    ),
    dialogTheme: DialogThemeData(
      titleTextStyle: NaroTheme.text.heading,
      backgroundColor: Colors.white,
    ),
    textTheme: TextTheme(
      titleLarge: NaroTheme.text.heading,
      titleMedium: NaroTheme.text.title,
      titleSmall: NaroTheme.text.subtitle,
      bodyLarge: NaroTheme.text.body,
      bodyMedium: NaroTheme.text.body2,
      labelLarge: NaroTheme.text.body2,
      bodySmall: NaroTheme.text.caption,
      labelSmall: NaroTheme.text.small,
    ),
    elevatedButtonTheme: ElevatedButtonThemeData(
      style: ButtonStyle(
          backgroundColor:
              WidgetStateProperty.all<Color>(NaroTheme.color.primary),
          elevation: WidgetStateProperty.all<double>(1),
          textStyle:
              WidgetStateProperty.all<TextStyle>(NaroTheme.text.body.copyWith(
            color: NaroTheme.color.white,
          ))),
    ),
    floatingActionButtonTheme: FloatingActionButtonThemeData(
      backgroundColor: NaroTheme.color.primary,
    ),
    scaffoldBackgroundColor: NaroTheme.color.white,
    primaryColor: NaroTheme.color.primary,
    dividerColor: NaroTheme.color.grey,
    progressIndicatorTheme: ProgressIndicatorThemeData(
      color: NaroTheme.color.primary,
    ),
  );
}
