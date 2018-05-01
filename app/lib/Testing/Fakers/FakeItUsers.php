<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 09/08/2015
 * Time: 21:39
 */

namespace Chicane\Testing\Fakers;


use Faker\Factory as Faker;
use Chicane\Repositories\Storage\User\Eloquent\EloquentUserRepository as User;

class FakeItUsers implements FakeDataCreatorInterface
{

    protected $faker;

    protected $user;

    /**
     * FakeItUsers constructor.
     */
    public function __construct(Faker $faker, User $user)
    {
        $this->faker = $faker->create();
        $this->user = $user;
    }

    public function createData($rows)
    {
        try
        {
            for ($i = 0; $i <= $rows; $i++)
            {
                $this->user->create($this->userArrayData());
            }

        }
        catch(\Exception $e)
        {
            echo 'something happens'. $e;
        }

        return true;

    }

    private function userArrayData()
    {
        $arrayUser =
            ['first_name' => $this->faker->name,
            'last_name' => $this->faker->lastName,
            'username_register' => $this->faker->userName . $this->faker->randomNumber(7),
            'email-register'=> $this->faker->userName .$this->faker->randomNumber(4). _('@') . $this->faker->freeEmailDomain,
            'password-register' => $this->faker->password(6,20)
            ];

        return $arrayUser;
    }



}