# Library Management System

## Overview
The **Library Management System (LMS)** is a web-based application designed to efficiently manage library operations. It enables administrators to oversee library resources, manage users, and handle borrowing/return processes, while students can search for books and request loans. The system provides an intuitive interface and a well-structured backend for streamlined functionality.

## Features

### Admin Features
- **Book Management**
  - Add, edit, and delete book records.
  - View detailed book information.
- **User Management**
  - Manage student details.
  - Accept or reject borrowing requests.
- **Borrowing Management**
  - Track borrowed and returned books.
  - Manage issue and return requests.
- **Messaging**
  - Send messages to students.
  - View student inquiries.

### Student Features
- **Search and Browse Books**
  - View available books with detailed information.
- **Borrowing Requests**
  - Submit requests for borrowing books.
  - Track current and past borrowed books.
- **Messaging**
  - Communicate with administrators.

## Folder Structure
- **Admin Panel**: All administrative functionalities (e.g., `addbook.php`, `borrowedbooks.php`).
- **Student Panel**: Interfaces and operations for student users (e.g., `index-student.php`, `issue-request.php`).
- **Shared Resources**:
  - `config.php`: Database connection settings.
  - `css/`: Styling files.
  - `scripts/`: JavaScript files for dynamic functionality.
  - `images/`: Static assets for the interface.

## Technologies Used
- **Frontend**:
  - HTML, CSS, JavaScript
  - Bootstrap for responsive design
  - DataTables for dynamic table operations
- **Backend**:
  - PHP for server-side processing
  - MySQL for database management

