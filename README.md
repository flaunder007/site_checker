# site_checker
This script is made to check sites for availability.

sites.txt contain domains and ports which is needed to check, separated by space. For examle: "somesite.ru 80 443 21". Each domain on a new line.

site_add_to_checker.php is adding a record to sites.txt, from the comand line. For example:

php ~/site_add_to_checker.php somedomain.ru 80 443 21 22

Domain is always first parameter.

site_checker.php is made to executed by CRON with one parameter - email to send an errors. For example:

php ~/site_checker.php some@email.ru
