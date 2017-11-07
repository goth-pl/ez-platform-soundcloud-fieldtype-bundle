<?php

namespace Goth\EzPlatformSoundCloudFieldTypeBundle\eZ\Publish\FieldType\SoundCloud;

use eZ\Publish\Core\Base\Exceptions\InvalidArgumentType;
use eZ\Publish\Core\FieldType\FieldType;
use eZ\Publish\SPI\FieldType\Value as SPIValue;
use eZ\Publish\Core\FieldType\Value as CoreValue;
use eZ\Publish\API\Repository\Values\ContentType\FieldDefinition;
use eZ\Publish\SPI\Persistence\Content\FieldValue as PersistenceValue;
use eZ\Publish\Core\FieldType\ValidationError;

class Type extends FieldType
{
    const SOUNDCLOUD_REGEX = '/^(?:https?\:\/\/)?(?:www\.)?soundcloud\.com\/([a-z0-9\_\-]+){1}(?:\/([a-z0-9\_\-]+))?$/';

    /**
     * @param FieldDefinition $fieldDefinition
     * @param SPIValue $fieldValue
     *
     * @return array
     */
    public function validate(FieldDefinition $fieldDefinition, SPIValue $fieldValue) : array
    {
        $errors = array();

        if ($this->isEmptyValue($fieldValue)) {
            return $errors;
        }

        if (!preg_match(self::SOUNDCLOUD_REGEX, $fieldValue->url, $matches)) {
            $errors[] = new ValidationError(
                'Invalid SoundCloud URL %url%',
                null,
                ['%url%' => $fieldValue->url]
            );
        }

        return $errors;
    }

    /**
     * @return Value
     */
    public function getEmptyValue()
    {
        return new Value();
    }

    /**
     * @param mixed $hash
     *
     * @return Value
     */
    public function fromHash($hash) : Value
    {
        if ($hash === null) {
            return $this->getEmptyValue();
        }

        return new Value($hash);
    }

    /**
     * @param SPIValue $value
     *
     * @return array|null
     */
    public function toHash(SPIValue $value)
    {
        if ($this->isEmptyValue($value)) {
            return null;
        }

        return array(
            'url' => $value->url
        );
    }

    /**
     * @param PersistenceValue $fieldValue
     *
     * @return Value
     */
    public function fromPersistenceValue(PersistenceValue $fieldValue) : Value
    {
        if ($fieldValue->data === null) {
            return $this->getEmptyValue();
        }

        return new Value($fieldValue->data);
    }

    /**
     * @param SPIValue $value
     *
     * @return PersistenceValue
     */
    public function toPersistenceValue(SPIValue $value) : PersistenceValue
    {
        if ($value === null) {
            return new PersistenceValue(
                array(
                    'data' => null,
                    'externalData' => null,
                    'sortKey' => null,
                )
            );
        }

        return new PersistenceValue(
            array(
                'data' => $this->toHash($value),
                'sortKey' => $this->getSortInfo($value),
            )
        );
    }

    /**
     * @param SPIValue $value
     * @param FieldDefinition $fieldDefinition
     * @param string $languageCode
     *
     * @return string
     */
    public function getFieldName(SPIValue $value, FieldDefinition $fieldDefinition, string $languageCode) : string
    {
        return preg_replace(
            self::SOUNDCLOUD_REGEX,
            '$1-$2',
            (string)$value->url
        );
    }

    /**
     * @param CoreValue $value
     *
     * @return string
     */
    protected function getSortInfo(CoreValue $value) : string
    {
        return (string)$value->url;
    }

    /**
     * @return string
     */
    public function getFieldTypeIdentifier() : string
    {
        return 'goth_soundcloud';
    }

    /**
     * @param SPIValue $value
     *
     * @return string
     */
    public function getName(SPIValue $value) : string
    {
        return 'goth_soundcloud';
    }

    /**
     * @param mixed $inputValue
     *
     * @return Value|mixed
     */
    protected function createValueFromInput($inputValue)
    {
        if (is_array($inputValue)) {
            return new Value($inputValue);
        }

        return $inputValue;
    }

    /**
     * @param CoreValue $value
     *
     * @throws InvalidArgumentType
     */
    protected function checkValueStructure(CoreValue $value)
    {
        if (!is_string($value->url)) {
            throw new InvalidArgumentType(
                '$value->url',
                'string',
                $value->url
            );
        }
    }


}