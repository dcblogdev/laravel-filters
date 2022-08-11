<?php

namespace Daveismyname\Filters\Tests;

use Daveismyname\Filters\Filters;
use PHPUnit\Framework\TestCase;

class FiltersTest extends TestCase
{
    public function testBuildQuery()
    {
        $json = '{"test":["1234"],"filterTitle":"test"}';
        $data = json_decode($json, true);
        $filters = new Filters();
        $result = $filters->buildQuery($data);
        var_dump($result);
    }
}