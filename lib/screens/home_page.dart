import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:flutter_svg/flutter_svg.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:smarthealth/screens/calorie_intake.dart';
import 'package:smarthealth/screens/sleep_hours.dart';
import 'package:smarthealth/screens/water_intake.dart';
import 'package:smarthealth/shared/custom_drawer.dart';

import '../home_list_item.dart';
import '../shared/app_colors.dart';
import '../shared/custom_progress_bar_indicator.dart';
import '../shared/custom_progress_value.dart';
import '../shared/custom_raised_button.dart';
import '../util/app_constants.dart';
import 'bmi.dart';
import 'package:http/http.dart' as http;

class MyHomePage extends StatefulWidget {
  const MyHomePage({Key? key, required this.title}) : super(key: key);

  // This widget is the home page of your application. It is stateful, meaning
  // that it has a State object (defined below) that contains fields that affect
  // how it looks.

  // This class is the configuration for the state. It holds the values (in this
  // case the title) provided by the parent (in this case the App widget) and
  // used by the build method of the State. Fields in a Widget subclass are
  // always marked "final".

  final String title;

  @override
  State<MyHomePage> createState() => _MyHomePageState();
}

class _MyHomePageState extends State<MyHomePage> {
  final scaffoldKey = GlobalKey<ScaffoldState>();
  var name = '';
  var token = '';
  var height = 0,
      weight = 0,
      bmi_index = 0.0,
      bmi_result = '',
      cal = 0,
      fat = 0,
      wintake = 0,
      shours = 0;
  late ScrollController _scrollController;
  var isMounted = false;

  bool _isExpanded = true;
  bool isLoading = false;

  GlobalKey<ScaffoldState> _scaffoldKey = GlobalKey();
  late ScaffoldMessengerState scaffoldMessenger;

  @override
  void initState() {
    super.initState();
    _scrollController = ScrollController()
      ..addListener(() {
        setState(() {
          _isExpanded = _scrollController.hasClients &&
              _scrollController.offset < (200.0 - kToolbarHeight - 20);
        });
      });
  }

  getName() async {
    SharedPreferences preferences = await SharedPreferences.getInstance();

    name = preferences.getString("name")!.toString();
    token = preferences.getString("token")!.toString();
    if (!isMounted) {
      setState(() {
        isMounted = true;
      });
      getvitals();
    }
  }

  getvitals() async {
    print(Uri.parse(AppConstants.DOMAIN + AppConstants.VITALS_URI));
    final response = await http.post(
        Uri.parse(AppConstants.DOMAIN + AppConstants.VITALS_URI),
        headers: {
          'Authorization': 'Bearer $token',
          "Accept": "application/json",
        },
        encoding: Encoding.getByName("utf-8"));
    setState(() {
      isLoading = false;
    });
    print(response.body);
    if (response.statusCode == 200) {
      Map<String, dynamic> resposnebody = jsonDecode(response.body);
      var data = resposnebody['data'];
      setState(() {
        height = data['height'];
        weight = data['weight'];
        bmi_index = data['bmi'];
        bmi_result = data['bmi_result'];
        wintake = data['water_intake'];
        shours = data['sleep_hours'];
        cal = data['cal'];
        fat = data['fat'];
      });
    } else {
      scaffoldMessenger
          .showSnackBar(SnackBar(content: Text("Please try again Vitals!")));
    }
  }

