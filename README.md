# site_checker
This script is made to check sites for availability.

sites.txt contain domains and ports which is needed to check, separated by space. Last one is always an email to send an errors. For examle: "somesite.ru 80 443 21 some@email.com". Each domain on the new line.

site_add_to_checker.php is adding a record to sites.txt, from the comand line. For example:

php ~/site_add_to_checker.php somedomain.ru 80 443 21 22 some@email.com

Domain is always first parameter and an email is always last one.

site_checker.php is made to executed by CRON with no parameters.

php ~/site_checker.php
