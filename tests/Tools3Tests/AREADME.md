
```shell
/usr/local/Cellar/php@7.3/7.3.33_11/bin/php  build/phpunit -c phpunit.allure.xml tests/Tools3Tests


allure serve tests/Tools3Tests/allure-results

COMPOSER_MEMORY_LIMIT=-1 /usr/local/Cellar/php@5.6/5.6.40_12/bin/php build/composer.phar require --dev allure-framework/allure-php-api:~1.1.0 --ignore-platform-reqs

 COMPOSER_MEMORY_LIMIT=-1 /usr/local/Cellar/php@5.6/5.6.40_12/bin/php build/composer.phar dump-autoload -o

```