# TaskFlow

TaskFlow is a simple web-based task management application developed as a learning project for object-oriented programming in PHP.

## 🚀 Project Overview

TaskFlow allows users to create, manage, and track tasks, including specific task types like bugs and features. This project demonstrates the use of OOP concepts such as encapsulation and inheritance in a practical web application context.

## 🌟 Features

- Create basic tasks
- Create specific task types (Bug, Feature)
- Change task status
- Assign tasks to users
- View tasks by user

## 🛠️ Technologies Used

- PHP 7.4+ (100%)
- HTML/CSS for basic interface

## 📁 Project Structure

- `bugClass.php`: Class definition for Bug tasks
- `create-task.php`: Task creation logic
- `database.php`: Database connection and operations
- `details.php`: Task details display
- `featureClass.php`: Class definition for Feature tasks
- `process.php`: Task processing logic
- `register.php`: User registration
- `taskClass.php`: Base Task class definition
- `tasks.php`: Task listing and management
- `user.php`: User management

## 📊 UML Class Diagram

See `TaskFlowDiagramme.png` in the repository for the class structure visualization.

## 🚀 Getting Started

1. Clone the repository:
git clone [https://github.com/B4drEddine0/TaskFlow.git](https://github.com/B4drEddine0/TaskFlow.git)
2. Set up a local PHP server or use XAMPP/WAMP
3. Import the database structure from `database.sql`
4. Configure database connection in `database.php`
5. Access the application through your local server

## 👤 User Stories

- Create a simple task
- Create a bug or feature task
- Change task status
- View assigned tasks

## 👨‍💻 Developer Notes

- Encapsulation is used with private properties and getter/setter methods
- Inheritance is implemented for specific task types (Bug, Feature)
- Data validation is performed on input
- Basic documentation is provided in the code

## 🤝 Contributing

This is a learning project, but suggestions and improvements are welcome. Please open an issue or submit a pull request.

## 📝 License

This project is open-source and available under the MIT License.

---

Developed by Badr Eddine Massa Al Khayr as part of a PHP OOP learning project.
