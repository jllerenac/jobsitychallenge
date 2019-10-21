# jobsitychallenge

<VirtualHost *:80>
    DocumentRoot "/srv/www/htdocs/jobsitychallenge/jose_llerena"
    ServerName jose-llerena.jobsitychallenge.com
#    Other directives here
</VirtualHost>

<Directory "/APACHE_DIR/jobsitychallenge/jose_llerena">
Options Indexes FollowSymLinks
AllowOverride All
Require all Granted
</Directory>
