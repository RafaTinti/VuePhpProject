# VuePhpProject
Hello,
This project was developed with Vue and PHP. Both frontend and backend are in this repository in the respective folders. 

Thank you for your time evaluating project. 
## Setup
- Backend: The backend was done in vanilla PHP and XAMPP. All it requires is to run "composer install" on the backend folder to install the dependencies (PHPUnit). If using XAMPP clone this project in the xampp/htdocs and enable the Apache module in XAMPP's controll panel.
- Database: This project was made using MySQL. All database configuration is in the Database.php file in the config folder. The following SQL can be used to create the table and add a dummy entry.
```sql
CREATE TABLE customer(
    ID int AUTO_INCREMENT NOT NULL,
    FirstName VARCHAR(255) NOT NULL,
    LastName VARCHAR(255) NOT NULL,
    DateOfBirth DATE NOT NULL,
    Username VARCHAR(255) NOT NULL,
    Password VARCHAR(255) NOT NULL,
    PRIMARY KEY(ID)
);
INSERT INTO customer (FirstName, LastName, DateOfBirth, Username, Password)
VALUES ("John", "Doe", "1992-05-14", "User", "Pass");
```
- Frontend : In the frontend folder run "npm install" and "npm run dev" and access http://localhost:5173/ to try the app.

## Tests
I wrote a couple tests for the api. Mostly testing if the read functions are working. They should pass as long as there is a least one entry on the customer table.

To run the test simply run the command "composer test" on the backend folder. 
