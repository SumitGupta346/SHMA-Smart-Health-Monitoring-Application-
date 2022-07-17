import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:flutter_svg/flutter_svg.dart';
import 'package:http/http.dart' as http;
import 'package:shared_preferences/shared_preferences.dart';
import 'package:smarthealth/constants.dart';
import 'package:smarthealth/shared/app_colors.dart';
import 'package:smarthealth/shared/custom_drawer.dart';
import 'package:smarthealth/widgets/my_header.dart';
import '../util/app_constants.dart';
import 'home_page.dart';

class SleepHours extends StatefulWidget {
  const SleepHours({Key? key}) : super(key: key);

  @override
  State<SleepHours> createState() => _MyStatefulWidgetState();
}

class _MyStatefulWidgetState extends State<SleepHours> {
  TextEditingController textController = TextEditingController();
  late ScaffoldMessengerState scaffoldMessenger;
  var token = '';
  bool isLoading = false;
  GlobalKey<ScaffoldState> scaffoldKey = GlobalKey();

  getToken() async {
    SharedPreferences preferences = await SharedPreferences.getInstance();

    token = preferences.getString("token")!.toString();
  }

  @override
  Widget build(BuildContext context) {
    getToken();
    scaffoldMessenger = ScaffoldMessenger.of(context);
    return SafeArea(
      child:Scaffold(
      drawerScrimColor: AppColors.primaryColor,
        key: scaffoldKey,
        drawer: CustomDrawer(),
        backgroundColor: kBackgroundColor,
      body: SingleChildScrollView(
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: <Widget>[
              Padding(
                padding: EdgeInsets.symmetric(horizontal: 30),
                child: Row(
                  mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  children: <Widget>[

                    GestureDetector(child:SvgPicture.asset('assets/icons/menu.svg'),
                    onTap: () {
                  scaffoldKey.currentState?.openDrawer();
                },
                    ),
                    
                  ],
                ),
              ),
              MyHeader(
            height: 50,
            imageUrl: 'assets/images/avatar_head.png',
            child: Text(''),
          ),
              Container(
                    alignment: Alignment.center,
                    padding: const EdgeInsets.all(10),
                    child: const Text(
                      'Sleep Hours Update',
                      style: TextStyle(fontSize: 20),
                    )),
                
                Container(
                  padding: const EdgeInsets.all(10),
                  child: TextField(
                    controller: textController,
                    decoration: InputDecoration(
                      counterText: "",
                      hintText: "Sleeping Hours",
                      icon: Icon(
                        Icons.timer,
                        color: mTitleTextColor,
                      ),
                    ),
                  ),
                ),
                SizedBox(height: 10.0),
                Row(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children:[
                ClipRRect(
                    borderRadius: BorderRadius.circular(36),
                    child: FlatButton(
                      color: mButtonColor,
                      padding: const EdgeInsets.symmetric(
                          horizontal: 32, vertical: 12),
                      onPressed: () {
                       var shours = textController.text;

                        if (shours != "") {
                          setState(() {
                            isLoading = true;
                          });
                          saveSleepHours(shours);
                        } else {
                          showDialog(
                            context: context,
                            builder: (BuildContext context) {
                              return AlertDialog(
                                title: new Text("Alert!!"),
                                content: new Text(
                                    "Please enter how much hours you seleep in a day!"),
                                actions: <Widget>[
                                  new FlatButton(
                                    child: new Text("OK"),
                                    onPressed: () {
                                      Navigator.of(context).pop();
                                    },
                                  ),
                                ],
                              );
                            },
                          );
                        }
                      },
                      child: Text(
                        'Update',
                        style: TextStyle(fontSize: 22, color: Colors.white),
                      ),
                    ),
                  ),
                  ]
                ),
              
            ]
            ),
          ),
      ),
        );
  }

  saveSleepHours(sleep_hours) async {
    Map data = {
      'sleep_hours': sleep_hours,
    };
    print(token);
    print(data.toString());
    print(Uri.parse(AppConstants.DOMAIN + AppConstants.SLEEP_HOURS_URI));
    final response = await http.post(
        Uri.parse(AppConstants.DOMAIN + AppConstants.SLEEP_HOURS_URI),
        headers: {
          'Authorization': 'Bearer $token',
          "Accept": "application/json",
        },
        body: data,
        encoding: Encoding.getByName("utf-8"));
    setState(() {
      isLoading = false;
    });
    print(response.body);
    if (response.statusCode == 200) {
      Map<String, dynamic> resposnebody = jsonDecode(response.body);
scaffoldMessenger
          .showSnackBar(SnackBar(content: Text("Sleep Hours Updated Successfully")));
Navigator.push(
              context,
              MaterialPageRoute(builder: (context) => const MyHomePage(title:'Smart Health')),
            );
      //print(" User name ${user['id']}");

    } else {
      scaffoldMessenger
          .showSnackBar(SnackBar(content: Text("Please try again!")));
    }
  }
}
