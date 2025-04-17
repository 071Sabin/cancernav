# Cancer Navigation Support System

A role-based web platform designed to help underserved cancer patients access social needs services like transport, housing, and financial aid. Built using Laravel, the system supports Admins, Navigators, and Patients with secure access and tailored functionalities.

## 🚀 Features (Overview)
- Patient-to-Navigator and Navigator-to-Admin request flows
- Dashboard summaries with charts and alerts
- Financial aid filtering based on eligibility
- Simulated API integration for services
- Broadcast system for alerts and messages
- Secure file and image handling with access control
- Role-based access for Admins, Navigators, and Patients

---

## ⚙️ Installation & Setup

Follow the steps below to run the project locally:

### 1. **Clone the Repository**


### 2. **Install Dependencies**
Make sure you have PHP >= 8.1, Composer, MySQL, and Node.js installed.

**Install backend PHP packages:**
RUN in CMD: composer install

### 3. **Environment Setup**
cp .env.example .env

Update the .env file with your database credentials:
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

### **4. Run Migrations and Seeders**
php artisan migrate --seed


### **5. Storage Linking (for file access)**
php artisan storage:link


### **6. Start the Server**
php artisan serve
Visit http://localhost:8000 in your browser.
Default admin id/password: admin@gmail.com pwd: admin@123
