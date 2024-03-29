import 'package:smarthealth/constants.dart';
//import 'package:smarthealth/screens/detail_screen.dart';
import 'package:flutter/material.dart';
import 'package:smarthealth/screens/detail_screen.dart';

class DoctorCard extends StatelessWidget {
  var _id;
  var _name;
  var _description;
  var _address;
  var _email;
  var _phone_number;
  var _imageUrl;
  var _bgColor;

  DoctorCard(this._id,this._name, this._description,this._address, this._email, this._phone_number, this._imageUrl, this._bgColor);

  @override
  Widget build(BuildContext context) {
    return InkWell(
      onTap: () {
        Navigator.push(
          context,
          MaterialPageRoute(
            builder: (context) => DetailScreen(this._id,this._name, this._description, this._address , this._email, this._phone_number, this._imageUrl),
          ),
        );
      },
      child: DecoratedBox(
        decoration: BoxDecoration(
          color: _bgColor.withOpacity(0.1),
          borderRadius: BorderRadius.circular(10),
        ),
        child: Padding(
          padding: EdgeInsets.all(10),
          child: ListTile(
            leading: Image.asset(_imageUrl),
            title: Text(
              _name,
              style: TextStyle(
                color: kTitleTextColor,
                fontWeight: FontWeight.bold,
              ),
            ),
            subtitle: Text(
              _description,
              style: TextStyle(
                color: kTitleTextColor.withOpacity(0.7),
              ),
            ),
          ),
        ),
      ),
    );
  }
}
