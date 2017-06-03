<?php
/**
 * Yii2.x Migration Runner
 *
 * The Codeception extension to automatically run the Yii2 migrations and provide the results as a SQL dump.
 */

namespace Codeception\Extension;

use Codeception\Exception\ExtensionException;
use Codeception\Lib\Driver\Db as Driver;

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
        'tempSchema'=> null,
        'defaultEncoding' => 'DEFAULT CHARACTER SET utf8',
        'command'   => [
            'php ./tests/codeception/bin/yii app/setup --interactive=0',
            'php ./tests/codeception/bin/yii migration --interactive=0',
            'php ./tests/codeception/bin/yii rbac-migration --interactive=0',
        ]
    ];

    /**
     * Database Host
     * @var
     */
    public $dbh;

    /**
     * @var \Codeception\Lib\Driver\Db
     */
    public $driver;

    /**
     * @var string
     */
    protected $sql = null;

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
        $this->defaultConfig['tempSchema'] = 'yii2-starter-kit-' . time();

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
        echo 'asdf';exit(1);
        $this->connect();

        $this->createSchema();

        foreach ($this->defaultConfig['command'] as $key => $command) {
            exec($command);
        }

        $this->dropDatabase();
    }

    /**
     * @source \Codeception\Module\Db->connection()
     */
    private function connect()
    {
        try {
            $this->driver = Driver::create($this->config['dsn'], $this->config['user'], $this->config['password']);
        } catch (\PDOException $e) {
            $message = $e->getMessage();
            if ($message === 'could not find driver') {
                list ($missingDriver, ) = explode(':', $this->config['dsn'], 2);
                $message = "could not find $missingDriver driver";
            }

            throw new ExtensionException(__CLASS__, $message . ' while creating PDO connection');
        }

        $this->dbh = $this->driver->getDbh();
    }

    /**
     *
     */
    private function createSchema()
    {
        $this->sql = "CREATE SCHEMA " . $this->defaultConfig['tempSchema'] . " " . !isset($this->defaultConfig['defaultEncoding'])
            ? " DEFAULT CHARACTER SET utf8"
            : (string)$this->defaultConfig['defaultEncoding'] . ';';
    }

    /**
     *
     */
    private function dropDatabase()
    {
        $this->sql = "DROP DATABASE " . $this->defaultConfig['tempSchema'] . " " . !isset($this->defaultConfig['defaultEncoding'])
            ? " DEFAULT CHARACTER SET utf8"
            : (string)$this->defaultConfig['defaultEncoding'] . ';';
        $this->execCommand();
    }

    /**
     *
     */
    private function execCommand()
    {
        if (!$this->sql) {
            return;
        }

        try {
            $this->driver->load($this->sql);
        } catch (\PDOException $e) {
            throw new \PDOException(
                __CLASS__,
                $e->getMessage() . "\nSQL query being executed: " . $this->driver->sqlToRun
            );
        }
    }
}