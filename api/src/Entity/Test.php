<?php

namespace App\Entity;


use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;


#[ApiResource(
    description: 'Resource này đã lỗi thời và sẽ sớm bị loại bỏ. Vui lòng chuyển sang sử dụng Order mới.',
    deprecationReason: true
)]
class Test
{
    #[ORM\Id, ORM\GeneratedValue, ORM\Column]
    public ?int $id = null;

    #[ORM\Column]
    public string $legacyCode;
}