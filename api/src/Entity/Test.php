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

    /** @var string the legacy code */
    #[ORM\Column]
    public string $legacyCode;


    public function getLegacyCode(): string
    {
        return $this->legacyCode;
    }

    public function setLegacyCode(string $legacyCode): void
    {
        $this->legacyCode = $legacyCode;
    }


}