<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use OwowAgency\Snapshots\MatchesSnapshots;
use Tests\Concerns\CreatesApplication;
use Tests\Concerns\RefreshDatabase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, MatchesSnapshots, RefreshDatabase;

    /**
     * Boot the testing helper traits.
     *
     * @return array
     */
    protected function setUpTraits()
    {
        $uses = parent::setUpTraits();

        $this->refreshDatabase();

        return $uses;
    }
}
