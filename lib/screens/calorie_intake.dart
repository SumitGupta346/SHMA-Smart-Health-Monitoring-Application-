import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:flutter_svg/svg.dart';
import 'package:http/http.dart' as http;
import 'package:shared_preferences/shared_preferences.dart';
import 'package:smarthealth/constants.dart';
import 'package:smarthealth/shared/app_colors.dart';
import 'package:smarthealth/shared/custom_drawer.dart';
import 'package:smarthealth/widgets/my_header.dart';

import '../util/app_constants.dart';
import 'home_page.dart';

class CalorieIntake extends StatefulWidget {
  const CalorieIntake({Key? key}) : super(key: key);

  @override
  State<CalorieIntake> createState() => _MyStatefulWidgetState();
}

class Food {
  final String id;
  final String food_name;
  final int cal;
  final int fat;

  Food(this.id, this.food_name, this.cal, this.fat);
  Food.fromJson(Map<String, dynamic> json)
      : id = json['id'].toString(),
        food_name = json['food_name'],
        cal = json['cal'],
        fat = json['fat'];

  Map toJson() => {'id': id, 'food_name': food_name, 'cal': cal, 'fat': fat};
}

class _MyStatefulWidgetState extends State<CalorieIntake> {
  TextEditingController foodController = TextEditingController();
  TextEditingController calorieController = TextEditingController();
  TextEditingController fatController = TextEditingController();
  bool isLoading = false;

  GlobalKey<ScaffoldState> scaffoldKey = GlobalKey();
  late ScaffoldMessengerState scaffoldMessenger;
  var token = '';
  bool isMounted = false;

  List<Food> foods_list = [];
  // Initial Selected Value
  String? dropdownvalue = 'Item 1';

  @override
  void initState() {
    if (!isMounted) {
      getName();
    }
    super.initState();
  }

  getName() async {
    setState(() {
      isLoading:
      true;
      isMounted:
      true;
    });
    SharedPreferences preferences = await SharedPreferences.getInstance();

    token = preferences.getString("token")!.toString();

    getFoods();
  }

  getFoods() async {
    final response =
        await http.post(Uri.parse(AppConstants.DOMAIN + AppConstants.FOODS_URI),
            headers: {
              'Authorization': 'Bearer $token',
              "Accept": "application/json",
            },
            encoding: Encoding.getByName("utf-8"));

    print(response.body);
    if (response.statusCode == 200) {
      Map<String, dynamic> resposnebody = jsonDecode(response.body);
      var dlists1 = Map<String, dynamic>.from(resposnebody['data']);
      var dlists = dlists1['foods'];
      dlists.forEach((dlist) {
        Food department = Food.fromJson(dlist);
        foods_list.add(department);
      });
      setState(() {
        isLoading = false;
      });
    } else {}
  }

  @override
  Widget build(BuildContext context) {
    scaffoldMessenger = ScaffoldMessenger.of(context);
    return SafeArea(
      child: Scaffold(
        drawerScrimColor: AppColors.primaryColor,
        key: scaffoldKey,
        drawer: CustomDrawer(),
        backgroundColor: kBackgroundColor,
        body: isLoading
            ? CircularProgressIndicator()
            : SingleChildScrollView(
                child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: <Widget>[
                      Padding(
                        padding: EdgeInsets.symmetric(horizontal: 30),
                        child: Row(
                          mainAxisAlignment: MainAxisAlignment.spaceBetween,
                          children: <Widget>[
                            GestureDetector(
                              child: SvgPicture.asset('assets/icons/menu.svg'),
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
                            'Calorie Intake Update',
                            style: TextStyle(fontSize: 20),
                          )),
                      Container(
                          width: 400,
                          padding: const EdgeInsets.all(10),
                          child: DropdownButtonFormField<String>(
                            isExpanded: true,
                            items: foods_list.map((Food value) {
                              return DropdownMenuItem<String>(
                                value: value.id,
                                child: Text(value.food_name),
                              );
                            }).toList(),
                            hint: Text('Select Food'),
                            onChanged: (newValue) {
                              dropdownvalue = newValue!;
                              setState(() {
                                dropdownvalue;
                              });
                            },
                            onSaved: (newValue) {
                              dropdownvalue = newValue!;
                              setState(() {
                                dropdownvalue;
                              });
                            },
                          )),
                      Container(
                          alignment: Alignment.topLeft,
                          padding: const EdgeInsets.all(10),
                          child: const Text(
                            'Quality representation equal to one quantity',
                            style: TextStyle(fontSize: 20),
                          )),
                      SizedBox(height: 10.0),
                      Row(
                          mainAxisAlignment: MainAxisAlignment.center,
                          children: [
                            ClipRRect(
                              borderRadius: BorderRadius.circular(36),
                              child: FlatButton(
                                color: mButtonColor,
                                padding: const EdgeInsets.symmetric(
                                    horizontal: 32, vertical: 12),
                                onPressed: () {
                                  if (dropdownvalue != "") {
                                    setState(() {
                                      isLoading = true;
                                    });
                                    saveFoodIntake();
                                  } else {
                                    showDialog(
                                      context: context,
                                      builder: (BuildContext context) {
                                        return AlertDialog(
                                          title: new Text("Alert!!"),
                                          content: new Text(
                                              "Please enter food intake details!"),
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
                                  style: TextStyle(
                                      fontSize: 22, color: Colors.white),
                                ),
                              ),
                            ),
                          ]),
                    ]),
              ),
      ),
    );
  }

  saveFoodIntake() async {
    Food f = foods_list.elementAt(int.parse(dropdownvalue!) - 1);
    Map data = {
      'food': f.food_name,
      'calorie': f.cal.toString(),
      'fat': f.fat.toString(),
    };
    print(token);
    print(data.toString());
    print(Uri.parse(AppConstants.DOMAIN + AppConstants.FOOD_INTAKE_URI));
    final response = await http.post(
        Uri.parse(AppConstants.DOMAIN + AppConstants.FOOD_INTAKE_URI),
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
      scaffoldMessenger.showSnackBar(
          SnackBar(content: Text("Food Intake Updated Successfully")));
      Navigator.push(
        context,
        MaterialPageRoute(
            builder: (context) => const MyHomePage(title: 'Smart Health')),
      );
      //print(" User name ${user['id']}");

    } else {
      scaffoldMessenger
          .showSnackBar(SnackBar(content: Text("Please try again!")));
    }
  }
}
