<?php

namespace App\JsonApi\V20220101;

use LaravelJsonApi\Core\Server\Server as BaseServer;

class Server extends BaseServer
{
    /**
     * The base URI namespace for this server.
     *
     * @var string
     */
    protected string $baseUri = '/api/v20220101';

    /**
     * Bootstrap the server when it is handling an HTTP request.
     *
     * @return void
     */
    public function serving(): void
    {
        // no-op
    }

    /**
     * Get the server's list of schemas.
     *
     * @return array
     */
    protected function allSchemas(): array
    {
        return [
            Environments\EnvironmentSchema::class,
            Projects\ProjectSchema::class,
            Targets\TargetSchema::class,
            Teams\TeamSchema::class,
            Users\UserSchema::class,
        ];
    }
}
