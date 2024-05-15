<h1>Document Management System (DMS)</h1>

- Postman test [documenter](https://documenter.getpostman.com/view/28836077/2sA3JRXe1p)
- Here are the instructions for setting up the project: <br/>
NOTE: you need to install xammp and any editor on your desktop.
<br>1- Clone the repository to your local machine using the following command: 
<br><code>git clone https://github.com/MoonesMezher/dms-by-laravel.git</code><br>
2- Navigate to the project directory: 
<br><code>cd dms-by-laravel</code><br>
3- Install the project dependencies using Composer: 
<br><code>composer install</code><br>
4- Create a copy of the .env.example file and rename it to .env: 
<br><code>cp .env.example .env</code><br>
5- Generate a new application key: 
<br><code>php artisan key:generate</code><br>
6- Configure the database connection in the .env file: 
<br><code>DB_CONNECTION=mysql<br>
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=dms
        DB_USERNAME=root
        DB_PASSWORD=></code><br>
7- Run the database migrations: 
<br><code>php artisan migrate</code><br>
8- Seed the database with sample data (optional): 
<br><code>php artisan db:seed</code><br>
9- Start the development server: 
<br><code>php artisan serve</code><br>
10- Access the application in your web browser at http://localhost:8000. 

<h1>API Endpoints Overview</h1>

<h2>Users</h2>
POST /register: Register a new user.<br>
POST /login: Authenticate a user and return a token.<br>
POST /profile: Logout user.<br>
GET /profile: Retrieve the profile of the currently authenticated user.<br>
GET /users: Show all users in the system.<br>
PUT /profile: Update user profile details.<br>
<h2>Document</h2>
POST /documents: Add a new book.<br>
GET /documents: List all documents.<br>
GET /documents/{id}: Get detailed information about a specific document.<br>
PUT /documents/{id}: Update document.<br>
DELETE /documents/{id}: Remove a document from the system.<br>
<h2>Comments</h2>
POST /comments/user/{id}: Add a new comment on user.<br>
POST /comments/document/{id}: Add a new comment on document.<br>
GET /comments: List all comments.<br>
GET /comments/{id}: Get detailed information about a specific comment.<br>
PUT /comments/{id}: Update comment information (owner the comment only).<br>
DELETE /comments/{id}: Delete an comment (owner the comment only).<br>
