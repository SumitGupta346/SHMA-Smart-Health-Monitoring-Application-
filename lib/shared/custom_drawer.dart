import 'package:flutter/material.dart';
import 'package:smarthealth/screens/feedback.dart';
import 'package:smarthealth/screens/home_page.dart';
import 'package:smarthealth/screens/search_doctors_screen.dart';
import 'package:smarthealth/screens/symptoms_input.dart';
import 'package:smarthealth/screens/web_view.dart';
import 'package:smarthealth/screens/feedback.dart';

import '../screens/login_page.dart';

/// builds drawer of [Handy]
class CustomDrawer extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Drawer(
      child: Container(
        child: SingleChildScrollView(
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: <Widget>[
              Row(
                mainAxisAlignment: MainAxisAlignment.end,
                children: <Widget>[
                  IconButton(
                    icon: const Icon(Icons.close),
                    onPressed: () => Navigator.of(context).pop(),
                  ),
                ],
              ),
              const SizedBox(
                height: 20,
              ),
              ListTile(
                leading: const Icon(Icons.home),
                title: const Text('Home'),
                onTap: () {
                  Navigator.push(
                      context,
                      MaterialPageRoute(
                          builder: (context) =>
                              const MyHomePage(title: 'Smart Health')));
                },
              ),
              ListTile(
                leading: Icon(Icons.health_and_safety),
                title: Text('Feedback'),
                onTap: () {
                  Navigator.push(
                      context,
                      MaterialPageRoute(
                          builder: (context) => const FeedbackMessage()));
                },
              ),
              ListTile(
                leading: Icon(Icons.health_and_safety),
                title: Text('Health Checkup'),
                onTap: () {
                  Navigator.push(
                      context,
                      MaterialPageRoute(
                          builder: (context) => const WebViewExample()));
                },
              ),
              ListTile(
                leading: Icon(Icons.search),
                title: Text('Find doctors'),
                onTap: () {
                  Navigator.push(
                      context,
                      MaterialPageRoute(
                          builder: (context) => const SearchDoctors()));
                },
              ),
              SizedBox(
                height: 15,
              ),
              ListTile(
                  leading: Icon(Icons.logout),
                  title: Text('Sign out'),
                  onTap: () async {
                    await showDialog(
                      context: context,
                      builder: (_) => AlertDialog(
                        title: Text('Sign out of Smart Health?'),
                        content: Text('Do you want to sign out?'),
                        actions: <Widget>[
                          FlatButton(
                            child: Text('No'),
                            onPressed: () => Navigator.of(context).pop(),
                          ),
                          FlatButton(
                              child: Text('Yes'),
                              onPressed: () {
                                Navigator.push(
                                  context,
                                  MaterialPageRoute(
                                      builder: (context) => LoginPage()),
                                );
                              }),
                        ],
                      ),
                      barrierDismissible: false,
                    );
                  }),
            ],
          ),
        ),
      ),
    );
  }
}
