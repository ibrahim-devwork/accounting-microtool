# Accounting microtool
This project to convert ofx files to CSV files. Let me explain this project to you:
    
   - When you log in as an administrator, you can create users and you can create a new process for any user and you can see all the processes for all users, meaning you have all the permissions, but when you log in as a user, you can only create your own process and see it and delete it if you want. After creating a new process, you can see Its status is like “Pending”, “In Progress” or “Completed”, and when you need to download the CSV file, just open the dashboard page, where you can see all the process completed and download any CSV file you want.
     - Old deletion process: This feature deletes files that are more than 3 days old, and this is automatic according to the system

## Requirements : 
	- Web server
	- PHP >= 8.1
	- Composer
	- Database
	- Git

## Steps to run this project :
	- First of all you need to clone this project from GitHub from this link: https://github.com/ibrahim-devwork/accounting-microtool.
	- After clone this project, you need to run install composer command in this project to install all dependencies.

	- And then you need to create a new database and put its host, username, database name and port in the .env file and after that you can run "php artisan migrate -seed" to create the database tables and insert admin in the users table.	
	- Now you can run "php artisan serve" to run the project and you will find the admin information in UserSeeder so you can login.

## Noticeable :
	- If you want to update or develop this project then you need to install Nodejs and when working on it run “npm run dev” and when all updates are done run “npm run build”.
