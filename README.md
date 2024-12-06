## Project/Thesis Proposal Management System
A web application designed to streamline the submission, approval, and management of project/thesis proposals for university departments. This system optimizes communication between students, advisors, and supervisors while ensuring data security and efficient tracking of proposals.

**Features**

**Student Features:**
    - Submit project/thesis proposals.
    - Track approval status and assigned supervisors.
    
**Teacher Features:**
    - Review proposals.
    - Provide feedbacks to approved proposals.

**Admin Features:**
    - Manage user roles (students, teachers, admins).
    - Oversee departmental submissions and approvals.
    
**Technologies Used**

**Frontend:**
    - HTML, CSS, JavaScript
    - Bootstrap
    
**Backend:**
    - Laravel
    
**Database:**
    - MySQL
    
**Server:**
    - XAMPP (local development, php 8.2 required)
    
**Installation**
**Clone the repository:**
git clone https://github.com/yourusername/project-thesis-management-system.git 

**Navigate to the project directory:**
cd project-thesis-management-system  

**Install dependencies:**
composer install  
npm install  

**Set up .env file:**
Copy .env.example to .env.
Configure database and email settings.

**Generate application key:**
php artisan key:generate  

**Run migrations:**
php artisan migrate  

**Start the development server:**
php artisan serve  

**Usage**
    - Access the application at http://localhost:8000.
    - Login or register based on your role (student, teacher, admin).
    - Explore features like proposal submission, approval, and management.
    
**Contact**
For queries or suggestions, feel free to contact:
Ashfia Khatun
Email: ashfia.khatun01@gmail.com
