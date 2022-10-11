<?php

namespace Ogunsakindamilola\ActiveHousing\Tests\Unit;

use Ogunsakindamilola\ActiveHousing\ActiveHousingService;
use PHPUnit\Framework\TestCase;

class ActiveHousingServiceTest extends TestCase
{

    public function test_can_get_user_successfully()
    {
        $activeHousing = (new ActiveHousingService())->getUser(2);
        $this->assertTrue($activeHousing['success']);
        $this->assertArrayHasKey('id', $activeHousing['data']);
        $this->assertEquals($activeHousing['data']['id'], 2);
        $this->assertArrayHasKey('email', $activeHousing['data']);
        $this->assertArrayHasKey('first_name', $activeHousing['data']);
        $this->assertArrayHasKey('last_name', $activeHousing['data']);
        $this->assertArrayHasKey('avatar', $activeHousing['data']);
    }

    public function test_can_not_get_user_from_bad_resource()
    {
        $activeHousing = (new ActiveHousingService())->getUser(2, 'lorem');
        $this->assertFalse($activeHousing['success']);
    }

    public function test_can_get_paginated_users_successfully(){
        $activeHousing = (new ActiveHousingService())->getPaginatedUsers(1);
        $this->assertTrue($activeHousing['success']);
        $this->assertArrayHasKey(0, $activeHousing['data']);
        $this->assertArrayHasKey('id', $activeHousing['data'][0]);
        $this->assertEquals($activeHousing['data'][0]['id'], 1);
        $this->assertArrayHasKey('email', $activeHousing['data'][0]);
        $this->assertArrayHasKey('first_name', $activeHousing['data'][0]);
        $this->assertArrayHasKey('last_name', $activeHousing['data'][0]);
        $this->assertArrayHasKey('avatar', $activeHousing['data'][0]);
    }

    public function test_can_not_get_paginated_users_from_bad_resource()
    {
        $activeHousing = (new ActiveHousingService())->getPaginatedUsers(2, 'lorem');
        $this->assertFalse($activeHousing['success']);
    }

}
