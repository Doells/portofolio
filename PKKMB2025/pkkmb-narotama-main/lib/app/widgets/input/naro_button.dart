import 'package:flutter/material.dart';
import 'package:pkkmb/core/theme/naro_theme.dart';

// ignore: must_be_immutable
class NaroButton extends StatelessWidget {
  final NaroButtonVariant variant;
  final String? text;
  final Color? textColor;
  Color? color = NaroTheme.color.primary;
  final bool loading;
  void Function()? onPressed;
  final Widget? child;
  final IconData? icon;
  final double borderWidth;
  final double? height;

  NaroButton({
    super.key,
    required this.variant,
    this.text,
    this.color,
    this.textColor,
    this.loading = false,
    this.onPressed,
    this.child,
    this.icon,
    this.borderWidth = 1.5,
    this.height = 56,
  });

  @override
  Widget build(BuildContext context) {
    return SizedBox(width: double.infinity, height: height, child: renderButton());
  }

  Widget renderButton() {
    if (variant == NaroButtonVariant.outlined) {
      return OutlinedButton(
        onPressed: loading ? null : onPressed,
        // ignore: sort_child_properties_last
        child: loading
            ? SizedBox(
                height: 24,
                width: 24,
                child: CircularProgressIndicator(
                    backgroundColor: color?.withOpacity(0.5),
                    valueColor: AlwaysStoppedAnimation<Color>(
                        color ?? NaroTheme.color.primary)),
              )
            : renderChild(),
        style: OutlinedButton.styleFrom(
          shape: RoundedRectangleBorder(
            borderRadius: BorderRadius.circular(8),
          ),
          side: BorderSide(
            color: color ?? NaroTheme.color.primary,
            width: borderWidth,
          ),
        ),
      );
    }

    if (variant == NaroButtonVariant.text) {
      return TextButton(
        onPressed: loading ? null : onPressed,
        child: renderChild(),
      );
    }

    return ElevatedButton(
      onPressed: loading ? null : onPressed,
      // ignore: sort_child_properties_last
      child: loading
          ? SizedBox(
              height: 20,
              width: 20,
              child: CircularProgressIndicator(
                backgroundColor: NaroTheme.color.grey.withOpacity(0.5),
                valueColor: AlwaysStoppedAnimation<Color>(
                    textColor ?? NaroTheme.color.white),
              ),
            )
          : renderChild(),
      style: ButtonStyle(
        backgroundColor: WidgetStateProperty.all<Color>(color ?? NaroTheme.color.primary),
        shape: WidgetStateProperty.all(
          RoundedRectangleBorder(
            borderRadius: BorderRadius.circular(8)
          )
        )
      ),
    );
  }

  Widget buttonText() {
    return Text(
      text ?? '',
      style: NaroTheme.text.body2.copyWith(
        color: textColor ?? (variant == NaroButtonVariant.outlined ? NaroTheme.color.primary : NaroTheme.color.white),
        fontWeight: FontWeight.w500,
        fontSize: 16
      ),
    );
  }

  Widget renderChild() {
    if (icon == null) {
      return child ?? buttonText();
    }

    return Row(
      mainAxisAlignment: MainAxisAlignment.spaceBetween,
      crossAxisAlignment: CrossAxisAlignment.center,
      children: [
        buttonText(),
        Icon(
          icon,
          size: 20,
          color: variant == NaroButtonVariant.outlined ? NaroTheme.color.primary : NaroTheme.color.white,
        ),
      ],
    );
  }
}

enum NaroButtonVariant {
  elevated,
  outlined,
  text,
}
