<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Arr;
use Illuminate\Testing\TestResponse;
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

    /**
     * Assert that the session data are as previously snapshotted.
     */
    public function assertSession(TestResponse $response, ?array $keys = null): void
    {
        $session = $response->getSession();

        $data = is_null($keys)
            ? $session->all()
            : $session->only(Arr::wrap($keys));

        if (array_key_exists('errors', $data)) {
            $data['errors'] = $data['errors']->toArray();
        }

        $this->assertMatchesSnapshot($data);
    }
}
