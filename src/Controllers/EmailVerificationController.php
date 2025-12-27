<?php

declare(strict_types=1);

namespace Engelsystem\Controllers;

use Engelsystem\Config\Config;
use Engelsystem\Http\Exceptions\HttpNotFound;
use Engelsystem\Http\Request;
use Engelsystem\Http\Response;
use Engelsystem\Models\User\VerifyEmail;

class EmailVerificationController extends BaseController
{
    public function __construct(protected Response $response, protected Config $config)
    {
    }

    public function resend(): void
    {
    }

    public function postResend(Request $request): void
    {
    }

    public function verifyEmail(Request $request)
    {

        $this->requireToken($request);

        return $this->showView(
            'pages/password/reset-form',
            ['min_length' => config('password_min_length')]
        );
    }

    public function postVerifyEmail(Request $request): void
    {

    }

    protected function requireToken(Request $request): VerifyEmail
    {
        $token = $request->getAttribute('token');

        /** @var VerifyEmail|null $reset */
        $reset = VerifyEmail::whereToken($token)->first();

        if (!$reset) {
            throw new HttpNotFound();
        }

        return $reset;
    }
}
