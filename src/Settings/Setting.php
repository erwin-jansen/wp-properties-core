<?php

namespace Eliteforever\WPPropertiesCore\Settings;

use Eliteforever\WPPropertiesCore\Property;
use Eliteforever\WPPropertiesCore\PropertyBuilderInterface;

class Setting extends Property
{
    public static function createType(): PropertyBuilderInterface
    {
        return new SettingBuilder();
    }

    public function load()
    {
        return get_option($this->identifier);
    }

    public function store($value)
    {
        if ($this->internalValue) {
            if (!update_option($this->identifier, $value)) {
                throw new \InvalidArgumentException(
                    "Could not update option {$this->identifier} with $value. 
                Debug the internal 'update_option' call to find out why."
                );
            }
        } else {
            delete_option($this->identifier);
        }
    }
}
