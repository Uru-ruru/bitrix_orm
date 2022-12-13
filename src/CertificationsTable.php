<?php

namespace App\Models\ORM;

use Bitrix\Iblock\Elements\ElementCertificationsTable;

/**
 * @package App\Models\ORM
 */
class CertificationsTable extends ElementCertificationsTable
{

    public static function getObjectClass(): string
    {
        return Certification::class;
    }


}
