# Ajax Register/Login or Sign Up/Sign In (whatever suits you better)

Ajax sign up & sign in app. For those who want to master ajax register/login stuff or use this in their project. I hope you'll find the code useful and use it on your project. Feel free to continue developing the dashboard and to add new pages if you need. 

First things first, create a database and with the newly database being selected, execute the SQL query found in users.sql which will create table users. Then update your database credentials in:<br />
<code>
app/db.php
</code>
<br />
and you are good to go.

<code>
ajax/login.php
</code>
handles the ajax request coming from the sign in page,
while
<code>
ajax/register.php
</code>
handles the ajax request coming from the sign up page.

This app is built in core PHP, uses MySQL and PDO for database interaction. It's ideal for small to medium apps, for more complex things I recommend that you use already proven PHP framework (there are so many PHP frameworks to choose from which is great) or custom MVC pattern on your own.
