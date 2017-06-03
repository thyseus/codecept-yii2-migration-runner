# codecept-yii2-migration-runner

Module to interface with a FreeRADIUS server

# Badges
[![Lahello Stable Version](https://poser.pugx.org/davidjeddy/codecept-yii2-migration-runner/v/stable?format=flat-square)](https://packagist.org/packages/davidjeddy/codecept-yii2-migration-runner)
[![Total Downloads](https://poser.pugx.org/davidjeddy/codecept-yii2-migration-runner/downloads)](https://packagist.org/packages/davidjeddy/codecept-yii2-migration-runner)
[![Lahello Unstable Version](https://poser.pugx.org/davidjeddy/codecept-yii2-migration-runner/v/unstable?format=flat-square)](https://packagist.org/packages/davidjeddy/codecept-yii2-migration-runner)
[![License](https://poser.pugx.org/davidjeddy/codecept-yii2-migration-runner/license?format=flat-square)](https://packagist.org/packages/davidjeddy/codecept-yii2-migration-runner)
[![Monthly Downloads](https://poser.pugx.org/davidjeddy/codecept-yii2-migration-runner/d/monthly?format=flat-square)](https://packagist.org/packages/davidjeddy/codecept-yii2-migration-runner)
[![Daily Downloads](https://poser.pugx.org/davidjeddy/codecept-yii2-migration-runner/d/daily?format=flat-square)](https://packagist.org/packages/davidjeddy/codecept-yii2-migration-runner)
[![composer.lock](https://poser.pugx.org/davidjeddy/codecept-yii2-migration-runner/composerlock?format=flat-square)](https://packagist.org/packages/davidjeddy/codecept-yii2-migration-runner)

~Add Sensiolabs quality here~

# REQUIREMENTS

PHP 5.6+

Composer

Codeception

[Any relatiomal database supported by Yii2](http://www.yiiframework.com/doc-2.0/guide-db-dao.html)

Important: You must have creditials for a user with permission to create a database schema.

# INSTALLATION
 + `cd {project root}`
 + Run `composer require davidjeddy/codecept-yii2-migration-runner` in terminal
     + OR add `"davidjeddy/codecept-yii2-migration-runner": "dev-master@dev"` to your project's  `composer.json`, then run `composer update`.

# CONFIGURATION

Edit Codeception test suite with database creditials and DSN

```
class_name: AcceptanceTester
...
modules:
    enabled:
        ...
        - Yii2MigrationRunner
        ...
    config:
        ...
        Yii2MigrationRunner:
            additional: 'rbac-migration'
            dsn: mysql:host=db;port=3306;dbname=yii2-starter-kit-test
            dump: ../_data/dump.sql
            password: root
            user: root
        ...
```

# USAGE
Run Codeception. The module will execute the given list of migration commands, dump the database, and store the results
where 'dump' tells it to.
