<?php

namespace Xefi\Faker\Extensions;

use Xefi\Faker\Extensions\Traits\HasLocale;

class PersonExtension extends Extension
{
    use HasLocale;

    public const GENDER_MALE = 'M';
    public const GENDER_FEMALE = 'F';

    protected $firstNameMale = [
        'John',
        'James',
        'Robert',
        'Michael',
        'David',
        'William',
        'Richard',
        'Joseph',
        'Charles',
        'Thomas',
        'Daniel'
    ];

    protected $firstNameFemale = [
        'Jane',
        'Mary',
        'Linda',
        'Patricia',
        'Barbara',
        'Elizabeth',
        'Jennifer',
        'Susan',
        'Margaret',
        'Dorothy',
        'Sarah'
    ];

    protected $lastName = [
        'Doe',
        'Smith',
        'Johnson',
        'Brown',
        'Taylor',
        'Anderson',
        'Thomas',
        'White',
        'Harris',
        'Martin',
        'Thompson'
    ];

    protected $titleMale = ['Mr.', 'Dr.', 'Prof.'];

    protected $titleFemale = ['Mrs.', 'Ms.', 'Miss', 'Dr.', 'Prof.'];

    public function name(string|null $gender = null): string
    {
        return sprintf('%s %s', $this->firstName($gender), $this->lastName());
    }

    public function firstName(string|null $gender = null): string
    {
        if ($gender === static::GENDER_MALE) {
            return $this->pickArrayRandomElement($this->firstNameMale);
        }

        if ($gender === static::GENDER_FEMALE) {
            return $this->pickArrayRandomElement($this->firstNameFemale);
        }

        return $this->pickArrayRandomElement($this->randomizer->getInt(0, 1) === 0 ? $this->firstNameFemale : $this->firstNameMale);
    }

    public function lastName(): string
    {
        return $this->pickArrayRandomElement($this->lastName);
    }

    public function title($gender = null)
    {
        if ($gender === static::GENDER_MALE) {
            return $this->pickArrayRandomElement($this->titleMale);
        }

        if ($gender === static::GENDER_FEMALE) {
            return $this->pickArrayRandomElement($this->titleFemale);
        }

        return $this->pickArrayRandomElement($this->randomizer->getInt(0, 1) === 0 ? $this->titleFemale : $this->titleMale);
    }
}
