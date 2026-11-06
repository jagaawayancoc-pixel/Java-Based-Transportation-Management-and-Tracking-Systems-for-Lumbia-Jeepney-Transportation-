TRANSEAT MANAGEMENT SYSTEM - XAMPP WEB VERSION

1. Copy this entire TranSeatManagementSystem folder to:
   C:\xampp\htdocs\TranSeatManagementSystem

2. Start Apache and MySQL in XAMPP Control Panel.

3. Open phpMyAdmin:
   http://localhost/phpmyadmin/

4. Click Import and select:
   C:\xampp\htdocs\TranSeatManagementSystem\db.sql

   The script creates database: transeat_db

5. Open:
   http://localhost/TranSeatManagementSystem/

LOGIN
Admin:
  Name: admin123
  User: Admin
  Secret Password: ADMINadmin123123

Passenger:
  User: Passenger
  Name can be any name; no password is required.

Driver:
  The Admin must first add the driver in Driver Management.
  Driver Name = the Name used on the login page.
  Driver ID = the Secret Password used on the login page.

DATABASE
- admins: administrator accounts
- drivers: driver ID, name, plate and archive status
- departures: route, departure time, current stop, availability and round trips
- earnings: current total earnings per driver
- earning_transactions: earnings and penalty history

IMPORTANT
This web version uses PHP + MySQL/PDO. The original Java Swing screens are retained in src/.
The Java Swing application does not automatically use the PHP database. JDBC integration can be added separately if you want the Swing application and this web application to share the same MySQL database.
