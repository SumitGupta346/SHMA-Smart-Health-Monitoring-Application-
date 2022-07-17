import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:cloud_firestore/cloud_firestore.dart';
import 'package:flutter_svg/flutter_svg.dart';
import 'package:smarthealth/constants.dart';
import 'package:smarthealth/shared/app_colors.dart';
import 'package:smarthealth/shared/custom_drawer.dart';
import 'package:smarthealth/widgets/my_header.dart';

//predictedDisease.dart: Defines a Stateful widget gives a probabilistic match of diseases
// which matches best with given input symptoms list. Fetches symptom data for each disease from cloud firestore
// and matches it from the list got from symptomsInput.dart for a probabilistic match.

class PredictDisease extends StatefulWidget {
  final Map<String, dynamic> diseases;
  
  PredictDisease({required this.diseases});
  @override
  _PredictDiseaseState createState() => _PredictDiseaseState();
}

class Disease {
  final int count;
  final String disease_name;
  final String prob;

  Disease(this.count, this.disease_name,this.prob);
  Disease.fromJson(Map<String, dynamic> json)
      : count = json['count'],
        disease_name = json['disease_name'],
        prob = json['prob'];
  Map toJson() => {
        'count': count,
        'disease_name': disease_name,
        'prob':prob
      };
}

class _PredictDiseaseState extends State<PredictDisease> {
  GlobalKey<ScaffoldState> scaffoldKey = GlobalKey();
List<Disease> d_lists=[];
  Map<String , int> priorityMap = {};
  @override
  Widget build(BuildContext context) {
    var dList = Map<String,dynamic>.from(widget.diseases['data']);
    dList.forEach((key, value) { 
      Disease d_list = Disease.fromJson(value);
        d_lists.add(d_list);
    });
    
    print(dList);
    
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
                      'Predicted Disease',
                      style: TextStyle(fontSize: 20),
                    )),
          ListView.builder(
        itemBuilder: (BuildContext, index){
           Disease d = d_lists.elementAt(index);
         // print(disease);
         
          return Card(
            child: ListTile(
              title: Text(d.disease_name),
              subtitle: Text(d.prob),
            ),
          );
        },
        itemCount: d_lists.length,
        shrinkWrap: true,
        padding: EdgeInsets.all(5),
        scrollDirection: Axis.vertical,
      )
            ]
          ),
      ),
    
      ),
    );
  }
}
