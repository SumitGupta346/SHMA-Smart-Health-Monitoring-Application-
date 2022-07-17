import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:flutter_svg/svg.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:smarthealth/components/category_card.dart';
import 'package:smarthealth/components/doctor_card.dart';
import 'package:smarthealth/components/search_bar.dart';
import 'package:smarthealth/constants.dart';
import 'package:smarthealth/shared/app_colors.dart';
import 'package:smarthealth/shared/custom_drawer.dart';
import 'package:smarthealth/util/app_constants.dart';
import 'package:http/http.dart' as http;

class SearchDoctors extends StatefulWidget {
  const SearchDoctors({Key? key}) : super(key: key);

  @override
  State<SearchDoctors> createState() => _MyStatefulWidgetState();
}

class Department {
  final int id;
  final String department;

  Department(this.id, this.department);
  Department.fromJson(Map<String, dynamic> json)
      : id = json['id'],
        department = json['department'];
  Map toJson() => {'id': id, 'department': department};
}

class Doctor {
  final int id;
  final String name;
  final String email;
  final String image;
  final String address;
  final String phone_number;
  final String education;
  final String department;

  Doctor(this.id, this.name, this.email, this.image, this.address,
      this.phone_number, this.education, this.department);
  Doctor.fromJson(Map<String, dynamic> json)
      : id = json['id'],
        name = json['name'],
        email = json['email'],
        image = json['image'],
        address = json['address'],
        phone_number = json['phone_number'],
        education = json['education'],
        department = json['department'];
  Map toJson() => {
        'id': id,
        'name': name,
        'email': email,
        'image': image,
        'address': address,
        'phone_number': phone_number,
        'education': education,
        'department': department
      };
}

class _MyStatefulWidgetState extends State<SearchDoctors> {
  final scaffoldKey = GlobalKey<ScaffoldState>();
  var token = '';
  bool isMounted = false;

  List<Department> departments_list = [];
  List<Doctor> doctors_list = [];

  bool isLoading = false;
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
    });
    SharedPreferences preferences = await SharedPreferences.getInstance();

    token = preferences.getString("token")!.toString();

    getDepartments();
  }

  getDepartments() async {
    final response = await http.post(
        Uri.parse(AppConstants.DOMAIN + AppConstants.DEPARTMENT_URI),
        headers: {
          'Authorization': 'Bearer $token',
          "Accept": "application/json",
        },
        encoding: Encoding.getByName("utf-8"));

    print(response.body);
    if (response.statusCode == 200) {
      Map<String, dynamic> resposnebody = jsonDecode(response.body);
      var dlists1 = Map<String, dynamic>.from(resposnebody['data']);
      var dlists = dlists1['departments'];
      dlists.forEach((dlist) {
        Department department = Department.fromJson(dlist);
        departments_list.add(department);
      });
      getDoctors();
    } else {}
  }

  getDoctors() async {
    final response = await http.post(
        Uri.parse(AppConstants.DOMAIN + AppConstants.DOCTORS_URI),
        headers: {
          'Authorization': 'Bearer $token',
          "Accept": "application/json",
        },
        encoding: Encoding.getByName("utf-8"));

    print(response.body);
    if (response.statusCode == 200) {
      Map<String, dynamic> resposnebody = jsonDecode(response.body);
      var dlists1 = Map<String, dynamic>.from(resposnebody['data']);
      var dlists = dlists1['doctors'];
      dlists.forEach((dlist) {
        Doctor doctor = Doctor.fromJson(dlist);
        doctors_list.add(doctor);
      });
      setState(() {
        isLoading:
        false;
        isMounted:
        true;
      });
    } else {}
  }

  @override
  Widget build(BuildContext context) {
    return SafeArea(
      child: Scaffold(
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
                    GestureDetector(
                      child: SvgPicture.asset('assets/icons/menu.svg'),
                      onTap: () {
                        scaffoldKey.currentState?.openDrawer();
                      },
                    ),
                  ],
                ),
              ),
              SizedBox(
                height: 50,
              ),
              Padding(
                padding: EdgeInsets.symmetric(horizontal: 30),
                child: Text(
                  'Find Your Desired\nDoctor',
                  style: TextStyle(
                    fontWeight: FontWeight.bold,
                    fontSize: 32,
                    color: kTitleTextColor,
                  ),
                ),
              ),
              SizedBox(
                height: 30,
              ),
              Padding(
                padding: const EdgeInsets.symmetric(horizontal: 30),
                child: Text(
                  'Doctors',
                  style: TextStyle(
                    fontWeight: FontWeight.bold,
                    color: kTitleTextColor,
                    fontSize: 18,
                  ),
                ),
              ),
              SizedBox(
                height: 20,
              ),
              isLoading
                  ? Container(
                      child: Text('Loading...'),
                    )
                  : ListView.builder(
                      itemBuilder: (BuildContext context, index) {
                        Doctor doctor = doctors_list.elementAt(index);
                        return DoctorCard(
                          doctor.id,
                          doctor.name,
                          doctor.department,
                          doctor.address,
                          doctor.email,
                          doctor.phone_number,
                          'assets/images/doctor2.png',
                          kYellowColor,
                        );
                      },
                      itemCount: doctors_list.length,
                      shrinkWrap: true,
                      padding: const EdgeInsets.all(5),
                      scrollDirection: Axis.vertical,
                    ),
            ],
          ),
        ),
      ),
    );
  }
}
