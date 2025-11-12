# eWork - Job Portal Platform

<div align="center">

![eWork Logo](https://img.shields.io/badge/eWork-Job%20Portal-14A800?style=for-the-badge&logo=linkedin&logoColor=white)

**A comprehensive job portal platform connecting job seekers with employers**

[Features](#-features) • [Tech Stack](#-tech-stack) • [Installation](#-installation) • [Usage](#-usage) • [Project Structure](#-project-structure) • [Contributors](#-contributors)

</div>

---

## 📋 Description

**eWork** is a full-featured job portal web application that facilitates the connection between job seekers and employers. Built as a course project for Software Requirements Engineering, the platform provides a seamless experience for posting jobs, searching opportunities, managing applications, and building professional profiles.

### Key Highlights

- **Dual User System**: Separate interfaces for job seekers and employers
- **Comprehensive Job Management**: Post, search, and apply for jobs with ease
- **CV/Resume Builder**: Create and manage professional CVs
- **Admin Dashboard**: Complete administrative control over users and job listings
- **Modern UI/UX**: Responsive design with dark/light mode support

---

## ✨ Features

### For Job Seekers
- 🔍 **Job Search**: Browse and search through available job listings
- 📝 **CV Builder**: Create and manage professional CVs with personal information
- 📄 **Job Applications**: Apply to jobs directly from the platform
- 👤 **Profile Management**: Update username, password, and personal information
- 🌓 **Dark Mode**: Toggle between light and dark themes

### For Employers
- 📢 **Job Posting**: Create detailed job listings with descriptions, skills, and salary
- 📊 **Application Management**: View and review applications for posted jobs
- 👥 **Applicant Profiles**: Access applicant CVs and contact information
- 🗑️ **Job Management**: Edit or delete posted job listings

### For Administrators
- 👥 **User Management**: View all users, assign admin roles, and manage accounts
- 💼 **Job Oversight**: Monitor and manage all job postings across the platform
- 🔐 **Access Control**: Secure admin-only features and permissions

---

## 🛠️ Tech Stack

### Backend
- **PHP 7.4+** - Server-side scripting
- **MySQL** - Database management
- **PDO** - Database abstraction layer

### Frontend
- **HTML5** - Markup structure
- **CSS3** - Styling and responsive design
- **JavaScript** - Interactive functionality
- **jQuery** - DOM manipulation and AJAX

### Architecture
- **MVC Pattern** - Organized class structure
- **Session Management** - User authentication and state
- **File Upload** - CV and profile image handling

---

## 📦 Installation

### Prerequisites
- **XAMPP** (or similar PHP/MySQL environment)
- **PHP 7.4+**
- **MySQL 5.7+**
- **Web Server** (Apache/Nginx)

### Setup Instructions

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd ework
   ```

2. **Configure Database**
   - Start XAMPP and ensure MySQL is running
   - Create a new database named `ework`
   - Import the database schema (if available) or create tables as needed

3. **Database Configuration**
   - Update database credentials in `classes/dbh.classes.php`:
   ```php
   $username = "root";
   $password = "";
   $dbp = new PDO('mysql:host=localhost;dbname=ework', $username, $password);
   ```

4. **File Permissions**
   - Ensure the `uploads/` directory has write permissions for file uploads

5. **Access the Application**
   - Navigate to `http://localhost/ework/` in your browser

---

## 🚀 Usage

### Getting Started

1. **Sign Up**: Create a new account as a job seeker or employer
2. **Login**: Access your account with your credentials
3. **Explore**: Browse available jobs or post your first job listing

### For Job Seekers

1. **Create Your CV**: Navigate to "My CV" and fill in your professional information
2. **Search Jobs**: Use the search functionality on the "Find Job" page
3. **Apply**: Click "Apply Now" on any job listing that interests you

### For Employers

1. **Enable Employer Mode**: Toggle "Employer Mode" in your profile settings
2. **Post Jobs**: Use the "Post Job" page to create detailed job listings
3. **Review Applications**: Check the "Applications" page to view applicants and their CVs

### For Administrators

1. **Access Admin Panel**: Navigate to "Admin Panel" from the main menu
2. **Manage Users**: View, promote, or delete user accounts
3. **Oversee Jobs**: Monitor and manage all job postings

---

## 📁 Project Structure

```
ework/
├── classes/              # PHP class files
│   ├── dbh.classes.php          # Database handler
│   ├── job.classes.php          # Job management
│   ├── login.classes.php        # Login functionality
│   ├── signup.classes.php       # Registration
│   ├── profile.classes.php      # User profiles
│   ├── cv.classes.php           # CV management
│   └── ...
├── includes/             # PHP include files
│   ├── login.inc.php            # Login processing
│   ├── signup.inc.php           # Registration processing
│   ├── insert_job.inc.php       # Job creation
│   ├── apply_job.inc.php        # Application handling
│   └── ...
├── images/               # Static images and assets
├── uploads/              # User-uploaded files (CVs, images)
├── index.php             # Landing page
├── login.php             # Login page
├── signup.php            # Registration page
├── find.php              # Job search page
├── post.php              # Job posting page
├── applications.php      # Application management
├── profile.php           # User profile
├── cv.php                # CV builder
├── adminPanel.php        # Admin dashboard
└── README.md             # This file
```

---

## 🎨 Features in Detail

### Authentication System
- Secure user registration and login
- Session-based authentication
- Password hashing and validation
- Role-based access control (User, Employer, Admin)

### Job Management
- Rich job listings with title, description, skills, and salary
- Advanced search functionality
- Job filtering and categorization
- Real-time job updates

### Application System
- One-click job applications
- Application tracking for employers
- CV integration with applications
- Modal-based CV viewing

### User Interface
- Responsive design for all devices
- Dark/Light mode toggle
- Modern, clean aesthetic
- Intuitive navigation

---

## 👥 Contributors

This project was developed as part of the **Software Requirements Engineering** course.

**Development Team:**
- **Albin Dana**
- **Semi Zhuri**
- **Andi Morina**

---

## 📝 License

This project is developed for educational purposes as part of a university course.

---

## 🔮 Future Enhancements

Potential improvements for future development:
- Email notifications for applications
- Advanced filtering and sorting options
- Company profiles and branding
- Messaging system between employers and applicants
- Job recommendation algorithm
- Analytics dashboard for employers
- Multi-language support

---

## 📞 Support

For questions or issues related to this project, please contact the development team or refer to the course documentation.

---

<div align="center">

**Built with ❤️ for Software Requirements Engineering**

© 2024 eWork. All rights reserved.

</div>

