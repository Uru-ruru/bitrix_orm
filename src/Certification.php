<?php

namespace App\Models\ORM;

use Bitrix\Iblock\Elements\EO_ElementCertifications;
use Bitrix\Main\ArgumentException;
use Bitrix\Main\EO_User;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\ORM\Objectify\EntityObject;
use Bitrix\Main\SystemException;
use Bitrix\Main\UserTable;

/**
 * @package App\Models\ORM
 */
class Certification extends EO_ElementCertifications
{
    /**
     * @return EntityObject|LevelsTable|null
     * @throws ArgumentException
     * @throws ObjectPropertyException
     * @throws SystemException
     */
    public function getLevelRef(): ?EntityObject
    {
        $levelId = $this->getLevel() ? $this->getLevel()->getValue() : null;
        if ($levelId) {
            return LevelsTable::getById($levelId)->fetchObject();
        }
        return null;
    }

    /**
     * @return EO_User|null
     * @throws ArgumentException
     * @throws ObjectPropertyException
     * @throws SystemException
     */
    public function getDeveloperRef(): ?EO_User
    {
        $userId = $this->getDeveloper() ? $this->getDeveloper()->getValue() : null;
        if ($userId) {
            return UserTable::getById($userId)->fetchObject();
        }
        return null;
    }
}
