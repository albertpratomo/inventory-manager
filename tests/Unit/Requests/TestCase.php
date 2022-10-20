<?php

namespace Tests\Unit\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\ParameterBag;
use Tests\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * The FormRequest instance that is being tested.
     */
    protected ?FormRequest $request = null;

    /**
     * Prepare the FormRequest instance.
     */
    protected function prepareFormRequest(string $class, User $user = null): void
    {
        if (is_null($this->request)) {
            $this->request = new $class([], [], [], [], [], [
                'CONTENT_TYPE' => 'application/json',
            ]);

            $this->request->setContainer(app())->setRedirector(redirect());

            if ($user) {
                $this->request->setUserResolver(fn () => $user);
            }
        }
    }

    /**
     * Set request with the data that will be validated.
     */
    protected function setRequestData(array $data): void
    {
        $this->request->setJson(new ParameterBag($data));
    }

    /**
     * Validate the request and assert that the validation passes.
     */
    protected function assertPasses(array $data = null): void
    {
        if ($data) {
            $this->setRequestData($data);
        }

        $this->request->validateResolved();

        $this->assertJsonStructureSnapshot($this->request->validated());
    }

    /**
     * Validate the request and assert that the validation fails.
     */
    protected function assertFails(array $data = null): void
    {
        if ($data) {
            $this->setRequestData($data);
        }

        $this->expectException(ValidationException::class);

        try {
            $this->request->validateResolved();
        } catch (ValidationException $exception) {
            $this->assertMatchesJsonSnapshot($exception->errors());

            throw $exception;
        }
    }

    /**
     * Assert the rules using snapshots.
     */
    protected function assertRulesSnapshot(): void
    {
        $this->assertMatchesJsonSnapshot(json_encode($this->request->rules()));
    }

    /**
     * Mock the request route parameters. Either send in a key and value to mock
     * a single route parameter or a key/value array to mock multiple.
     */
    protected function setRequestRouteParameters(string|array $parameters, mixed $value = null): void
    {
        if ($value !== null) {
            $parameters = [$parameters => $value];
        }

        $this->request->setRouteResolver(function () use ($parameters) {
            $stub = $this->createStub(Route::class);

            foreach ($parameters as $key => $value) {
                $stub->expects($this->any())->method('hasParameter')->with($key)->willReturn(true);

                $stub->expects($this->any())->method('parameter')->with($key)->willReturn($value);
            }

            return $stub;
        });
    }
}
