<?php

declare(strict_types=1);

namespace Engelsystem\Events\Listener;

use Engelsystem\Mail\EngelsystemMailer;
use Engelsystem\Models\User\User;
use Engelsystem\Models\User\VerifyEmail;
use Psr\Log\LoggerInterface;

class Users
{
    public function __construct(
        protected LoggerInterface $log,
        protected EngelsystemMailer $mailer
    ) {
    }

    public function created(User $user, bool $selfSignUp = true): void
    {
//      if (config('app.config_options.features.config.enforce_email_validation') === True) {
            $verify = (new VerifyEmail())->findOrNew($user->id);
            $verify->user_id = $user->id;
            $verify->token = bin2hex(random_bytes(16));
            $verify->save();

            $this->mailer->sendViewTranslated(
                $user,
                ($selfSignUp) ? 'notification.registered' : 'notification.registered.supporter',
                'emails/user-created',
                [
                    'selfSignUp' => $selfSignUp,
                    'username' => $user->name,
                    'token' => $verify->token,
                ],
            );
//      } else {
//          $user->update(['verified_at' => Carbon::now()]);
//      }
    }
}
