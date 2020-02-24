<?php

namespace Tests;

abstract class DBTestCase extends TestCase
{

    protected function setUp()
    {
        parent::setUp();

        if (!defined('TEST_DB_RESPAWNED')) {
            $dbPath = $this->dbPath();
            if (file_exists($dbPath)) {
                unlink($dbPath);
            }
            touch($dbPath);
            $this->artisan('migrate:refresh');
            $this->artisan('db:seed');
            define('TEST_DB_RESPAWNED', true);
        }
    }

    protected function tearDown()
    {

        if (defined('TEST_DB_RESPAWNED')) {
            $dbPath = $this->dbPath();
            if (file_exists($dbPath)) {
                unlink($dbPath);
            }
        }
        parent::tearDown();
    }

    private function dbPath()
    {
        return $dbPath = storage_path() . '/phpunit.db';
    }




}
