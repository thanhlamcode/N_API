<?php

namespace App\MessageHandler;

use App\DTO\ResetPasswordRequest;
use App\Service\PasswordResetService;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly class ResetPasswordMessageHandler
{
    public function __construct(
        private PasswordResetService $resetService,
        private MailerInterface      $mailer
    ) {}

    /**
     * @throws TransportExceptionInterface
     */
    public function __invoke(ResetPasswordRequest $message): void
    {
        $resetToken = $this->resetService->createResetToken($message->email);
        $link = sprintf('http://localhost:8000/reset-password?token=%s', $resetToken->token);

        $email = (new Email())
            ->from('noreply@yourdomain.com')
            ->to($message->email)
            ->subject('Reset Your Password')
            ->html("
                <p>Hello,</p>
                <p>Click the link below to reset your password:</p>
                <p><a href='$link'>$link</a></p>
                <p>This link will expire in 1 hour.</p>
            ");

        $this->mailer->send($email);
    }
}
