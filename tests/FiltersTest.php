<?php

namespace Dcblogdev\Filters\Tests;

use Dcblogdev\Filters\Filters;
use PHPUnit\Framework\TestCase;

class FiltersTest extends TestCase
{
    public function testBuildQuery()
    {
        $json = '{"test":["1234"],"filterTitle":"test"}';
        $data = json_decode($json, true);
        $filters = new Filters();
        $result = $filters->buildQuery($data);
        self::assertEquals('test%5B0%5D=1234&filterTitle=test', $result);
    }
}
