# User-Management-System


This project implements a basic user management system using PHP and a MySQL database. The system allows you to perform CRUD (Create, Read, Update, Delete)
operations on user records. The project is structured using Object-Oriented Programming (OOP) principles.

## Table of Contents
1. User Class
2. Database Class
3. UserManagement Class
4. Functionalities

 ## User Class
 The User class represents user details. It has properties for id, username, email, and role.
 The class provides getter and setter methods for these properties. It also includes a constructor to initialize user objects.

 ## Database Class
 The Database class handles the database connection and execution of SQL queries. It is designed to provide a clean interface for interacting with the database.
 The class includes methods like query, execute, and more. Prepared statements are used for improved security.

## UserManagement Class
The UserManagement class acts as the primary interface for managing users. It uses the Database class to perform CRUD operations on user records.
The class provides methods for adding, retrieving, updating, and deleting user information.

## Functionalities
1. Adding a new user: You can provide a username, email, and role to create a new user record.
2. Retrieving user information: You can retrieve user details by providing the user's id.
3. Updating user information: Users' details like username, email, and role can be updated.
4. Deleting a user: Users can be deleted by specifying their id.

  ## Bonus Features
  
1. Input validation and error handling for the CRUD operations.
2. Role-Based Access Control: Users can have different roles (e.g., admin, regular user). Certain operations can be restricted based on roles.
