# client-contact-management
 
# client-contact-management
 
A simple PHP and MySQL web application to manage clients and their contacts

# Features

- Add and Display Clients
- Add, Unlink and Display Contacts
- List Clients and related contacts
- MySQL and XAMPP

# Getting Started
1. Start XAMPP (Apache and MySQL)
2. Import the database in phpMyAdmin
3. Move project folder inside "C:\xampp\htdocs"
4. Visit "http://localhost/client-contact"

# Folder Structure
* 'connect.php'- Helps with the database connection
* 'client_form.php'- Client creation form
* 'add_client.php'- Adds clients
* 'add_contact.php' Adds contacts
* 'clients.php'- View all clients anf linked contacts
* 'contacts.php'- View all contacts
* 'contact_form'- Contact creation form 
* 'index.php'- Homepage
* 'README.md' This file
* 'save_client.php' Logic for saving client
* 'save_contact.php'- Logic for saving contact and generating client code
* 'style.php'- Project styling(theme)
* 'unlink_contact'- Logic to unlink contact from a client
* 'client_contact_management_db.sql' - MysSQL export of database, imported from phpMyAdmin



# Database Setup
Make sure to import the `client_contact_db.sql` file using phpMyAdmin. It includes all the necessary tables (`Client`, `Contact`) with relationships.


# License 
MIT

