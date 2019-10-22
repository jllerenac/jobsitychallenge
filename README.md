# INTRODUCTION
This application is a blog type. Users can create an account specifying name, email and twitter username and after creating an account, they are able to create, edit and search entries. Also the is an option to display only the selected user entries like a user page which also shows tweets done by that the twitter's user dislay name specified.

# INSTALLATION

To install this application, the following steps have to done  <br>

1) Either download zip file or with git clone https://github.com/jllerenac/jobsitychallenge.git   <br>

2) Copy the folder to you apache dir, which is usually /var/www/html. I use openSuSE and the path is /srv/www/htdocs  <br>

3) Execute the .sql file script to create database, tables, functions and procedures in MySQL  <br>

4) Open your /etc/hosts file and add the following line   <br>
    your_ip_address    jose-llerena.jobsitychallenge.com   <br>
    
    If you have a functioning DNS server, you do not need to do this, but rather add the name in your DNS records   <br>
    Feel free to rename DNS name to whichever you prefer   <br>

5) Add the following configuration to apache httpd.conf  <br>

Virtual host config is to make the application the default apache app   <br>

<VirtualHost *:80> <br>
    DocumentRoot "/var/www/html/jobsitychallenge/jose_llerena" <br>
    ServerName jose-llerena.jobsitychallenge.com <br>
//    Other directives here <br>
< /VirtualHost> <br>

This following config is to suppress index.php from URL, .htaccess is already configured in the application  <br>

<Directory "/var/www/html/jobsitychallenge/jose_llerena"> <br>
Options Indexes FollowSymLinks <br>
AllowOverride All <br> 
Require all Granted <br>
< /Directory> <br>

6) Make sure that the following line is in /etc/my.cnf  <br>
log_bin_trust_function_creators = 1;   <br>

Otherwise you may experience problem when executing DB script  <br>

7) Go to application/config/database.php and include your DB password  <br>

8) Go to application/models/Entry_Model.php line 78-81 and add your Twitter tokens, otherwise you may experience error, I did not validate this, I assume you will add your Twitter API keys  <br>

9) In your browser navigate to jose-llerena.jobsitychallenge.com and the application should work <br>

10) You can create your own users, but there are already two existing users: josellerenacarpio@gmail.com and alfredollerenas@hotmail.com, the password is 1234. The first mail is my personal email and you can write me anytime, the other mail is my dad's and he will not answer you. <br>

# KNOWN ISSUES / BUGS

There are some issues that I am aware of but due to time and what it was requested to do, I did not include it or correct ir <br>

1) The application name should have been jose_llerena with the underscore, but I used the minus because it gave me problems in both apache configuration and hostname, so I had to change it. <br>

2) Email verification is not working, I didn't include a working SMTP, so when creating an account the email verified is straight set to 1, so you can login inmediately. <br>

3) You may experience issues using pagination, especially with the icons to last and first page, unless you clic it more than minesweeper, you should be really good with pagination. <br>

4) Any additional bugs, let me know and I will included here.

# ADDITIONAL NOTES

1) Sidebar was not actually done because I really found it way nicer to include tweets under the entries. since entries are displayed 3 per page, the display is better to use the whole width for entries and under that the tweets, sorry I know sidebar was requested. <br>

2) I really like to use AJAX for my requests, so there is no actual "User Page", when clicking on user icon, thats supposed to go to user page, but what I did was actually query entries by user to display only that user entries and also show his tweets, so doing that the result was really to have a user page.
