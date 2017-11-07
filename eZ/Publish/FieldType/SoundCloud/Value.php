<?php

namespace Goth\EzPlatformSoundCloudFieldTypeBundle\eZ\Publish\FieldType\SoundCloud;

use eZ\Publish\Core\FieldType\Value as BaseValue;

class Value extends BaseValue
{
    /**
     * @var string
     */
    public $url;

    /**
     * @return string
     */
    public function __toString() : string
    {
        return (string)$this->url;
    }
}