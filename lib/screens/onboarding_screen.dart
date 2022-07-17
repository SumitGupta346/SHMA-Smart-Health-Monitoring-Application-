import 'package:flutter/material.dart';
import 'package:smarthealth/constants.dart';
import 'package:smarthealth/screens/login_page.dart';
import 'package:smarthealth/widgets/header_logo.dart';
import 'package:smarthealth/widgets/my_header.dart';


class OnboardingScreen extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Column(
        children: <Widget>[
          MyHeader(
            height: 535,
            imageUrl: 'assets/images/doctor.png',
            child: HeaderLogo(),
          ),
          Expanded(
            child: Container(
              width: double.infinity,
              decoration: BoxDecoration(
                gradient: LinearGradient(
                  colors: [mBackgroundColor, mSecondBackgroundColor],
                  begin: Alignment.topCenter,
                  end: Alignment.bottomCenter,
                ),
              ),
              child: Column(
                children: <Widget>[
                  Text(
                    'Smart Health Monitoring',
                    style: TextStyle(
                        fontSize: 32,
                        color: mTitleTextColor,
                        fontWeight: FontWeight.w500),
                  ),
                  SizedBox(
                    height: 32,
                  ),
                  Text(
                    'Health is Wealth \n'
                    'Smart way to Manage your health',
                    textAlign: TextAlign.center,
                    style: TextStyle(color: mTitleTextColor),
                  ),
                  Spacer(),
                  ClipRRect(
                    borderRadius: BorderRadius.circular(36),
                    child: FlatButton(
                      color: mButtonColor,
                      padding: const EdgeInsets.symmetric(
                          horizontal: 32, vertical: 12),
                      onPressed: () {
                        Navigator.push(
                          context,
                          MaterialPageRoute(
                            builder: (context) {
                              return LoginPage();
                            },
                          ),
                        );
                      },
                      child: Text(
                        'Get Started Now',
                        style: TextStyle(fontSize: 22, color: Colors.white),
                      ),
                    ),
                  ),
                  Spacer(),
                ],
              ),
            ),
          )
        ],
      ),
    );
  }
}
