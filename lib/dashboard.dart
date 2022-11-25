import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:flutter/src/widgets/container.dart';
import 'package:flutter/src/widgets/framework.dart';
import 'package:flutter_widget_from_html_core/flutter_widget_from_html_core.dart';
import 'package:http/http.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:syncfusion_flutter_charts/charts.dart';
import 'package:syncfusion_flutter_gauges/gauges.dart';

class DashBoard extends StatefulWidget {
  const DashBoard({super.key});

  @override
  State<DashBoard> createState() => _DashBoardState();
}

class _DashBoardState extends State<DashBoard> {
  var rows = <Container>[];

  Future<void> loadData() async {
    final prefs = await SharedPreferences.getInstance();

    var token = await prefs.getString('token');

    var data = await post(
        Uri.parse("https://1sec.live/api.php?action=get_feed"),
        headers: {"Content-Type": "application/json"},
        body: jsonEncode({"token": token}));

    var rep = jsonDecode(data.body);

    if (rep["code"] == 200) {
      var apikey = rep["status"]["apikey"];
      var channelid = rep["status"]["channelid"];

      var things = await get(Uri.parse(
          "https://api.thingspeak.com/channels/$channelid/feeds.json"));

      var jsonThing = jsonDecode(things.body);
      var ch = jsonThing["feeds"];

      // var f1 = ch["field1"];

      rows.add(Container(
          child: SfCartesianChart(
        primaryXAxis: CategoryAxis(),
        tooltipBehavior: TooltipBehavior(enable: true),
        title: ChartTitle(text: 'Humidity in last 30 days'),
        legend: Legend(isVisible: true),
        series: <LineSeries<dynamic, String>>[
          LineSeries<dynamic, String>(
              dataSource: ch,
              xValueMapper: (dynamic data, _) => data["created_at"] ?? 0,
              yValueMapper: (dynamic data, _) =>
                  data["field1"] is String ? 10 : (data["field1"] ?? 0) ?? 0,
              // Enable data label
              dataLabelSettings: DataLabelSettings(isVisible: true))
        ],
      )));

      var dt = ch.last;
      rows.add(Container(
        child: SizedBox(
          height: 20,
        ),
      ));
      rows.add(Container(child: Text("Temprature *C")));
      rows.add(Container(
          child: Gauge(
        values: dt["field2"],
        scale: 10,
      )));
      rows.add(Container(
        child: SizedBox(
          height: 20,
        ),
      ));
      rows.add(Container(child: Text("Air quality index")));
      rows.add(Container(child: Gauge(values: dt["field3"], scale: 10)));
      rows.add(Container(
        child: SizedBox(
          height: 20,
        ),
      ));
      rows.add(Container(child: Text("Soil Moisture")));
      rows.add(Container(child: Gauge(values: dt["field4"], scale: 5)));

      rows.add(Container(
        child: SizedBox(
          height: 20,
        ),
      ));

      rows.add(Container(child: Text("Soil pH")));
      rows.add(Container(child: Gauge(values: dt["field5"], scale: 5)));

      setState(() {});

      // ch.forEach((element) {});
    } else {
      showDialog(
          context: context,
          builder: (context) {
            return AlertDialog(
              content: Text(rep["status"]),
              actions: [
                ElevatedButton(
                    onPressed: () => Navigator.pop(context), child: Text("OK"))
              ],
            );
          });
    }

    print(data.body);
    // var humidity = rep["humidity"];
  }

  @override
  void initState() {
    super.initState();
    loadData();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text("Dashboard"),
        centerTitle: true,
      ),
      body: SingleChildScrollView(
        child: Column(children: [
          SizedBox(
            height: 20,
          ),
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceAround,
            children: [
              Text(
                "Lights",
                style: TextStyle(fontSize: 20, fontWeight: FontWeight.w600),
              ),
              AnimatedSwitch(),
            ],
          ),
          SizedBox(
            height: 20,
          ),
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceAround,
            children: [
              Text(
                "Pump",
                style: TextStyle(fontSize: 20, fontWeight: FontWeight.w600),
              ),
              AnimatedSwitch(),
            ],
          ),
          SizedBox(
            height: 10,
          ),
          rows.isEmpty
              ? CircularProgressIndicator()
              : Column(
                  children: rows,
                )
        ]),
      ),
    );
  }
}

class AnimatedSwitch extends StatefulWidget {
  @override
  _AnimatedSwitchState createState() => _AnimatedSwitchState();
}

class _AnimatedSwitchState extends State<AnimatedSwitch> {
  var isEnabled = false;
  final animationDuration = Duration(milliseconds: 500);

  @override
  Widget build(BuildContext context) {
    return GestureDetector(
      onTap: () async {
        setState(() {
          isEnabled = !isEnabled;
        });

        // if (isEnabled) {
        //   var aderino = await get(Uri.parse("http://192.168.1.1/disable"));
        // } else {
        //   var aderino = await get(Uri.parse("http://192.168.1.1/enable"));
        // }
      },
      child: AnimatedContainer(
        height: 40,
        width: 70,
        duration: animationDuration,
        decoration: BoxDecoration(
          borderRadius: BorderRadius.circular(30),
          color: isEnabled ? Color(0xff565671) : Color(0xff989fd5),
          border: Border.all(color: Colors.white, width: 2),
          boxShadow: [
            BoxShadow(
              color: Colors.grey.shade400,
              spreadRadius: 2,
              blurRadius: 10,
            ),
          ],
        ),
        child: AnimatedAlign(
          duration: animationDuration,
          alignment: isEnabled ? Alignment.centerRight : Alignment.centerLeft,
          child: Padding(
            padding: EdgeInsets.symmetric(horizontal: 2),
            child: Container(
              width: 30,
              height: 30,
              decoration: BoxDecoration(
                shape: BoxShape.circle,
                color: Colors.white,
              ),
            ),
          ),
        ),
      ),
    );
  }
}

/// Gauge imports
class Gauge extends StatelessWidget {
  final values;
  final scale;
  const Gauge({super.key, this.values, this.scale});

  @override
  Widget build(BuildContext context) {
    return _buildDefaultRadialGauge();
  }

  /// Returns the default axis gauge
  SfRadialGauge _buildDefaultRadialGauge() {
    return SfRadialGauge(
      enableLoadingAnimation: true,
      axes: <RadialAxis>[
        RadialAxis(
            interval: double.tryParse("$scale") ?? 0,
            axisLineStyle: const AxisLineStyle(
              thickness: 0.03,
              thicknessUnit: GaugeSizeUnit.factor,
            ),
            showTicks: false,
            showLastLabel: true,
            axisLabelStyle: GaugeTextStyle(
              fontSize: 14,
            ),
            labelOffset: 25,
            radiusFactor: 0.95,
            pointers: <GaugePointer>[
              NeedlePointer(
                  needleLength: 0.7,
                  value: double.tryParse(values) ?? 0,
                  needleColor: _needleColor,
                  needleStartWidth: 0,
                  needleEndWidth: 4,
                  knobStyle: KnobStyle(color: _needleColor, knobRadius: 0.05)),
            ])
      ],
    );
  }

  final Color _needleColor = const Color(0xFFC06C84);
}
