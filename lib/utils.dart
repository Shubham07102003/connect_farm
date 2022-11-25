import 'package:flutter/material.dart';

void changePageTo(BuildContext context, Widget toGo) {
  // Navigator.pushReplacement(
  //     context,
  //     MaterialPageRoute(
  //       builder: (context) => toGo,
  //     ));

  Navigator.push(
      context,
      MaterialPageRoute(
        builder: (context) => toGo,
      ));
}