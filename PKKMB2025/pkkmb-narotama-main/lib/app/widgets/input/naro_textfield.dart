import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:pkkmb/core/theme/naro_theme.dart';

class NaroTextField extends StatelessWidget {
  final String? hintText;
  final bool? readOnly;
  final TextEditingController? controller;
  final bool? dense;
  final Widget? suffixIcon;
  final Function(String)? onChanged;
  final bool? autofocus;
  final String? Function(String?)? validator;
  final TextInputType? keyboardType;
  final bool? obsecure;
  final String? initialValue;
  final int? maxLines;

  const NaroTextField({
    super.key,
    this.hintText,
    this.readOnly,
    this.controller,
    this.dense,
    this.suffixIcon,
    this.onChanged,
    this.autofocus,
    this.validator,
    this.keyboardType,
    this.obsecure,
    this.initialValue,
    this.maxLines,
  });

  @override
  Widget build(BuildContext context) {
    return TextFormField(
      controller: controller,
      onChanged: onChanged,
      autofocus: autofocus ?? false,
      validator: validator,
      keyboardType: keyboardType,
      obscureText: obsecure ?? false,
      readOnly: readOnly ?? false,
      decoration: InputDecoration(
        filled: true,
        fillColor: NaroTheme.color.lightgrey,
        suffixIcon: suffixIcon,
        hintText: hintText,
        hintStyle: GoogleFonts.lexend(
          fontSize: dense ?? false ? 14 : 16,
          color: NaroTheme.color.grey,
          fontWeight: FontWeight.w400,
        ),
        border: OutlineInputBorder(
          borderRadius: BorderRadius.circular(4),
          borderSide: const BorderSide(color: Colors.transparent),
        ),
        focusedBorder: OutlineInputBorder(
          borderRadius: BorderRadius.circular(4),
          borderSide: const BorderSide(color: Colors.transparent),
        ),
        enabledBorder: OutlineInputBorder(
          borderRadius: BorderRadius.circular(4),
          borderSide: const BorderSide(color: Colors.transparent),
        ),
        contentPadding:
            dense ?? false ? EdgeInsets.all(12) : EdgeInsets.all(14),
        focusColor: NaroTheme.color.red,
      ),
      initialValue: initialValue,
      cursorColor: NaroTheme.color.primary,
      style: GoogleFonts.lexend(
        fontSize: dense ?? false ? 14 : 16,
        color: NaroTheme.color.darkergrey,
      ),
    );
  }
}