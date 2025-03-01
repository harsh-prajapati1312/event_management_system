
# Event Management System

The Event Management System (EMS) is a fully dynamic and responsive website designed to handle event bookings, customer management, and administrative controls. The system allows customers to book, view, edit, and delete their event bookings. Additionally, the admin panel provides full control over content, payments, and overall event management. This system is designed with security in mind to prevent common web vulnerabilities, ensuring a safe experience for both customers and administrators.

## Features

### 1. **Customer Booking System**
- **Event Booking**: Customers can easily book events on the website by selecting event dates, types, and other required information.
- **View Bookings**: Customers can view their past and upcoming bookings through a user-friendly interface.
- **Edit Bookings**: Customers have the ability to update or modify their event details (dates, attendees, etc.).
- **Delete Bookings**: Customers can delete their bookings when necessary, with confirmations to prevent accidental deletions.

### 2. **Admin Panel**
- **Event Management**: Admins can create, update, and manage event details such as date, location, and event description.
- **Content Management**: Admins can update images, videos, and other content on the website to keep the information current and engaging.
- **Order Management**: Admins can view, manage, and process customer orders and bookings, ensuring everything is handled efficiently.
- **Payment Handling**: Integration with **Razorpay** for secure online payment processing, allowing admins to track and manage payments for events.
- **User Management**: Admins can manage customer accounts, view booking history, and resolve any issues related to event management.

### 3. **Dynamic & Responsive Website**
- **100% Dynamic**: The website is fully dynamic, meaning all content (such as events, booking details, and customer profiles) is generated in real-time, ensuring the system always displays the latest information.
- **Responsive Design**: The website is designed to be fully responsive, adapting to different screen sizes and devices, including desktops, tablets, and smartphones.

## Security Features

We take website security seriously and have implemented a variety of measures to protect the system from common web attacks. Below are some of the security features that have been integrated into the Event Management System:

### 1. **SQL Injection Prevention**
- All user inputs are properly sanitized and validated to prevent SQL injection attacks, ensuring that malicious code cannot be executed through database queries.

### 2. **Local File Inclusion (LFI) Prevention**
- The system is built to prevent Local File Inclusion (LFI) vulnerabilities. User-supplied file paths are strictly controlled, ensuring that no unauthorized files can be included in the application.

### 3. **Cross-Site Scripting (XSS) Prevention**
- The system prevents Cross-Site Scripting (XSS) attacks by sanitizing user inputs and encoding output, ensuring that any injected scripts cannot execute within the user’s browser.

### 4. **Secure Payment Gateway Integration**
- **Razorpay Integration**: Razorpay is securely integrated into the payment system, allowing customers to make payments without compromising security. Sensitive data is never stored locally on the website, and all transactions are processed securely.

### 5. **Secure Authentication**
- The system implements secure login and user authentication processes for both customers and admins, utilizing encrypted passwords and secure session management to prevent unauthorized access.

## Installation

### Prerequisites

Before setting up the system, ensure you have the following installed:
- PHP (preferably PHP 7.4 or above)
- MySQL database server
- Composer (for dependency management)
- Web server (Apache/Nginx)
- Razorpay API keys (for payment integration)

### Steps to Install

1. Clone the repository to your local machine or server:

   ```bash
   git clone https://github.com/yourusername/event-management-system.git
   cd event-management-system
Set up the database:

Create a new MySQL database and import the provided schema file (database.sql).
Configure the environment:

Edit the .env file to set up the database connection and Razorpay API credentials.
Install dependencies:

bash
Copy
composer install
Configure your web server to point to the public/ directory as the document root.

Start the web server, and the Event Management System should be accessible at http://localhost or your configured domain.

Usage
1. Customer Access
Customers can visit the website, browse available events, and book an event by selecting the required options.
Customers can view their booking history, edit or delete their orders via their account dashboard.
2. Admin Access
Admins can log in to the admin panel to manage events, bookings, content, and payment information.
Admins can update event details, add images/videos, and process payments via Razorpay.
3. Payments
Customers will make payments securely via the Razorpay integration. The admin can track payment statuses and manage any disputes through the admin panel.
Contribution
We welcome contributions to this project! If you’d like to help improve the Event Management System, feel free to:

Fork the repository.
Create a feature branch (git checkout -b feature-name).
Commit your changes (git commit -am 'Add new feature').
Push to the branch (git push origin feature-name).
Create a new pull request.
Contributors
Your Name – Project Lead and Developer
Contributor Name – Feature Development
Contributor Name – UI/UX Design
If you have any issues or feature suggestions, feel free to open an issue or submit a pull request!

License
This project is licensed under the MIT License - see the LICENSE file for details.

Disclaimer
This project is intended for educational and development purposes. We strongly recommend using this system responsibly and ensuring that security measures are in place for real-world deployments.
