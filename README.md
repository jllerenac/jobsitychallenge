# jobsitychallenge

# Add the following configuration to apache httpd.conf

<VirtualHost *:80> <br>
    DocumentRoot "/srv/www/htdocs/jobsitychallenge/jose_llerena"
    ServerName jose-llerena.jobsitychallenge.com
//    Other directives here
</VirtualHost>

<Directory "/srv/www/htdocs/jobsitychallenge/jose_llerena">
Options Indexes FollowSymLinks
AllowOverride All
Require all Granted
</Directory>

# Make sure that the following line is in /etc/my.cnf
log_bin_trust_function_creators = 1;
