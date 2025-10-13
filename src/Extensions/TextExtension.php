<?php

namespace Xefi\Faker\Extensions;

use Xefi\Faker\Extensions\Traits\HasLocale;
use function PHPSTORM_META\map;

class TextExtension extends Extension
{
    use HasLocale;

    /**
     * Text in format => Paragraphs => Sentences => Words.
     *
     * @var array|array[]
     */
    protected array $paragraphs = [
        [
            ['Lorem', 'ipsum', 'dolor', 'sit', 'amet,', 'consectetur', 'adipiscing', 'elit.'],
            ['Nullam', 'eu', 'nunc', 'non', 'mi', 'aliquet', 'varius.'],
            ['Curabitur', 'et', 'vestibulum', 'nulla.'],
            ['Donec', 'placerat', 'tempor', 'arcu,', 'in', 'viverra', 'sapien', 'laoreet', 'eu.'],
            ['Sed', 'vitae', 'ligula', 'eget', 'mauris', 'malesuada', 'pretium', 'in', 'at', 'lorem.'],
            ['Integer', 'condimentum', 'urna', 'at', 'lacus', 'fermentum,', 'nec', 'sagittis', 'purus', 'venenatis.'],
        ],
        [
            ['Nunc', 'at', 'ligula', 'id', 'nisl', 'varius', 'egestas.'],
            ['Suspendisse', 'eget', 'nulla', 'dapibus,', 'efficitur', 'purus', 'a,', 'congue', 'quam.'],
            ['Donec', 'sagittis', 'interdum', 'libero', 'non', 'ornare.'],
            ['Nam', 'non', 'massa', 'lacus.'],
            ['Etiam', 'fermentum', 'neque', 'ut', 'est', 'porttitor,', 'ut', 'tincidunt', 'risus', 'suscipit.'],
            ['Nam', 'id', 'nisi', 'eget', 'lorem', 'vehicula', 'eleifend.'],
        ],
        [
            ['Quisque', 'accumsan', 'nisl', 'ut', 'quam', 'pretium,', 'eget', 'lacinia', 'arcu', 'lobortis.'],
            ['Nam', 'dapibus', 'justo', 'nec', 'nibh', 'dapibus,', 'ac', 'varius', 'velit', 'varius.'],
            ['Nulla', 'facilisi.'],
            ['Praesent', 'volutpat', 'suscipit', 'nibh,', 'eget', 'congue', 'ante', 'ornare', 'a.'],
            ['Nam', 'aliquet', 'risus', 'eget', 'leo', 'gravida', 'scelerisque.'],
        ],
        [
            ['Aenean', 'accumsan', 'leo', 'at', 'odio', 'vestibulum,', 'non', 'fermentum', 'nisl', 'varius.'],
            ['Suspendisse', 'in', 'quam', 'sed', 'ligula', 'convallis', 'sodales.'],
            ['Mauris', 'consequat', 'risus', 'sit', 'amet', 'libero', 'iaculis,', 'quis', 'volutpat', 'eros', 'scelerisque.'],
            ['Pellentesque', 'habitants', 'morbi', 'tristique', 'senectus', 'et', 'netus', 'et', 'malesuada', 'fames', 'ac', 'turpis', 'egestas.'],
        ],
        [
            ['Donec', 'ultricies', 'euismod', 'libero,', 'vel', 'scelerisque', 'enim', 'condimentum', 'ut.'],
            ['Fusce', 'varius', 'urna', 'ac', 'ipsum', 'ultricies,', 'vel', 'elementum', 'turpis', 'dictum.'],
            ['Proin', 'nec', 'ante', 'at', 'erat', 'pharetra', 'interdum.'],
            ['Etiam', 'nec', 'ligula', 'felis.'],
            ['Curabitur', 'sit', 'amet', 'varius', 'nisi,', 'in', 'sagittis', 'turpis.'],
            ['Sed', 'eget', 'ex', 'quis', 'risus', 'varius', 'pharetra', 'in', 'a', 'felis.'],
        ],
    ];

    protected array $flattenedWords;

    protected array $flattenedSentences;

    protected function flattenedWords(): array
    {
        if (isset($this->flattenedWords)) {
            return $this->flattenedWords;
        }

        return array_merge(...$this->flattenedSentences());
    }

    protected function flattenedSentences(): array
    {
        if (isset($this->flattenedSentences)) {
            return $this->flattenedSentences;
        }

        return array_merge(...$this->paragraphs);
    }

    public function wordsAsArray(int $words = 3): array
    {
        return $this->pickArrayRandomElements($this->flattenedWords(), $words);
    }

    public function words(int $words = 3): string
    {
        $words = $this->wordsAsArray($words);

        // Remove any uppercase / comma / dots
        return strtolower(preg_replace('/[.,]/', '', implode(' ', $words)));
    }

    public function sentencesAsArray(int $sentences = 3): array
    {
        return $this->pickArrayRandomElements($this->flattenedSentences(), $sentences);
    }

    public function sentences(int $sentences = 3): string
    {
        $sentences = $this->sentencesAsArray($sentences);
        $sentences = array_map(function ($sentence) { return implode(' ', $sentence); }, $sentences);

        return implode(' ', $sentences);
    }

    public function paragraphsAsArray(int $paragraphs = 3): array
    {
        return $this->pickArrayRandomElements($this->paragraphs, $paragraphs);
    }

    public function paragraphs(int $paragraphs = 3): string
    {
        $paragraphs = $this->paragraphsAsArray($paragraphs);
        $paragraphs = array_map(function ($sentences) {  return implode(' ', array_merge(...$sentences)); }, $paragraphs);

        return implode(PHP_EOL, $paragraphs);
    }
}
