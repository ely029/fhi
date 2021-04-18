<?php

namespace Tests\Unit;

use App\Exceptions\HttpApiException;
use App\Http\Middleware\SuperAdmin;
use App\Models\User;
use Request;
use Tests\TestCase;

class SuperAdminMiddlewareTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testNotSuperAdminAreForbidden()
    {
        $approverAdmin = User::factory()->make([
            'role_id' => 2,
        ]);

        $this->actingAs($approverAdmin);

        $request = Request::create('/dashboard/users');
        $e = '';

        try {
            $this->handleRequestWithMustBeSuperAdminMiddleware($request);
        } catch (\Exception $e) {

        }
        $this->assertEquals(
            new HttpApiException('', '', null, 403),
            $e
        );

    }

    public function testSuperAdminAreAllowed()
    {
        $superAdmin = User::factory()->make([
            'role_id' => 1,
        ]);

        $this->actingAs($superAdmin);

        $request = Request::create('/dashboard/users');
        $response = '';

        try {
            $response = $this->handleRequestWithMustBeSuperAdminMiddleware($request);
        } catch (\Exception $e) {

        }
        $this->assertEquals($response, null);

    }

    protected function handleRequestWithMustBeSuperAdminMiddleware($request) {
        $middleware = new SuperAdmin;
        $middleware->handle($request, function () {});
    } 
}
