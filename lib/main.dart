import 'dart:convert';

import 'package:auto_farming/dashboard.dart';
import 'package:auto_farming/utils.dart';
import 'package:day_night_switcher/day_night_switcher.dart';
import 'package:flutter/material.dart';
import 'package:http/http.dart';
import 'package:lottie/lottie.dart';
import 'package:shared_preferences/shared_preferences.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatefulWidget {
  const MyApp({super.key});

  @override
  State<MyApp> createState() => _MyAppState();
}

class _MyAppState extends State<MyApp> {

      bool isDarkModeEnabled = false;
  /// Called when the state (day / night) has changed.
  void onStateChanged(bool isDarkModeEnabled) {
    setState(() {
      this.isDarkModeEnabled = isDarkModeEnabled;
    });
  }


  // This widget is the root of your application.
  @override
  Widget build(BuildContext context) {



    return MaterialApp(
      debugShowCheckedModeBanner: false,
      title: 'Farm Connect',
              theme: ThemeData.light(),
        darkTheme: ThemeData.dark().copyWith(
          appBarTheme: AppBarTheme(color: const Color(0xFF253341)),
          scaffoldBackgroundColor: const Color(0xFF15202B),
        ),
      themeMode: isDarkModeEnabled ? ThemeMode.dark : ThemeMode.light,

      home: MyHomePage(
        mode_switch: DayNightSwitcher(
          isDarkModeEnabled: isDarkModeEnabled,
          onStateChanged: onStateChanged,
        ),
      ),
    );
  }
}

class MyHomePage extends StatefulWidget {
  final mode_switch;
  const MyHomePage({super.key, this.mode_switch});

  @override
  State<MyHomePage> createState() => _MyHomePageState();
}

class _MyHomePageState extends State<MyHomePage> {
  void checkToken() async {
    final prefs = await SharedPreferences.getInstance();

    var tok = await prefs.getString("token");

    if (tok!.isNotEmpty) {
      changePageTo(context, DashBoard());
    }
  }

  @override
  void initState() {
    super.initState();
    checkToken();
  }

  TextEditingController _username = new TextEditingController();
  TextEditingController _pass = new TextEditingController();

  var loading = false;

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: SingleChildScrollView(
        child: SafeArea(
            child: Column(
          children: [
            SizedBox(
              height: 20,
            ),
            widget.mode_switch,
            SizedBox(
              height: 20,
            ),
            Row(
              children: [
                SizedBox(
                  width: 20,
                ),
                Text(
                  "Welcome To",
                  style: TextStyle(fontSize: 40, fontWeight: FontWeight.w700),
                ),
              ],
            ),
            Text("Farm Connect",
                style: TextStyle(
                    color: Colors.green[700],
                    fontSize: 37,
                    fontWeight: FontWeight.w700)),
            Padding(
              padding: EdgeInsets.all(10),
              child: TextField(
                controller: _username,
                decoration: InputDecoration(
                    border: OutlineInputBorder(),
                    labelText: 'User Name',
                    hintText: 'Enter valid Username'),
              ),
            ),
            Padding(
              padding: EdgeInsets.all(10),
              child: TextField(
                controller: _pass,
                obscureText: true,
                decoration: InputDecoration(
                    border: OutlineInputBorder(),
                    labelText: 'Password',
                    hintText: 'Enter your secure password'),
              ),
            ),
            ElevatedButton(
                onPressed: () async {
                  if (_username.text.isEmpty || _pass.text.isEmpty) {
                    showDialog(
                        context: context,
                        builder: (context) {
                          return AlertDialog(
                            content: Text("Enter Some Value In all Feilds"),
                            actions: [
                              ElevatedButton(
                                  onPressed: () => Navigator.pop(context),
                                  child: Text("OK"))
                            ],
                          );
                        });
                  } else {
                    setState(() {
                      loading = true;
                    });
                    var data = await post(
                        Uri.parse("https://1sec.live/api.php?action=login"),
                        headers: {"Content-Type": "application/json"},
                        body: jsonEncode(
                            {"user": _username.text, "pass": _pass.text}));
      
                    var resp = jsonDecode(data.body);
                    setState(() {
                      loading = false;
                    });
                    final prefs = await SharedPreferences.getInstance();
      
                    await prefs.setString('token', resp["status"]);
                    if (resp["code"] == 200) {
                      changePageTo(context, DashBoard());
                    } else {
                      showDialog(
                          context: context,
                          builder: (context) {
                            return AlertDialog(
                              content: Text(resp["status"]),
                              actions: [
                                ElevatedButton(
                                    onPressed: () => Navigator.pop(context),
                                    child: Text("OK"))
                              ],
                            );
                          });
                    }
      
                    print(resp);
                  }
                },
                child: SizedBox(
                  width: 100,
                  height: 50,
                  child: Row(
                    children: [
                      loading ? CircularProgressIndicator() : SizedBox(),
                      Text("Login"),
                    ],
                  ),
                )),
      
                LottieBuilder.network("https://assets8.lottiefiles.com/private_files/lf30_4lyswkde.json"),
          ],
        )),
      ),
    );
  }
}
