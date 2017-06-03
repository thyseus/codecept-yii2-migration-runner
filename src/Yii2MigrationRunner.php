<?php
/**
 * Yii2.x Migration Runner
 *
 * The Codeception extension to automatically run the Yii2 migrations and provide the results as a SQL dump.
 */

namespace Codeception\Extension;

use Codeception\Exception\ExtensionException;

/**
 * Class Yii2MigrationRunner
 * @package Codeception\Extension
 */
class Yii2MigrationRunner extends \Codeception\Platform\Extension
{
    private $defaultConfig = [
        'dsn'       => 'dsn: mysql:host=db;port=3306;dbname=yii2-starter-kit-test',
        'dumpTarget'=> '../_data/dump.sql',
        'password'  => 'root',
        'user'      => 'root',
        'tempSchema'=> 'yii2-starter-kit-temp',
        'command'   => [
            'php ./tests/codeception/bin/yii migration/up --interactive=0'
        ]
    ];

    /**
     * Original database creditials including schema name.
     *
     * @var string
     */
    private $originalDBCredentials = null;

    /**
     * @var array
     */
    static $events = [
        'suite.init' => 'suiteInit', # codeception.event = class.method
    ];

    /**
     * Yii2MigrationRunner constructor.
     * @param $config
     * @param $options
     */
    public function __construct($config, $options)
    {
        parent::__construct($config, $options);
    }

    /**
     * This is what runs the Yii2 migration command(s); remember we hijack the DSN connection so to direct the output
     * to a temp schema.
     *
     * @param \Codeception\Event\SuiteEvent $e
     */
    public function suiteInit(\Codeception\Event\SuiteEvent $e)
    {
    }

    /**
     * Run the migrations defined in the extensions config
     */
    private function executeCommand()
    {

    }

    private function createTempDSN()
    {

    }

    private function executeDump()
    {

    }
}