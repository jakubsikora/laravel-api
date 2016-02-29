<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ApiTester extends TestCase
{
    use WithoutMiddleware;
    use DatabaseMigrations;

    protected $fake;

    protected $times = 1;

    function __construct()
    {
        $this->fake = Faker::create();
    }

    public function setUp()
    {
        parent::setUp();
    }

    protected function times($count)
    {
        $this->times = $count;

        return $this;
    }

    protected function getJson($uri)
    {
        return json_decode($this->call('GET', $uri)->getContent());
    }

    protected function assertObjectHasAttributes()
    {
        $args = func_get_args();
        $object = array_shift($args);

        foreach ($args as $attribute)
        {
            $this->assertObjectHasAttribute($attribute, $object);
        }
    }
}