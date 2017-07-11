<?php
/**
 * Codeception Yii2.x DaMigration Runner
 *
 * The Codeception extension to automatically run the Yii2 migrations and provide the results as a SQL dump.
 */

namespace Codeception\Extension;

use Codeception\Exception\ExtensionException;
use Codeception\Lib\Driver\Db as Driver;
use Codeception\Events;
use Codeception\Extension;

/**
 * Class Yii2MigrationRunner
 * @package Codeception\Extension
 */
class Yii2MigrationRunner extends Extension
{
    /**
     * @var null
     */
    protected $config = null;

    /**
     * @var \Codeception\Lib\Driver\Db
     */
    public $driver;

    /**
     * @var string
     */
    protected $sql = null;

    /**
     * @var null
     */
    protected $originalDSN = null;

    /**
     * @var array
     */
    public static $events = [
        Events::SUITE_BEFORE => 'suiteBefore'
    ];

    /**
     * Yii2MigrationRunner constructor.
     * @param $config
     * @param $options
     */
    public function __construct($config, $options)
    {
        $this->config = \Yii::$app->components['db'];
        parent::__construct($config, $options);
    }

    /**
     * This is what runs the Yii2 migration command(s); remember we hijack the DSN connection so to direct the output
     * to a temp schema.
     *
     * @param \Codeception\Event\SuiteEvent $e
     */
    public function suiteBefore(\Codeception\Event\SuiteEvent $e)
    {
        $this->connect();

        $this->createSchema();

        $this->runCommands();

        $this->dumpDatabase();
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
    }

    /**
     *
     */
    private function createSchema()
    {
        $this->sql[] = 'DROP DATABASE IF EXISTS `' . $this->config['dbname'] . '`;';
        $this->sql[] = 'CREATE SCHEMA `' . $this->config['dbname'] . '` DEFAULT CHARACTER SET ' . $this->config['charset'] .';';
        $this->sql[] = 'USE `' . $this->config['dbname'] . '`;';

        try {
            $this->execCommand();
        } catch (\Error $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @throws \Exception
     */
    private function runCommands()
    {

        if (stristr('&&', $this->config['command'])) {
            $commands = explode('&& ', $this->config['command']);
        } else {
            $commands[] = $this->config['command'];
        }

        foreach ($commands as $command) {

            try {
                // function exec ($command, array &$output = null, &$return_var = null) {}
                exec($command, $output, $returnVar);

                print_r($output);

                if ($returnVar !== 0) {
                    throw new \Exception('Command failed with return code ' .  $returnVar);
                }
            } catch (\Exception $e) {
                throw new \Exception($e->getMessage(), 1);
            }
        }
    }

    /**
     * @param $
     */
    private function dumpDatabase()
    {
        echo "dumping database to " . $this->config['dumpTarget'] . "\n";

        try {
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 1);
        }
    }
}