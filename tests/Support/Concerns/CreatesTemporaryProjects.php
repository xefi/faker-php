<?php

namespace Xefi\Faker\Tests\Support\Concerns;

trait CreatesTemporaryProjects
{
    /**
     * The temporary project paths created during the test.
     *
     * @var array
     */
    private array $temporaryProjectPaths = [];

    /**
     * Create a temporary project directory holding an installed.json and,
     * when given, a root composer.json.
     *
     * @param ?array $composer
     * @param array  $installedPackages
     *
     * @return string
     */
    private function createTemporaryProject(?array $composer = null, array $installedPackages = []): string
    {
        $projectPath = sys_get_temp_dir().'/faker-php-'.uniqid();

        mkdir($projectPath.'/vendor/composer', 0777, true);

        file_put_contents(
            $projectPath.'/vendor/composer/installed.json',
            json_encode(['packages' => $installedPackages])
        );

        if ($composer !== null) {
            file_put_contents($projectPath.'/composer.json', json_encode($composer));
        }

        $this->temporaryProjectPaths[] = $projectPath;

        return $projectPath;
    }

    /**
     * Remove every temporary project created during the test.
     *
     * @return void
     */
    private function deleteTemporaryProjects(): void
    {
        foreach ($this->temporaryProjectPaths as $projectPath) {
            $files = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($projectPath, \FilesystemIterator::SKIP_DOTS),
                \RecursiveIteratorIterator::CHILD_FIRST
            );

            foreach ($files as $file) {
                $file->isDir() ? rmdir($file->getPathname()) : unlink($file->getPathname());
            }

            rmdir($projectPath);
        }

        $this->temporaryProjectPaths = [];
    }
}
