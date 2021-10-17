
# Employeement Management System

Management system is to maintain and arrange the data
of employees and to handle the data. There are Sign 
up page for admin where user signup himself and there 
is login page as well, where user can login and then 
employee page appears where user can view data and 
manage it as well. When admin needs to fetch data 
from database it can fetch whenever it required.This 
report includes a development presentation of an 
information system for managing the staff data within 
a small company or organization. The system as such as 
it has been developed is called Employee Management 
System. It consists of functionally related to managing 
employees and database. The choice of the programming
tools is individual and particular.


## Contributing

Everyone had there tasks related to the prject and they
did it very well. Team leader assign task to every Team
member and each and every person did tere best and made
a vital role in accomplishing the task.

  
## Documentation

## TOOLS:
	XAMPP
	Visual Studio Code
	Postman
	Git Hub
	MySQL


## SIGNUP:
 When user needs to sign up the page first, he fills the 
 basic requirements and user become registered.
  
    Class: connection
    functions:
 +test_inputs($data)
 +test_email($email)
 +signup()
 +useralreadyexists()
 +displayresponse($response)

## LOG_IN:
 When user get register after it, he will be able to 
 login to the EMS.

 Class : login
 METHOD: login()

## FORGET_PASSWORD:
 It’s the most important part of login process when 
 user forgot password it presses on “forget password”
 button, he will be redirecting to the next page where
 he can enter new password. 

 Classs : forget
 Method :chkPass()

## ADD_EMPLOYEE:
 User can add employees by entering their full name, 
 Email, Designation.

 Class Name: Employee
 Methods:
 function __construct($db)
 Data_Security($data)
 Add_Employee()

## LISTING:
 When user login or signup all tables and data appear 
 in front of it.

 Class name: readAll
 Method name: employeeListing()

## SEARCHING:
 When user needs to find specific employee than he 
 can enter the data gets the required results.

Class Name: search 
Method Name: find()


