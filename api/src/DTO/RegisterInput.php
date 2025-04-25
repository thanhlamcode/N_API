<?php

namespace App\DTO;

use ApiPlatform\Metadata\ApiProperty;
use Symfony\Component\Validator\Constraints as Assert;

class RegisterInput
{
    public function __construct(
        #[ApiProperty]
        #[Assert\NotBlank]
        public string $username = '',

        #[ApiProperty]
        #[Assert\NotBlank]
        #[Assert\Length(min: 6)]
        public string $password = ''
    ) {}
}



