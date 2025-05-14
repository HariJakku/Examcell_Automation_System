
# 🏫 EXAM CELL AUTOMATION SYSTEM

A comprehensive web-based application designed to automate and manage exam-related tasks in educational institutions. It simplifies processes such as exam scheduling, hall ticket generation, results management, and student notifications.

## 🌟 Features

- 📅 Timetable & Exam Schedule Management
- 🎫 Hall Ticket Generation
- 📝 Result Uploading & Viewing
- 🔐 Role-based login for Admin, Faculty, and Students
- 📧 Notifications/Announcements Module
- 📊 Dashboard with real-time statistics

## 🚀 Getting Started

### 🔧 Prerequisites

- Web Server (e.g., XAMPP/LAMP/WAMP)
- PHP 7.x or higher (if using PHP)
- MySQL Server
- Web Browser

### 📥 Installation

1. **Clone or Download the Project**

```bash
git clone https://github.com/your-username/EXAM_CELL_SYSTEM.git
````

2. **Extract ZIP (if applicable)**
   Place the project folder in your web server directory:

   * `htdocs` for XAMPP (Windows)
   * `www` or `/var/www/html` for LAMP (Linux)

3. **Setup Database**

   * Open **phpMyAdmin**
   * Create a new database named `exam_cell_db` *(or as per your SQL file)*
   * Import the `.sql` file located in the `database` folder

4. **Update Configuration**

   * Edit the `config.php` or connection file to update DB credentials if needed

5. **Run the Application**
   Open your browser and visit:

   ```
   http://localhost/EXAM_CELL_SYSTEM/
   ```

## 📁 Project Structure

```
EXAM_CELL_SYSTEM/
│
├── css/                # Stylesheets
├── js/                 # JavaScript files
├── admin/              # Admin Panel
├── student/            # Student Interface
├── faculty/            # Faculty Module
├── includes/           # Database config and utilities
├── database/           # SQL files for DB setup
├── index.php           # Main entry point
└── README.md           # Project documentation
```

## 🙋‍♂️ User Roles

* **Admin**: Full access to all functionalities including schedule, hall tickets, and results.
* **Faculty**: Upload marks, update student records.
* **Student**: View schedule, hall ticket, results.

## 🛠️ Tech Stack

* **Frontend**: HTML, CSS, JavaScript
* **Backend**: PHP (or Django/Flask if applicable)
* **Database**: MySQL
* **Hosting**: XAMPP / Localhost



## 📄 License

This project is open-source and available under the [MIT License](LICENSE).

---

📚 *Empowering institutions to go digital with streamlined exam management.*
