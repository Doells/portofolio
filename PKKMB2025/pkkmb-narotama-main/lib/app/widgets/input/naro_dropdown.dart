import 'package:flutter/material.dart';
import 'package:flutter_remix/flutter_remix.dart';
import 'package:pkkmb/core/theme/naro_theme.dart';

class NaroDropdown<T> extends StatelessWidget {
  final List<DropdownMenuItem> items;
  final Function(dynamic)? onChanged;
  final bool outlined;
  final bool dense;
  final double? itemHeight;
  final dynamic value;

  const NaroDropdown({
    super.key,
    required this.items,
    this.onChanged,
    this.outlined = true,
    this.dense = true,
    this.itemHeight = 48,
    this.value
  });

  @override
  Widget build(BuildContext context) {
    return Container(
      decoration: BoxDecoration(
        border: outlined ? Border.all(
          color: NaroTheme.color.lightgrey,
          width: 1,
        ) : null,
        borderRadius: BorderRadius.circular(4),
        color: NaroTheme.color.lightgrey,
      ),
      padding: const EdgeInsets.all(12),
      child: DropdownButton(
        isExpanded: true,
        isDense: dense,
        elevation: 1,
        value: value,
        dropdownColor: NaroTheme.color.white,
        itemHeight: itemHeight,
        alignment: AlignmentDirectional.bottomEnd,
        items: items,
        onChanged: (data) {
          if (onChanged != null) {
            onChanged!(data);
          }
        },
        underline: const SizedBox(),
        icon: Icon(
          FlutterRemix.arrow_down_s_line,
          color: NaroTheme.color.grey,
          size: 24,
        ),
      ),
    );
  }
}