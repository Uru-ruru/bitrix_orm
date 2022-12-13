<?php

namespace App\Models\ORM;

use Bitrix\Main\ArgumentTypeException;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\Relations\Reference;
use Bitrix\Main\ORM\Fields\StringField;
use Bitrix\Main\ORM\Fields\Validators\LengthValidator;
use Bitrix\Main\ORM\Query\Join;
use Bitrix\Main\SystemException;

Loc::loadMessages(__FILE__);

/**
 * Class LevelsTable
 *
 * Fields:
 * <ul>
 * <li> ID int mandatory
 * <li> UF_LEVEL_TITLE string(255) optional
 * <li> UF_LEVEL_NAME string(255) optional
 * <li> UF_PARENT_LEVEL int optional
 * <li> UF_IMAGE string(255) optional
 * <li> UF_LINK string(255) optional
 * </ul>
 *
 * @package Bitrix\Levels
 *
 * @method string getLevelTitle()
 * @method string getLevelName()
 * @method int getParentLevel()
 * @method LevelsTable getParentLevelRef()
 * @method string getImage()
 * @method string getLink()
 **/
class LevelsTable extends DataManager
{
    /**
     * Returns DB table name for entity.
     *
     * @return string
     */
    public static function getTableName(): string
    {
        return 'cert_levels';
    }

    /**
     * Returns entity map definition.
     *
     * @return array
     * @throws SystemException
     */
    public static function getMap(): array
    {
        return [
            'ID' => (new IntegerField(
                'ID',
                []
            ))->configureTitle(Loc::getMessage('LEVELS_ENTITY_ID_FIELD'))
                ->configurePrimary(true)
                ->configureAutocomplete(true),
            'LEVEL_TITLE' => (new StringField(
                'LEVEL_TITLE',
                [
                    'column_name' => 'UF_LEVEL_TITLE',
                    'validation' => [__CLASS__, 'validateUfLevelTitle']
                ]
            ))->configureTitle(Loc::getMessage('LEVELS_ENTITY_UF_LEVEL_TITLE_FIELD')),
            'LEVEL_NAME' => (new StringField(
                'LEVEL_NAME',
                [
                    'column_name' => 'UF_LEVEL_NAME',
                    'validation' => [__CLASS__, 'validateUfLevelName']
                ]
            ))->configureTitle(Loc::getMessage('LEVELS_ENTITY_UF_LEVEL_NAME_FIELD')),
            'PARENT_LEVEL' => (new IntegerField(
                'PARENT_LEVEL',
                [
                    'column_name' => 'UF_PARENT_LEVEL',
                ]
            ))->configureTitle(Loc::getMessage('LEVELS_ENTITY_UF_PARENT_LEVEL_FIELD')),
            'PARENT_LEVEL_REF' => (new Reference(
                'PARENT_LEVEL_REF',
                __CLASS__,
                Join::on('this.PARENT_LEVEL', 'ref.ID')
            )),
            'IMAGE' => (new StringField(
                'IMAGE',
                [
                    'column_name' => 'UF_IMAGE',
                    'validation' => [__CLASS__, 'validateUfImage']
                ]
            ))->configureTitle(Loc::getMessage('LEVELS_ENTITY_UF_IMAGE_FIELD')),
            'LINK' => (new StringField(
                'LINK',
                [
                    'column_name' => 'UF_LINK',
                    'validation' => [__CLASS__, 'validateUfLink']
                ]
            ))->configureTitle(Loc::getMessage('LEVELS_ENTITY_UF_LINK_FIELD')),
        ];
    }

    /**
     * Returns validators for UF_LEVEL_TITLE field.
     *
     * @return array
     * @throws ArgumentTypeException
     */
    public static function validateUfLevelTitle(): array
    {
        return [
            new LengthValidator(null, 255),
        ];
    }

    /**
     * Returns validators for UF_LEVEL_NAME field.
     *
     * @return array
     * @throws ArgumentTypeException
     */
    public static function validateUfLevelName(): array
    {
        return [
            new LengthValidator(null, 255),
        ];
    }

    /**
     * Returns validators for UF_IMAGE field.
     *
     * @return array
     * @throws ArgumentTypeException
     */
    public static function validateUfImage(): array
    {
        return [
            new LengthValidator(null, 255),
        ];
    }

    /**
     * Returns validators for UF_LINK field.
     *
     * @return array
     * @throws ArgumentTypeException
     */
    public static function validateUfLink(): array
    {
        return [
            new LengthValidator(null, 255),
        ];
    }
}
