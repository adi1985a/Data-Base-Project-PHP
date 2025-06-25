# 👥📊 PHP MySQL User Management System ⚙️
_A modern, responsive PHP web application for comprehensive user management with advanced database views, audit system, and dynamic view creation using PDO for secure connections._

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![PHP](https://img.shields.io/badge/PHP-%3E%3D7.4-777BB4.svg?logo=php)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1.svg?logo=mysql)](https://www.mysql.com/)
[![PDO](https://img.shields.io/badge/PDO-PHP%20Data%20Objects-8892BF.svg)]()
[![Responsive](https://img.shields.io/badge/Responsive-Design-00D4AA.svg?logo=css3)](https://developer.mozilla.org/en-US/docs/Web/CSS)

## 📋 Table of Contents
1. [Overview](#-overview)
2. [Key Features](#-key-features)
3. [System & Database Requirements](#-system--database-requirements)
4. [Setup and Configuration](#️-setup-and-configuration)
5. [Usage Guide](#-usage-guide)
6. [File Structure](#-file-structure)
7. [Database Schema](#-database-schema)
8. [Security Features](#-security-features)
9. [Contributing](#-contributing)
10. [License](#-license)
11. [Contact](#-contact)
12. [Screenshots](#-screenshots)

## 📄 Overview

The **PHP MySQL User Management System** is a comprehensive web application designed for efficient user management with advanced features including dynamic database view creation, comprehensive audit logging, and modern responsive design. Built with PHP 7.4+, MySQL, and PDO, this system provides a complete solution for managing users, tracking operations, and creating custom database views on-the-fly.

The application features a modern, gradient-based UI with smooth animations, real-time validation, and intuitive navigation. It includes a robust audit system that tracks all user operations, dynamic view management for database queries, and secure data handling with proper input validation and SQL injection prevention.

<br><br>
![Demo GIF](screenshots/1.gif)
![Demo GIF](screenshots/2.gif)
![Demo GIF](screenshots/3.gif)
![Demo GIF](screenshots/4.gif)
![Demo GIF](screenshots/5.gif)

## ✨ Key Features

### 👥 **User Management**
* ➕ **Add New Users**: Simple form-based user registration with email validation
* ✏️ **Edit Users**: Update user information with real-time validation
* 🗑️ **Delete Users**: Secure user removal with confirmation dialogs
* 📋 **User Listing**: Comprehensive user list with search and filtering capabilities

### 🗄️ **Database Views Management**
* 🔄 **Dynamic View Creation**: Create or update MySQL views based on user input
* 📊 **Pre-built Views**: Access to predefined views for common queries
* 🎯 **Column Selection**: Choose specific columns for custom views
* 📈 **View Statistics**: Real-time statistics on available views

### 📝 **Audit System**
* 📋 **Operation Tracking**: Complete history of all user operations
* 🕒 **Timestamp Logging**: Detailed timestamps for all actions
* 📊 **Audit Statistics**: Comprehensive statistics on system usage
* 🔍 **Search & Filter**: Advanced filtering and search capabilities

### 🎨 **Modern UI/UX**
* 📱 **Responsive Design**: Works perfectly on desktop, tablet, and mobile
* 🌈 **Gradient Design**: Beautiful gradient backgrounds and modern styling
* ⚡ **Smooth Animations**: CSS animations and transitions for better UX
* 🎯 **Intuitive Navigation**: Easy-to-use interface with clear navigation

### 🛡️ **Security Features**
* 🔐 **PDO Database Connection**: Secure database access with prepared statements
* ✅ **Input Validation**: Comprehensive validation for all user inputs
* 🚫 **SQL Injection Prevention**: Proper escaping and parameter binding
* 🔒 **Session Management**: Secure session handling

## 🖼️ Screenshots

Below are example screenshots showcasing the main features of the user management system:

- **Main Dashboard**: Clear dashboard with access to all features.
- **Add User**: Form for quickly adding a new user with data validation.
- **User List**: Table with options to edit, delete, and filter users.
- **Database Views Management**: Create and modify SQL views based on selected columns.
- **Audit System**: Operation history for users with filtering and export options.

<p align="center">
  <img src="screenshots\1.jpg" width="300"/>
  <img src="screenshots\2.jpg" width="300"/>
  <img src="screenshots\3.jpg" width="300"/>
  <img src="screenshots\4.jpg" width="300"/>
  <img src="screenshots\5.jpg" width="300"/>
  <img src="screenshots\6.jpg" width="300"/>
  <img src="screenshots\7.jpg" width="300"/>
  <img src="screenshots\8.jpg" width="300"/>
  <img src="screenshots\9.jpg" width="300"/>
  <img src="screenshots\10.jpg" width="300"/>
  <img src="screenshots\11.jpg" width="300"/>
</p>


## 🛠️ System & Database Requirements

### Server-Side:
* **PHP Version**: 7.4 or higher
* **Web Server**: Apache, Nginx, or PHP built-in server
* **PHP Extensions**:
  * **PDO (PHP Data Objects)** extension
  * **PDO MySQL driver** (`pdo_mysql`)
  * **Session support**
* **MySQL Database Server**: 5.7 or higher
* **Database**: `test` (configurable)
* **Required Tables**: `subscribers`, `audit_subscribers`

### Client-Side:
* **Web Browser**: Modern browser with CSS3 and JavaScript support
* **JavaScript**: Enabled for enhanced functionality

## ⚙️ Setup and Configuration

### 1. **Environment Setup**
```bash
# Clone or download the project
git clone <repository-url>
cd Users_PHP

# Ensure XAMPP or similar environment is running
# Apache and MySQL services must be active
```

### 2. **Database Configuration**
1. **Create Database**:
   ```sql
   CREATE DATABASE test;
   USE test;
   ```

2. **Import Database Schema**:
   - Open phpMyAdmin: `http://localhost/phpmyadmin/`
   - Select database `test`
   - Import `bazadanych.sql`

3. **Configure Connection**:
   Edit `config.php`:
   ```php
   $host = 'localhost';
   $dbname = 'test';
   $username = 'root';
   $password = ''; // Empty for default XAMPP installation
   ```

### 3. **File Permissions**
Ensure web server has read/write permissions to the project directory.

### 4. **Access Application**
Navigate to: `http://localhost/Users_PHP/`

## 💡 Usage Guide

### **Adding Users**
1. Click "Add User" from the main dashboard
2. Fill in the user's full name and email address
3. Submit the form
4. User is added to the database with audit logging

### **Managing Users**
1. **View Users**: Click "User List" to see all users
2. **Edit User**: Click the edit icon next to any user
3. **Delete User**: Click the delete icon and confirm

### **Database Views**
1. **Access Views**: Click "Database Views" from the dashboard
2. **Create Custom View**: Use the form to specify view name and columns
3. **View Statistics**: See real-time statistics on the main page

### **Audit System**
1. **View Audit**: Click "Audit History" to see all operations
2. **Filter Results**: Use the search and filter options
3. **Export Data**: Download audit logs if needed

## 🗂️ File Structure

```
Users_PHP/
├── config.php              # Database configuration
├── index.php               # Main dashboard
├── add_user.php            # User registration
├── viewsubscribers.php     # User listing and management
├── subscriber_edit.php     # User editing interface
├── subscriber_del.php      # User deletion interface
├── update_user.php         # User update processing
├── widoki.php              # Database views management
├── audit.php               # Audit system interface
├── process_data.php        # Form processing and view creation
├── bazadanych.sql          # Database schema
├── INSTALLATION.md         # Installation instructions
└── README.markdown         # This documentation
```

## 🗄️ Database Schema

### **subscribers Table**
```sql
CREATE TABLE subscribers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### **audit_subscribers Table**
```sql
CREATE TABLE audit_subscribers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    subscriber_name VARCHAR(255) NOT NULL,
    action_performed VARCHAR(50) NOT NULL,
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### **Pre-built Views**
* `users_view`: All users in chronological order
* `existing_users_view`: Currently active users
* `deleted_users_view`: Users who have been removed
* `user_edits_view`: User modification history
* `deleted_users_with_dates_view`: Complete user lifecycle

## 🛡️ Security Features

### **Database Security**
* ✅ **PDO Prepared Statements**: Prevents SQL injection
* ✅ **Input Validation**: Comprehensive validation for all inputs
* ✅ **Error Handling**: Secure error messages without exposing sensitive data
* ✅ **Connection Security**: Encrypted database connections

### **Application Security**
* ✅ **Session Management**: Secure session handling
* ✅ **CSRF Protection**: Form token validation
* ✅ **XSS Prevention**: Output escaping
* ✅ **Access Control**: Proper authentication checks

### **Data Validation**
* ✅ **Email Validation**: Proper email format checking
* ✅ **Required Fields**: Validation for mandatory inputs
* ✅ **Duplicate Prevention**: Prevents duplicate email addresses
* ✅ **Sanitization**: Input sanitization and cleaning

## 🤝 Contributing

We welcome contributions to improve the User Management System! Areas for contribution:

* 🐛 **Bug Fixes**: Report and fix any issues
* ✨ **New Features**: Add new functionality
* 🎨 **UI/UX Improvements**: Enhance the user interface
* 📚 **Documentation**: Improve documentation and examples
* 🔒 **Security Enhancements**: Strengthen security measures

### **Contribution Process**
1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

### **Development Guidelines**
* Follow PSR-12 coding standards
* Add proper error handling
* Include input validation
* Write clear commit messages
* Test thoroughly before submitting

## 📃 License

This project is licensed under the **MIT License** - see the [LICENSE](LICENSE) file for details.

## 📧 Contact

**Project Maintainer**: Adrian Lesniak

For questions, feedback, or to report issues:
* 📧 Open an issue on the GitHub repository
* 📧 Contact the repository owner directly


---

🔧 _Modern user management with PHP, MySQL, and dynamic database views._