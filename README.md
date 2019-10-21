# jobsitychallenge

# Add the following configuration to apache httpd.conf

<VirtualHost *:80> <br>
    DocumentRoot "/srv/www/htdocs/jobsitychallenge/jose_llerena" <br>
    ServerName jose-llerena.jobsitychallenge.com <br>
//    Other directives here <br>
< /VirtualHost> <br>

<Directory "/srv/www/htdocs/jobsitychallenge/jose_llerena"> <br>
Options Indexes FollowSymLinks <br>
AllowOverride All <br> 
Require all Granted <br>
< /Directory> <br>

# Make sure that the following line is in /etc/my.cnf
log_bin_trust_function_creators = 1;
