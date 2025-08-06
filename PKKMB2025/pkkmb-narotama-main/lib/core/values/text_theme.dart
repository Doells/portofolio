import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'color_theme.dart';

class TextTheme {
  const TextTheme();

  TextStyle get heading => GoogleFonts.lexend(
    fontSize: 20,
    fontWeight: FontWeight.w600,
    color: const ColorTheme().darkergrey,
  );
  TextStyle get title => GoogleFonts.lexend(
    fontSize: 18,
    fontWeight: FontWeight.w600,
    color: const ColorTheme().darkergrey,
  );
  TextStyle get subtitle => GoogleFonts.lexend(
    fontSize: 16,
    fontWeight: FontWeight.w500,
    color: const ColorTheme().darkergrey,
  );
  TextStyle get body => GoogleFonts.lexend(
    fontSize: 16,
    fontWeight: FontWeight.w400,
    color: const ColorTheme().darkergrey,
    height: 1.4,
  );
  TextStyle get body2 => GoogleFonts.lexend(
    fontSize: 14,
    fontWeight: FontWeight.w400,
    color: const ColorTheme().darkergrey,
  );
  TextStyle get caption => GoogleFonts.lexend(
    fontSize: 12,
    fontWeight: FontWeight.w400,
    color: const ColorTheme().darkergrey,
  );
  TextStyle get small => GoogleFonts.lexend(
    fontSize: 9,
    fontWeight: FontWeight.w400,
    color: const ColorTheme().darkergrey,
  );
}