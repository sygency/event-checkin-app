Event check-in system
========================

Welcome to Event Check-in system - a lightweight symfony based application used for
ticket management in any event. Application has already been used for Hong Kong based TEDx event in addition with
android QR ticket scanner.

1) Installation
----------------------------------

Installation is the same as for any other symfony project:

* Clone repository to your local machine
* curl -s http://getcomposer.org/installer | php
* php composer.phar install
* php app/console doctrine:migrations:migrate

2) Demo
-------------------------------------

[**Event Check-in Demo**][1]

Before starting coding, make sure that your local system is properly
configured for Symfony.

Execute the `check.php` script from the command line:

    php app/check.php

The script returns a status code of `0` if all mandatory requirements are met,
`1` otherwise.

Access the `config.php` script from a browser:

    http://localhost/path/to/symfony/app/web/config.php

If you get any warnings or recommendations, fix them before moving on.

3) Credits
--------------------------------

Application is developed by Synergy Technologies

[1]:  http://symfony.com/doc/2.4/book/installation.html