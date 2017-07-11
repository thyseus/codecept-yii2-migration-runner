# Yii2 / Codeception Migration Runner

Codeception extension that will run Yii2 migration commands and provide the output as a dump file. This is typically then
picked up  by the Codeception Db extension and loaded before each test is executed. The migration output, however, is only
runs during the `codeception build` execution.

# BADGES
[![Lahello Stable Version](https://poser.pugx.org/davidjeddy/codecept-yii2-migration-runner/v/stable?format=flat-square)](https://packagist.org/packages/davidjeddy/codecept-yii2-migration-runner)
[![Total Downloads](https://poser.pugx.org/davidjeddy/codecept-yii2-migration-runner/downloads)](https://packagist.org/packages/davidjeddy/codecept-yii2-migration-runner)
[![Lahello Unstable Version](https://poser.pugx.org/davidjeddy/codecept-yii2-migration-runner/v/unstable?format=flat-square)](https://packagist.org/packages/davidjeddy/codecept-yii2-migration-runner)
[![License](https://poser.pugx.org/davidjeddy/codecept-yii2-migration-runner/license?format=flat-square)](https://packagist.org/packages/davidjeddy/codecept-yii2-migration-runner)
[![Monthly Downloads](https://poser.pugx.org/davidjeddy/codecept-yii2-migration-runner/d/monthly?format=flat-square)](https://packagist.org/packages/davidjeddy/codecept-yii2-migration-runner)
[![Daily Downloads](https://poser.pugx.org/davidjeddy/codecept-yii2-migration-runner/d/daily?format=flat-square)](https://packagist.org/packages/davidjeddy/codecept-yii2-migration-runner)
[![composer.lock](https://poser.pugx.org/davidjeddy/codecept-yii2-migration-runner/composerlock?format=flat-square)](https://packagist.org/packages/davidjeddy/codecept-yii2-migration-runner)

~Add Sensiolabs quality here~

# REQUIREMENTS

[PHP 5.6+](http://php.net/)

[Composer](https://getcomposer.org/)

[Codeception 2.3+](http://codeception.com/)

[Usage of Codeception's Database module](http://codeception.com/docs/modules/Db)

Important: You must have creditials for a user with permission to create a database schema.

# INSTALLATION
 + `cd {project root}`
 + Run `composer require davidjeddy/codecept-yii2-migration-runner` in terminal
     + OR add `"davidjeddy/codecept-yii2-migration-runner": "dev-master@dev"` to your project's  `composer.json`, then run `composer update`.

# CONFIGURATION

Edit codeception.yml adding the migration commands

# USAGE

 - Recreate a database scheme named `{TEST_DB_SCHEMA}-remigrate`.
 - Execute the Codeception build command.
 - Run Codeception test suite.
