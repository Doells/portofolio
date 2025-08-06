import 'package:flutter/material.dart';
import 'package:pkkmb/core/theme/naro_theme.dart';

class NaroChip extends StatelessWidget {
  final Widget? child;
  final String? text;
  final Color? color;

  const NaroChip({
    super.key,
    this.color,
    this.text,
    this.child
  });

  @override
  Widget build(BuildContext context) {
    return Container(
      padding: const EdgeInsets.symmetric(
        vertical: 4,
        horizontal: 6
      ),
      decoration: BoxDecoration(
        color: color ?? NaroTheme.color.primary,
        borderRadius: BorderRadius.circular(4)
      ),
      child: text != null ? Text(
        text ?? '',
        style: NaroTheme.text.caption.copyWith(
          color: NaroTheme.color.white
        ),
      ) : child,
    );
  }
}