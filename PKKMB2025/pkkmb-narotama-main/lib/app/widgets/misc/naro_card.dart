import 'package:flutter/material.dart';
import 'package:pkkmb/core/theme/naro_theme.dart';

class NaroCard extends StatelessWidget {
  final bool outlined;
  final Widget child;
  final double? width;
  final EdgeInsets? margin;
  final EdgeInsets? padding;
  final BorderRadiusGeometry? borderRadius;
  final Color? color;
  final bool shadowed;
  final BoxConstraints? constraints;

  const NaroCard({
    super.key,
    required this.child,
    this.outlined = false,
    this.width = double.infinity,
    this.margin = const EdgeInsets.all(0),
    this.padding = const EdgeInsets.all(16),
    this.borderRadius,
    this.color,
    this.shadowed = false,
    this.constraints
  });

  @override
  Widget build(BuildContext context) {
    return Container(
      decoration: BoxDecoration(
        color: color ?? NaroTheme.color.white,
        borderRadius: borderRadius ?? BorderRadius.circular(8),
        border: outlined ? Border.all(
          color: NaroTheme.color.grey.withOpacity(0.5)
        ) : null,
        boxShadow: shadowed ? [
          BoxShadow(
            color: Colors.grey.withOpacity(0.14),
            spreadRadius: 1,
            blurRadius: 8,
            offset: Offset(0, 2),
          ),
        ] : null,
      ),
      constraints: constraints,
      margin: margin,
      width: width,
      padding: padding,
      child: child,
    );
  }
}