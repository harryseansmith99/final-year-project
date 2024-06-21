# Final Year Project

## Synopsis

This is an example inventory management system written with:

- Backend:
PHP, MySQL (MariaDB).

- Frontend:
HTML, CSS, JavaScript, Bootstrap CSS, Bootstrap JS.

You can store products and track stock levels associated with said products. Products can be categorised, and stock can be easily allocated/deallocated.

The site uses a sidebar as the primary tool for navigation.

It allows for two types of users:

- Admin: Able to complete all operations on the site, including operations related to administration of other users.

- Standard: Restricted from users adminstration, also restricted from any delete operations for products.

User passwords are encrypted with BCrypt, also there are password constraints:

- At least one uppercase character.
- At least one lowercase character.
- At least one digit.
- At least one special character.
- Password has to be 8-15 characters long.

For convenience there are two users already loaded in the database (with a hashed password), details below:

- Admin:

  - Email: admin@gmail.com
  - Password: Admin123!

- Standard:

  - Email: standard@gmail.com
  - Password: Standard123!

---

## Setup Instructions

- Ensure you have installed LAMPP/XAMPP on your system.
- Download the project folder and place it in the htdocs folder.
- Go to phpMyadmin and create a new database named **inventory_management_db**.
- When created, go to import, and import the **inventory_management_db.sql** file found in the database folder of the project.
- You should now be able to login.