<?php

namespace Xefi\Faker\Extensions;

use Xefi\Faker\Extensions\Traits\HasLocale;

class PersonExtension extends Extension
{
    // @TODO: base locale ?
    use HasLocale;

    /**
     * The extension locale (BCP 47 Code).
     *
     * @return string | null
     */
    public function getLocale(): string|null
    {
        return null;
    }

    protected $firstNameMale = [
        'John',
    ];

    protected $firstNameFemale = [
        'Jane',
    ];

    protected $lastName = ['Doe'];

    protected $titleMale = ['Mr.', 'Dr.', 'Prof.'];

    protected $titleFemale = ['Mrs.', 'Ms.', 'Miss', 'Dr.', 'Prof.'];

    /**
     * @param string|null $gender 'male', 'female' or null for any
     *
     * @return string
     *
     * @example 'John Doe'
     */
    public function name($gender = null)
    {
        if ($gender === static::GENDER_MALE) {
            $format = static::randomElement(static::$maleNameFormats);
        } elseif ($gender === static::GENDER_FEMALE) {
            $format = static::randomElement(static::$femaleNameFormats);
        } else {
            $format = static::randomElement(array_merge(static::$maleNameFormats, static::$femaleNameFormats));
        }

        return $this->generator->parse($format);
    }
}
