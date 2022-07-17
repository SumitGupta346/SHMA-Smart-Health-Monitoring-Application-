import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:smarthealth/constants.dart';
import 'package:smarthealth/util/app_constants.dart';
import 'package:smarthealth/widgets/header_logo.dart';
import 'package:smarthealth/widgets/my_header.dart';
import '../widgets/text_widget.dart';
import 'home_page.dart';
import 'package:shared_preferences/shared_preferences.dart';

import 'signup_page.dart';

class LoginPage extends StatefulWidget {
  const LoginPage({Key? key}) : super(key: key);

  @override
  State<LoginPage> createState() => _MyStatefulWidgetState();
}

class _MyStatefulWidgetState extends State<LoginPage> {
  bool _isShowPassword = false;
  TextEditingController nameController = TextEditingController();
  TextEditingController passwordController = TextEditingController();
  final _formKey = GlobalKey<FormState>();
  late String email, password;
  bool isLoading = false;

  GlobalKey<ScaffoldState> _scaffoldKey = GlobalKey();
  late ScaffoldMessengerState scaffoldMessenger;

  @override
  Widget build(BuildContext context) {
    scaffoldMessenger = ScaffoldMessenger.of(context);
    return Scaffold(
      backgroundColor: kBackgroundColor,
        body: Padding(
            padding: const EdgeInsets.all(10),
            child: ListView(
              children: <Widget>[
                 MyHeader(
            height: 300,
            imageUrl: 'assets/images/doctor.png',
            child: HeaderLogo(),
          ),
                
                Container(
                    alignment: Alignment.center,
                    padding: const EdgeInsets.all(10),
                    child: const Text(
                      'Sign in',
                      style: TextStyle(fontSize: 20),
                    )),
                Container(
                  padding: const EdgeInsets.all(10),
                  child: TextField(
                    controller: nameController,
                    cursorColor: mTitleTextColor,
                    decoration: InputDecoration(
                      icon: Icon(
                        Icons.person,
                        color: mTitleTextColor,
                      ),
                      hintText: "Your Email",
                      border: InputBorder.none,
                    ),
                  ),
                ),
                Container(
                  padding: const EdgeInsets.fromLTRB(10, 10, 10, 0),
                  child:  TextField(
                    maxLength: 8,
                    controller: passwordController,
                    obscureText: _isShowPassword == false ? true : false,
                    cursorColor: mTitleTextColor,
                    decoration: InputDecoration(
                      counterText: "",
                      hintText: "Password",
                      icon: Icon(
                        Icons.lock,
                        color: mTitleTextColor,
                      ),
                      suffixIcon: InkWell(
                        onTap: () {
                          setState(() {
                            if (_isShowPassword == false)
                              _isShowPassword = true;
                            else
                              _isShowPassword = false;
                          });
                        },
                        child: Icon(
                          Icons.visibility,
                          color: mTitleTextColor,
                        ),
                      ),
                      border: InputBorder.none,
                    ),
                  ),
                ),
                SizedBox(height: 10.0),
                ClipRRect(
                    borderRadius: BorderRadius.circular(36),
                    child: FlatButton(
                      color: mButtonColor,
                      padding: const EdgeInsets.symmetric(
                          horizontal: 32, vertical: 12),
                      onPressed: () {
                        var uname = nameController.text;
                        var pwd = passwordController.text;
                        setState(() {
                          isLoading = true;
                        });
                        login(uname, pwd);
                      },
                      child: Text(
                        'Login',
                        style: TextStyle(fontSize: 22, color: Colors.white),
                      ),
                    ),
                  ),
                Spacer(),
                Row(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    Padding(padding:const EdgeInsets.fromLTRB(10, 10, 10, 0),
                    child:
                    GestureDetector(
                      onTap: () {
                        Navigator.push(
                            context,
                            MaterialPageRoute(
                                builder: (context) => const SignupPage()));
                      },
                      child: TextWidget(
                          text: "Sign up", fontSize: 16, isUnderLine: true),
                    ),
                    ),
                  ],
                )
              ],
            )));
  }

  login(email, password) async {
    Map data = {'email_or_phone': email, 'password': password};
    print(data.toString());
    print(Uri.parse(AppConstants.DOMAIN + AppConstants.LOGIN_URI));
    final response =
        await http.post(Uri.parse(AppConstants.DOMAIN + AppConstants.LOGIN_URI),
            headers: {
              "Accept": "application/json",
              "Content-Type": "application/x-www-form-urlencoded"
            },
            body: data,
            encoding: Encoding.getByName("utf-8"));
    setState(() {
      isLoading = false;
    });
    print(response.body);
    if (response.statusCode == 200) {
      Map<String, dynamic> resposnebody = jsonDecode(response.body);

      var token = resposnebody['token'];
      var user = resposnebody['user'];
      //print(" User name ${user['id']}");
      savePref(1, user['name'], user['email'], user['id'], token);
      Navigator.push(
        context,
        MaterialPageRoute(
            builder: (context) => MyHomePage(title: 'Smart Health',)),
      );
    } else {
      scaffoldMessenger
          .showSnackBar(SnackBar(content: Text("Please try again!")));
    }
  }

  savePref(int value, String name, String email, int id, String token) async {
    SharedPreferences preferences = await SharedPreferences.getInstance();

    preferences.setInt("value", value);
    preferences.setString("name", name);
    preferences.setString("email", email);
    preferences.setString("id", id.toString());
    preferences.setString("token", token);
    preferences.commit();
  }
}
