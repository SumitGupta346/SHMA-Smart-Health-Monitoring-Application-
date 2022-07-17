import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:flutter_svg/svg.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:smarthealth/constants.dart';
import 'package:smarthealth/screens/predictedDisease.dart';
import 'package:smarthealth/shared/app_colors.dart';
import 'package:smarthealth/shared/custom_drawer.dart';
import 'package:smarthealth/util/app_constants.dart';
import 'package:smarthealth/widgets/my_header.dart';
import 'package:http/http.dart' as http;


//symptomsInput.dart: Defines a Stateful Widget which takes the input of symptoms of the user and displays them in a form of list containing tiles.

class SymptomsInput extends StatefulWidget {
  @override
  _SymptomsInputState createState() => _SymptomsInputState();
}

class _SymptomsInputState extends State<SymptomsInput> {
  late ScaffoldMessengerState scaffoldMessenger;
  var token = '';
  bool isLoading = false;
  List<String> patientSymptoms = [];
  String? symptom;
GlobalKey<ScaffoldState> scaffoldKey = GlobalKey();

  List<Widget> convertToTile(List<String> symptomStrings) {
    List<Widget> symptomTile = [];
    for (int i = 0 ; i < symptomStrings.length ; ++i){
      symptomTile.add(
        Card(
          elevation: 2.5,
          child: ListTile(
            trailing: IconButton(
              icon: const Icon(
                Icons.timer,
                color:Colors.white,
                ),
              onPressed: () {
                setState(() {
                  symptomStrings.remove(symptomStrings[i]);
                });
              },
            ),
            title: Text(
              symptomStrings[i],
              style: TextStyle(
                fontWeight: FontWeight.w500,
                fontSize: 20.5,
              ),
            ),
          ),
        )
      );
      symptomTile.add(
        SizedBox(
          height: 3,
        )
      );
    }
    symptomTile.add(
        FlatButton(
          onPressed: () {
           predictDisease();
          },
          child: Container(
            width: 230,
            height: 45,
            child: Padding(
              padding: const EdgeInsets.all(8.0),
              child: Text(
                "Predict Disease",
                style: TextStyle(
                    color: Colors.white,
                    fontSize: 22.5,
                    fontWeight: FontWeight.w500
                ),
                textAlign: TextAlign.center,
              ),
            ),
            decoration: BoxDecoration(
              borderRadius: BorderRadius.circular(26.0),
              color: const Color(0xff3f9bfc),
              border: Border.all(width: 1.0, color: const Color(0xff3f9bfc)),
            ),
          ),
        )
    );
    return symptomTile;
  }
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
      Padding(
      padding: const EdgeInsets.all(20.0),
      child: ListView(
        shrinkWrap: true,
        children: [
          Text(
            "Add Symptoms",
            style: TextStyle(
              fontWeight: FontWeight.w600,
              fontSize: 30,
            ),
            textAlign: TextAlign.left,
          ),
          SizedBox(height: 20,),
          ListTile(
            title: TextField(
              onChanged: (value) {
                setState(() {
                  symptom = value;
                });
              },
              decoration: InputDecoration(
                hintText: "What are you feeling",
                border: OutlineInputBorder(
                  borderRadius: BorderRadius.all(Radius.circular(17.5)),
                  borderSide: BorderSide(color: Color(0xFFD60000) , width: 1),
                ),
                enabledBorder: OutlineInputBorder(
                  borderSide: BorderSide(color: Color(0xFFD60000), width: 1.0),
                  borderRadius: BorderRadius.all(Radius.circular(17.5)),
                ),
                focusedBorder: OutlineInputBorder(
                  borderSide: BorderSide(color: Color(0xFFD60000), width: 2.0),
                  borderRadius: BorderRadius.all(Radius.circular(17.5)),
                ),
              ),
            ),
            trailing: IconButton(
                icon: Icon(color: Colors.white,
                Icons.plus_one),
                onPressed: () {
                  if(symptom != null && symptom!.length != 0) {
                    setState(() {
                      patientSymptoms.add(symptom!);
                      symptom = null;
                    });
                  }
                  else {
                    print("No symptom added");
                  }
                },),
          ),
          SizedBox(height: 25,),
          patientSymptoms.length != 0 ? Column(
            children: convertToTile(patientSymptoms),
          ) : Column(
            mainAxisAlignment: MainAxisAlignment.spaceEvenly,
            children: [
              Text(
                "🎉🎉🎉",
                style: TextStyle(
                  fontSize: 40
                ),
              ),
              SizedBox(height: 15,),
              Text(
                "You're all fit 🙂",
                style: TextStyle(
                    fontSize: 40
                ),
              ),
            ],
          ),
        ],
      ),
      ),
            ],
          ),
      ),
      ),
    );
  }

  predictDisease() async {
    var psymptoms = [];
    patientSymptoms.forEach((ps) {
      psymptoms.add(ps.toString());
    });
    Map<String, dynamic> data = {
      "symptoms": psymptoms,
    };
    String jsonBody = json.encode(data);
    final response =
        await http.post(Uri.parse(AppConstants.DOMAIN + AppConstants.PREDICT_DISEASE_URI),
            headers: {
              'Authorization': 'Bearer $token',
              "Accept": "application/json",
              'Content-Type': 'application/json'
            },
            body: jsonBody,
            encoding: Encoding.getByName("utf-8"));
    setState(() {
      isLoading = false;
    });
    print(response.body);
    if (response.statusCode == 200) {
      Map<String, dynamic> resposnebody = jsonDecode(response.body);
      var diseasesData = resposnebody['data'];
      
     Navigator.push(
              context,
              MaterialPageRoute(builder: (context) => PredictDisease(diseases:resposnebody)),
            );
      //print(" User name ${user['id']}");

    } else {
      scaffoldMessenger
          .showSnackBar(SnackBar(content: Text("Please try again!")));
    }
  }

}
