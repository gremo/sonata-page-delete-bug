<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Sonata\PageBundle\Entity\BaseSnapshot;

#[ORM\Entity]
#[ORM\Table(indexes: [
    new ORM\Index(columns: ['publication_date_start', 'publication_date_end', 'enabled'])
])]
class SonataPageSnapshot extends BaseSnapshot
{
    #[ORM\Id]
    #[ORM\Column(type: Types::INTEGER)]
    #[ORM\GeneratedValue]
    protected $id;
}
