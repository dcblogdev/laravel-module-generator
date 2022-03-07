<?php

namespace Dcblogdev\ModuleGenerator\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Symfony\Component\Filesystem\Filesystem as SymfonyFilesystem;
use Symfony\Component\Finder\Finder;

class MakeGeneratorCommand extends Command
{
    protected       $signature   = 'module:build';
    protected       $description = 'Create starter module from a template';
    protected array $caseTypes   = [
        'module' => 'strtolower',
        'Module' => 'ucwords',
        'model'  => 'strtolower',
        'Model'  => 'ucwords',
    ];

    public function handle()
    {
        $this->container['name'] = ucwords($this->ask('Please enter a name'));
        if ($this->container['name'] === '') {
            $this->error("\nName cannot be empty.");

            return $this->handle();
        }

        if (file_exists(base_path('Modules/' . $this->container['name']))) {
            $this->error("\nModule already exists.");

            return true;
        }

        $this->container['folder'] = config('module-generator.path');
        if (! file_exists(base_path($this->container['folder']))) {
            $this->error("\nPath does not exist.");

            return true;
        }

        $this->generate();

        $this->info('Starter ' . $this->container['name'] . ' module generated successfully.');
    }

    protected function generate(): void
    {
        //ensure directory does not exist
        $this->delete(base_path('generator-temp'));

        $folder = $this->container['folder'];
        $this->copy(base_path($folder), base_path('generator-temp'));
        $folderPath = base_path('generator-temp');

        $finder = new Finder();
        $finder->files()->in($folderPath);

        $this->renameFiles($finder);
        $this->updateFilesContent($finder);

        $this->copy($folderPath, './Modules');
        $this->delete('./Modules/Module');
        $this->delete($folderPath);
    }

    public function delete($sourceFile): void
    {
        $filesystem = new SymfonyFilesystem;
        if ($filesystem->exists($sourceFile)) {
            $filesystem->remove($sourceFile);
        }
    }

    protected function copy($sourceFile, $target): void
    {
        $filesystem = new SymfonyFilesystem;
        if ($filesystem->exists($sourceFile)) {
            $filesystem->mirror($sourceFile, $target);
        }
    }

    protected function renameFiles($finder): void
    {
        foreach ($finder as $file) {
            $type       = Str::endsWith($file->getPath(), ['migrations', 'Migrations']) ? 'migration' : '';
            $sourceFile = $file->getPath() . '/' . $file->getFilename();
            $this->alterFilename($sourceFile, $type);
        }
    }

    protected function alterFilename($sourceFile, $type = ''): void
    {
        $name  = ucwords($this->container['name']);
        $model = Str::singular($name);

        $targetFile = $sourceFile;
        $targetFile = str_replace(
            ['Module', 'module', 'Model', 'model'],
            [$name, strtolower($name), $model, strtolower($model)],
            $targetFile
        );

        if (in_array(basename($sourceFile), config('module-generator.ignore_files'), true)) {
            $targetFile = dirname($targetFile) . '/' . basename($sourceFile);
        }

        //hack to ensure Models exists
        $targetFile = str_replace("Entities", "Models", $targetFile);

        //hack to ensure modules if used does not get replaced
        if (Str::contains($targetFile, $name . 's')) {
            $targetFile = str_replace($name . 's', "Modules", $targetFile);
        }

        if (! is_dir(dirname($targetFile))) {
            if (! mkdir($concurrentDirectory = dirname($targetFile), 0777, true) && ! is_dir($concurrentDirectory)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
            }
        }

        $this->rename($sourceFile, $targetFile, $type);
    }

    protected function rename($sourceFile, $targetFile, $type = ''): void
    {
        $filesystem = new SymfonyFilesystem;
        if ($filesystem->exists($sourceFile)) {
            if ($type === 'migration') {
                $targetFile = $this->appendTimestamp($targetFile);
            }
            $filesystem->rename($sourceFile, $targetFile, true);
        }
    }

    protected function appendTimestamp($sourceFile): array|string
    {
        $timestamp = date('Y_m_d_his_');
        $file      = basename($sourceFile);

        return str_replace($file, $timestamp . $file, $sourceFile);
    }

    protected function updateFilesContent($finder): void
    {
        foreach ($finder as $file) {
            $sourceFile = $file->getPath() . '/' . $file->getFilename();
            $this->replaceInFile($sourceFile);
        }
    }

    protected function replaceInFile($sourceFile): void
    {
        $name  = ucwords($this->container['name']);
        $model = Str::singular($name);
        $types = [
            '{Module_}' => $this->renamePlaceholders($name, '_'),
            '{module_}' => $this->renamePlaceholders($name, '_', arrayMap: true),
            '{module-}' => $this->renamePlaceholders($name, '-', arrayMap: true),
            '{Module-}' => $this->renamePlaceholders($name, '-'),
            '{Module}'  => $name,
            '{Module }' => trim(preg_replace('/(?<!\ )[A-Z]/', ' $0', $name)),
            '{module}'  => strtolower($name),
            '{module }' => trim(preg_replace('/(?<!\ )[A-Z]/', ' $0', strtolower($name))),
            '{Model-}'  => $this->renamePlaceholders($model, '-'),
            '{model-}'  => $this->renamePlaceholders($model, '-', arrayMap: true),
            '{Model_}'  => $this->renamePlaceholders($model, '_'),
            '{model_}'  => $this->renamePlaceholders($model, '_', arrayMap: true),
            '{Model}'   => $model,
            '{model}'   => strtolower($model),
            '{model }'  => trim(preg_replace('/(?<!\ )[A-Z]/', ' $0', strtolower($model))),
        ];

        foreach ($types as $key => $value) {
            if (file_exists($sourceFile)) {
                file_put_contents($sourceFile, str_replace($key, $value, file_get_contents($sourceFile)));
            }
        }
    }

    protected function renamePlaceholders($model, $separator, $arrayMap = null): string
    {
        $parts = preg_split('/(?=[A-Z])/', $model, -1, PREG_SPLIT_NO_EMPTY);

        if ($arrayMap) {
            $parts = array_map('strtolower', $parts);
        }

        return implode($separator, $parts);
    }

    public function append($sourceFile, $content): void
    {
        $filesystem = new SymfonyFilesystem;
        if ($filesystem->exists($sourceFile)) {
            $filesystem->appendToFile($sourceFile, $content);
        }
    }
}
