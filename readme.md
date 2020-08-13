Project Setup
---------------
This project was created in Laravel v6.<br>
Please follow the instruction below to setup the project<br>

**1. Git pull**<br>
`git clone https://github.com/tapash009/project-assignment.git`

**2. Environment Files**<br>
This package ships with a .env.example file in the root of the project. You must rename this file to just .env<br>
`Note: Make sure you have hidden files shown on your system.`

**3. Composer**<br>
Laravel project dependencies are managed through the PHP Composer tool. The first step is to install the dependencies by navigating into your project in terminal and typing this command:<br>
`composer install`

**4. Create Database**<br>
You must create your database on your server and on your .env file update the following lines:<br>
`DB_CONNECTION=mysql`<br>
 `DB_HOST=127.0.0.1`<br>
 `DB_PORT=3306`<br>
 `DB_DATABASE=homestead`<br>
 `DB_USERNAME=homestead`<br>
 `DB_PASSWORD=secret`<br>
 
 **5. Permissions**<br>
  Provide all required permissions to bootstrap/cache(folder) and storage(folder)
 
 **6. Artisan Commands**<br>
 The first thing we are going to so is set the key that Laravel will use when doing encryption.
 `php artisan key:generate`<br>
 You should see a green message stating your key was successfully generated. As well as you should see the `APP_KEY` variable in your .env file reflected.<br> 
 
 
 **7. Create Database Tables**<br>
 We are going to run the built in migrations to create the database tables <br>
 `php artisan migrate`
 
 **8. Run the DB Seeder**<br>
  We are going to run the DB seeder to insert fake data in users table <br>
  `php artisan db:seed`
  
  **9. Credentials**<br>
    After we run DB seed we will get Admin Credentials as <br>
    username: admin <br>
    password: secret
 
 You Have completed with the project setup!
 
 **Note**<br>
 Login page for normal users and admin are same. After logging the user will automatically redirected to there respected page. 
 
 
 
