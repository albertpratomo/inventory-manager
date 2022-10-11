<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use OwowAgency\Snapshots\MatchesSnapshots;
use Tests\Concerns\CreatesApplication;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, MatchesSnapshots;
}
