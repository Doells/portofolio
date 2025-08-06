import 'package:easy_debounce/easy_debounce.dart';
import 'package:flutter/material.dart';
import 'package:flutter_remix/flutter_remix.dart';
import 'package:pkkmb/app/widgets/input/naro_textfield.dart';
import 'package:pkkmb/app/widgets/misc/naro_card.dart';
import 'package:pkkmb/core/theme/naro_theme.dart';

class OptionSelector extends StatelessWidget {
  final List<Option>? options;
  final bool enableSearch;
  final Function(String)? onSearch;
  final bool loading;
  final String placeholder;

  const OptionSelector({
    super.key,
    this.options,
    this.enableSearch = false,
    this.onSearch,
    this.loading = false,
    this.placeholder = 'Cari...',
  });

  @override
  Widget build(BuildContext context) {
    return SingleChildScrollView(
      child: Column(
        mainAxisSize: MainAxisSize.min,
        children: [
          enableSearch ? Padding(
            padding: const EdgeInsets.only(top: 12),
            child: NaroTextField(
              hintText: placeholder,
              suffixIcon: Icon(
                FlutterRemix.search_line,
                color: NaroTheme.color.primary,
              ),
              autofocus: true,
              dense: true,
              onChanged: (data) {
                if (onSearch != null) {
                  EasyDebounce.debounce('search-option', Duration(milliseconds: 500), () {
                    onSearch!(data);
                  });
                }
              },
            ),
          ) : SizedBox(),
          enableSearch ? LinearProgressIndicator(
            value: !loading ? 0 : null,
          ) : SizedBox(),
          SizedBox(height: 16),
          ...List.generate(options?.length ?? 0, (index) => options![index])
        ],
      ),
    );
  }
}

class Option extends StatelessWidget {
  final Widget child;
  final VoidCallback onTap;

  const Option({
    super.key,
    required this.child,
    required this.onTap,
  });

  @override
  Widget build(BuildContext context) {
    return GestureDetector(
      onTap: onTap,
      child: NaroCard(
        outlined: true,
        width: double.infinity,
        padding: const EdgeInsets.all(14),
        margin: const EdgeInsets.only(bottom: 8),
        child: child,
      ),
    );
  }
}