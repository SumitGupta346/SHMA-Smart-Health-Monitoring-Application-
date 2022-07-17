class AppConstants {
  static const String APP_NAME = 'SmartHealthMonitoring';
  static const String DOMAIN = 'http://10.0.2.2:8000';
  static const String REGISTER_URI = '/api/register';
  static const String LOGIN_URI = '/api/login';
  static const String FEEDBACK_URI = '/api/patient/save_feedback';
  static const String FOOD_INTAKE_URI = '/api/patient/save_food_intake';
  static const String WATER_INTAKE_URI = '/api/patient/save_water_intake';
  static const String SLEEP_HOURS_URI = '/api/patient/save_sleep_hours';
  static const String BMI_URI = '/api/patient/save_bmi';
  static const String VITALS_URI = '/api/patient/get_vitals';
  static const String PREDICT_DISEASE_URI = '/api/patient/predict_disease';
  static const String DEPARTMENT_URI = '/api/patient/get_departments';
  static const String DOCTORS_URI = '/api/patient/get_doctors';
  static const String FOODS_URI = '/api/patient/get_foods';
}
