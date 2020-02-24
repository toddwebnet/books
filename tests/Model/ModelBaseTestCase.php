<?php

namespace Tests\Model;

use Faker\Factory as Faker;
use Illuminate\Database\QueryException;
use Tests\DBTestCase;

class ModelBaseTestCase extends DBTestCase
{

    protected $faker;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->faker = Faker::create();
    }

    /**
     * performs tests using factory to ensure new elements are added
     * @param $modelClass
     */
    protected function factoryModelTest($modelClass)
    {
        $numUsersToAdd = 10;

        $firstCount = $modelClass::count();

        $addedUsers = [];
        for ($x = 0; $x < $numUsersToAdd; $x++) {
            $addedUsers[] = factory($modelClass)->create();
        }
        $secondCount = $modelClass::count();

        // clean up
        $this->assertEquals($numUsersToAdd, $secondCount - $firstCount);
        foreach($addedUsers as $user){
            $user->delete();
        }

        // assuring back to normal count
        $this->assertEquals($modelClass::count(), $firstCount);
    }

    /**
     * uses factory to test for null values being put into the database
     * @param $modelClass
     * @param $nullData
     */
    protected function nullFieldNameCheck($modelClass, $nullData)
    {

        foreach (array_keys($nullData) as $key) {
            $tempData = $nullData;
            $tempData[$key] = null;
            $expected = "Failed Testing Null value for {$key}";
            $actual = 'no pass';
            try {
                factory($modelClass)->create($tempData);
            } catch (QueryException $e) {
                $actual = $expected;
            }
            $this->assertEquals($expected, $actual);
        }
    }
}
