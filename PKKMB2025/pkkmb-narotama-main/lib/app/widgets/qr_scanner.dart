import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:pkkmb/app/modules/main/controllers/main_controller.dart';
import 'package:qr_code_scanner/qr_code_scanner.dart';
import 'package:qr_scanner_overlay/qr_scanner_overlay.dart';

class QrScanner extends StatefulWidget {
  final void Function(String) onScanned;

  const QrScanner({super.key, required this.onScanned});

  @override
  State<QrScanner> createState() => _QrScannerState();
}

class _QrScannerState extends State<QrScanner> {
  final GlobalKey qrKey = GlobalKey(debugLabel: 'QR');
  Barcode? result;
  QRViewController? controller;
  MainController mainController = Get.find<MainController>();

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: Text('QR Scanner')),
      body: Stack(
        children: [
          QRView(
            key: qrKey,
            onQRViewCreated: _onQRViewCreated,
          ),
          QRScannerOverlay(
            scanAreaWidth: MediaQuery.of(context).size.width * 0.8,
            scanAreaHeight: MediaQuery.of(context).size.width * 0.8,
          ),
          Obx(() => mainController.loadingQr.value ? Container(
            width: double.infinity,
            height: MediaQuery.of(context).size.height,
            color: Colors.black.withOpacity(0.3),
            child: Center(
              child: CircularProgressIndicator(),
            ),
          ) : SizedBox())
        ],
      ),
    );
  }

  void _onQRViewCreated(QRViewController controller) {
    setState(() {
      this.controller = controller;
    });

    controller.scannedDataStream.listen((scanData) async {
      if (mainController.loadingQr.value) {
        return;
      }

      setState(() {
        result = scanData;
      });

      widget.onScanned(result?.code ?? '');
    });
  }
}