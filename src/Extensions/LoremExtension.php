<?php

namespace Xefi\Faker\Extensions;

class LoremExtension extends Extension
{
    protected array $latinWords = [
        'amor', 'bellum', 'civitas', 'domus', 'fortuna', 'gloria', 'homo', 'imperium', 'libertas', 'luna',
        'magnus', 'natura', 'orbis', 'pax', 'regina', 'sapiens', 'terra', 'urbs', 'virtus', 'vita',
        'aqua', 'arbor', 'caelum', 'deus', 'equus', 'felix', 'gens', 'hostis', 'ignis', 'iustitia',
        'labor', 'mare', 'nox', 'opus', 'poena', 'rex', 'scelus', 'tempus', 'umbra', 'veritas',
        'victoria', 'voluntas', 'aetas', 'audacia', 'canis', 'corpus', 'dies', 'fatum', 'herba', 'insula',
        'lex', 'lux', 'mens', 'mors', 'navis', 'numerus', 'ordo', 'parens', 'populus', 'proelium',
        'quies', 'sanguis', 'senex', 'silva', 'sol', 'somnus', 'stella', 'tempestas', 'timor', 'vates',
        'verbum', 'vinculum', 'animus', 'aurum', 'carmen', 'certamen', 'cogitatio', 'cura', 'fides',
        'gaudium', 'ignavia', 'lacrima', 'ludus', 'murus', 'nomen', 'odium', 'penna', 'pontus', 'ratio',
        'saxum', 'servus', 'sponsa', 'templum', 'vallis', 'ver', 'vulnus', 'aestas', 'caput', 'castra',
        'dolor', 'ferrum', 'forma', 'frater', 'genus', 'locus', 'mater', 'mons', 'niger', 'oculus',
        'pater', 'porta', 'puella', 'res', 'soror', 'tectum', 'via', 'vinum', 'acer', 'altus',
        'bonus', 'brevis', 'clarus', 'dexter', 'durus', 'facilis', 'fortis', 'gravis', 'iuvenis', 'longus',
        'malus', 'medius', 'mirus', 'novus', 'parvus', 'primus', 'sanctus', 'severus', 'solus', 'tutus',
        'validus', 'velox', 'verus', 'vividus', 'arma', 'auris', 'cibus', 'dolus', 'fama',
        'filia', 'fuga', 'hora', 'ira', 'lacus', 'latus', 'mensa', 'morbus', 'portus', 'rosa',
        'scutum', 'acumen', 'aureus', 'avis', 'bellus', 'caritas', 'celer', 'certus', 'civis', 'comitas',
        'cupiditas', 'dignitas', 'femina', 'finis', 'flamma', 'fructus', 'gratia', 'ignotus', 'innocens', 'ius',
        'liber', 'lingua', 'lumen', 'magnitudo', 'mensis', 'minimus', 'modus', 'mulier', 'munus', 'nasus',
        'natio', 'nefas', 'nobilis', 'occasio', 'officium', 'onus', 'pars', 'passio', 'pecunia', 'potestas',
        'praemium', 'regnum', 'sacrificium', 'scientia', 'sermo', 'signum', 'species', 'spes', 'tenebrae',
        'terrae', 'usus', 'ventus', 'victor', 'villa', 'votum', 'vulgaris', 'aeger', 'aquaeductus', 'bona',
        'celeritas', 'corona', 'credo', 'cubiculum', 'decus', 'delirium', 'dens', 'digitus', 'educatio', 'exemplum',
        'fidelitas', 'flos',
    ];

    public function word(): string
    {
        return $this->pickArrayRandomElement($this->latinWords);
    }

    public function words(int $words = 3)
    {
        return $this->pickArrayRandomElements($this->latinWords, $words);
    }

    public function sentence(int $words = 6)
    {
        return ucfirst(implode(' ', $this->words($words)));
    }
}