  @override
  Widget build(BuildContext context) {
    scaffoldMessenger = ScaffoldMessenger.of(context);
    getName();
    final List<Widget> _items = [
      HomeListItem(
        title:
            'BMI- Height:' + height.toString() + ' Weight:' + weight.toString(),
        iconPath: 'assets/icons/calorie.png',
        rightTopWidget: Text('BMI:' + bmi_index.toString()),
        leftBottomWidget: Text('BMI Result:' + bmi_result),
        rightBottomWidget: CustomRaisedButton(
          title: 'Edit',
          onTap: () {
            Navigator.push(
              context,
              MaterialPageRoute(builder: (context) => BMI()),
            );
          },
        ),
      ),
      HomeListItem(
        title: 'Calorie',
        iconPath: 'assets/icons/calorie.png',
        rightTopWidget: cal.toInt() > 1800
            ? CustomProgressIndicator((1800 / 1800))
            : CustomProgressIndicator((cal.toInt() / 1800)),
        leftBottomWidget: CustomProgressValue(
          title: 'Cal',
          totalPart: 1800,
          completedPart: cal.toInt() > 1800 ? 1800 : cal.toInt(),
        ),
        rightBottomWidget: CustomRaisedButton(
          title: 'Add',
          onTap: () {
            Navigator.push(
              context,
              MaterialPageRoute(builder: (context) => CalorieIntake()),
            );
          },
        ),
      ),
      HomeListItem(
        title: 'Water',
        iconPath: 'assets/icons/water_drop.png',
        rightTopWidget: wintake > 12
            ? CustomProgressIndicator(12 / 12)
            : CustomProgressIndicator(wintake / 12),
        leftBottomWidget: CustomProgressValue(
          title: 'glasses',
          totalPart: 12,
          completedPart: wintake > 12 ? 12 : wintake,
        ),
        rightBottomWidget: CustomRaisedButton(
          title: 'Edit',
          onTap: () {
            Navigator.push(
              context,
              MaterialPageRoute(builder: (context) => WaterIntake()),
            );
          },
        ),
      ),
      HomeListItem(
        title: 'Sleep',
        iconPath: 'assets/icons/moon.png',
        rightTopWidget: shours > 8
            ? CustomProgressIndicator(8 / 8)
            : CustomProgressIndicator(shours / 8),
        leftBottomWidget: CustomProgressValue(
          title: 'hours',
          totalPart: 8,
          completedPart: shours > 8 ? 8 : shours,
        ),
        rightBottomWidget: CustomRaisedButton(
          title: 'Edit',
          onTap: () {
            Navigator.push(
              context,
              MaterialPageRoute(builder: (context) => SleepHours()),
            );
          },
        ),
      ),
    ];
    // This method is rerun every time setState is called, for instance as done
    // by the _incrementCounter method above.
    //
    // The Flutter framework has been optimized to make rerunning build methods
    // fast, so that you can just rebuild anything that needs updating rather
    // than having to individually change instances of widgets.
    return SafeArea(
      child: Scaffold(
        drawerScrimColor: AppColors.primaryColor,
        key: scaffoldKey,
        drawer: CustomDrawer(),
        body: CustomScrollView(
          controller: _scrollController,
          slivers: [
            SliverAppBar(
              pinned: true,
              backgroundColor: AppColors.primaryColor,
              elevation: 0,
              leading: IconButton(
                padding: const EdgeInsets.symmetric(horizontal: 32),
                icon: Icon(
                  Icons.menu,
                  color: _isExpanded ? Colors.white : Colors.black,
                ),
                onPressed: () {
                  scaffoldKey.currentState?.openDrawer();
                },
              ),
              actions: [],
              expandedHeight: 200,
              flexibleSpace: FlexibleSpaceBar(
                title: FittedBox(
                  child: Padding(
                    padding: const EdgeInsets.only(right: 16.0),
                    child: Text(
                      _isExpanded
                          ? 'Hello ' + name + ', \n'
                          : 'Hello ' + name + ', ',
                      style: Theme.of(context).textTheme.bodyText1?.copyWith(
                            color: _isExpanded ? Colors.white : Colors.black,
                            fontWeight: _isExpanded
                                ? FontWeight.w600
                                : FontWeight.normal,
                          ),
                    ),
                  ),
                ),
                collapseMode: CollapseMode.parallax,
                background: Image.asset(
                  'assets/images/welcome.png',
                  fit: BoxFit.cover,
                ),
              ),
            ),
            SliverList(
              delegate: SliverChildBuilderDelegate(
                (context, i) => _items[i],
                childCount: _items.length,
              ),
            ),
            SliverFillRemaining(),
          ],
        ),
      ),
    );
  }
}
