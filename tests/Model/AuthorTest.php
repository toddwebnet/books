<?php

namespace Tests\Model;

use App\Models\Author;
use App\Models\Book;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;


class AuthorTest extends ModelBaseTestCase
{

    public function testAuthorAdd()
    {

        $this->factoryModelTest(Author::class);


        $nullData = [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName
        ];
        $this->nullFieldNameCheck(Author::class, $nullData);

    }

}
