import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:smarthealth/constants.dart';
import 'package:smarthealth/screens/login_page.dart';
import 'package:smarthealth/util/app_constants.dart';
import 'package:smarthealth/widgets/header_logo.dart';
import 'package:smarthealth/widgets/my_header.dart';
import '../widgets/text_widget.dart';
import 'home_page.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:gender_picker/source/enums.dart';
import 'package:gender_picker/source/gender_picker.dart';

class SignupPage extends StatefulWidget {
  const SignupPage({Key? key}) : super(key: key);

  @override
  State<SignupPage> createState() => _MyStatefulWidgetState();
}

class _MyStatefulWidgetState extends State<SignupPage> {
  TextEditingController nameController = TextEditingController();
  TextEditingController genderController = TextEditingController();
  TextEditingController passwordController = TextEditingController();
  TextEditingController emailController = TextEditingController();
  TextEditingController mobileController = TextEditingController();
  final _formKey = GlobalKey<FormState>();
  late String email, password, gender, name, mobile;
  bool isLoading = false;

bool _isShowPassword = false;

  GlobalKey<ScaffoldState> _scaffoldKey = GlobalKey();
  late ScaffoldMessengerState scaffoldMessenger;

  @override
  Widget build(BuildContext context) {
    scaffoldMessenger = ScaffoldMessenger.of(context);
    return Scaffold(
        body: Padding(
            padding: const EdgeInsets.all(10),
            child: ListView(
              children: <Widget>[
                 MyHeader(
            height: 100,
            imageUrl: 'assets/images/welcome.png',
            child: HeaderLogo(),
          ),
                
                Container(
                    alignment: Alignment.center,
                    padding: const EdgeInsets.all(10),
                    child: const Text(
                      'Sign Up',
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
                      hintText: "Name",
                      border: InputBorder.none,
                    ),
                  ),
                ),
                GenderPickerWithImage(
              showOtherGender: false,
              verticalAlignedText: false,
              selectedGender: Gender.Male,
              selectedGenderTextStyle: TextStyle(
                  color: Color(0xFF8b32a8), fontWeight: FontWeight.bold),
              unSelectedGenderTextStyle: TextStyle(
                  color: Colors.white, fontWeight: FontWeight.normal),
              onChanged: (Gender? gender) {
                if(gender == Gender.Male)
                {
                  genderController.text = 'Male';
                }
                else if(gender == Gender.Female)
                {
                  genderController.text = 'Female';
                }
              
              },
              equallyAligned: true,
              animationDuration: Duration(milliseconds: 300),
              isCircular: true,
              // default : true,
              opacityOfGradient: 0.4,
              padding: const EdgeInsets.all(3),
              size: 50, //default : 40
            ),
              
                Container(
                  padding: const EdgeInsets.all(10),
                  child: TextField(
                    controller: emailController,
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
                  padding: const EdgeInsets.all(10),
                  child: TextField(
                    controller: mobileController,
                    cursorColor: mTitleTextColor,
                    decoration: InputDecoration(
                      icon: Icon(
                        Icons.phone,
                        color: mTitleTextColor,
                      ),
                      hintText: "Your Mobile Number",
                      border: InputBorder.none,
                    ),
                  ),
                ),
                Container(
                  padding: const EdgeInsets.fromLTRB(10, 10, 10, 0),
                  child: TextField(
                    maxLength: 8,
                    controller: passwordController,
                    obscureText: _isShowPassword == false ? true : false,
                    cursorColor: mTitleTextColor,
                    decoration: InputDecoration(
                      hintText: "Password",
                      counterText: "",
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
                        var name = nameController.text;
                        var gender = genderController.text;
                        var pwd = passwordController.text;
                        var email = emailController.text;
                        var mobile = mobileController.text;
                        setState(() {
                          isLoading = true;
                        });
                        register(name, gender, email, mobile, pwd);
                      },
                      child: Text(
                        'Register',
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
                                builder: (context) => const LoginPage()));
                      },
                      child: TextWidget(
                          text: "Sign In", fontSize: 16, isUnderLine: true),
                    ),
                    ),
                  ],
                )
              ],
            )));
  }

  register(name, gender, email, mobile, password) async {
    Map data = {
      'name': name,
      'gender': gender,
      'email': email,
      'phone_number': mobile,
      'password': password
    };
    print(data.toString());
    print(Uri.parse(AppConstants.DOMAIN + AppConstants.REGISTER_URI));
    final response = await http.post(
        Uri.parse(AppConstants.DOMAIN + AppConstants.REGISTER_URI),
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
            builder: (context) => const MyHomePage(title: 'Smart Health')),
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
