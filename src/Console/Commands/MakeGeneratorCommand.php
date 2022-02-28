<?php

namespace Dcblogdev\Generator\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Symfony\Component\Filesystem\Filesystem as SymfonyFilesystem;
use Symfony\Component\Finder\Finder;

class MakeGeneratorCommand extends Command
{
    protected $signature   = 'build:template';
    protected $description = 'Create starter structures from a template';
    protected $caseTypes   = [
        'module' => 'strtolower',
        'Module' => 'ucwords',
        'model'  => 'strtolower',
        'Model'  => 'ucwords',
    ];
    protected $ignoreFiles = [
        'module.json'
    ];

    public function handle()
    {
        $this->container['name'] = ucwords($this->ask('Please enter a name'));
        if (strlen($this->container['name']) == 0) {
            $this->error("\nName cannot be empty.");
            return $this->handle();
        }

        $folderPath                = config('generator.default_path');
        $this->container['folder'] = $this->ask("Please enter the template folder path", $folderPath);
        if (!file_exists(base_path($this->container['folder']))) {
            $this->error("\nPath does not exist.");
            return true;
        }

        $this->generate();

        $this->info('Starter '.$this->container['name'].' structure generated successfully.');
    }

    protected function generate()
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

        //append content to file
        //$content = "\nrequire base_path('routes/api/v1/".$module."-routes.php');";
        //$this->append(base_path('routes/api/v1/routes.php'), $content);

        $this->delete(base_path('generator-temp/Modules/module'));
        $this->copy($folderPath, './');
        $this->delete($folderPath);
    }

    protected function updateFilesContent($finder)
    {
        foreach ($finder as $file) {
            $sourceFile = $file->getPath().'/'.$file->getFilename();
            $this->replaceInFile($sourceFile);
        }
    }

    protected function renameFiles($finder)
    {
        foreach ($finder as $file) {
            $type       = Str::endsWith($file->getPath(), ['migrations', 'Migrations']) ? 'migration' : '';
            $sourceFile = $file->getPath().'/'.$file->getFilename();
            $this->alterFilename($sourceFile, $type);
        }
    }

    protected function alterFilename($sourceFile, $type = '')
    {
        $name  = ucwords($this->container['name']);
        $model = Str::singular($name);

        $targetFile = $sourceFile;
        $targetFile = str_replace('Module', $name, $targetFile);
        $targetFile = str_replace('module', strtolower($name), $targetFile);
        $targetFile = str_replace('Model',  $model, $targetFile);
        $targetFile = str_replace('model', strtolower($model), $targetFile);

        if (in_array(basename($sourceFile), config('generator.ignore_files'))) {
            $targetFile = dirname($targetFile).'/'.basename($sourceFile);
        }

        //hack to ensure Model if used does not get replaced
        $targetFile = str_replace("/app/$name", "/app/Models", $targetFile);

        //hack to ensure modules if used does not get replaced
        if (Str::contains($targetFile, $name.'s')) {
            $targetFile = str_replace($name.'s', "Modules", $targetFile);
        }

        if (!is_dir(dirname($targetFile))) {
            mkdir(dirname($targetFile), 0777, true);
        }

        $this->rename($sourceFile, $targetFile, $type);
    }

    protected function rename($sourceFile, $targetFile, $type = '')
    {
        $filesystem = new SymfonyFilesystem;
        if ($filesystem->exists($sourceFile)) {
            if ($type == 'migration') {
                $targetFile = $this->appendTimestamp($targetFile);
            }
            $filesystem->rename($sourceFile, $targetFile, true);
        }
    }

    protected function appendTimestamp($sourceFile)
    {
        $timestamp = date('Y_m_d_his_');
        $file      = basename($sourceFile);
        return str_replace($file, $timestamp.$file, $sourceFile);
    }

    protected function copy($sourceFile, $target)
    {
        $filesystem = new SymfonyFilesystem;
        if ($filesystem->exists($sourceFile)) {
            $filesystem->mirror($sourceFile, $target);
        }
    }

    protected function replaceInFile($sourceFile)
    {
        $name  = ucwords($this->container['name']);
        $model = Str::singular($name);
        $types = [
            '{module_}' => null,
            '{module-}' => null,
            '{Module}'  => $name,
            '{module}'  => strtolower($name),
            '{Model}'   => $model,
            '{model}'   => strtolower($model)
        ];

        foreach ($types as $key => $value) {
            if (file_exists($sourceFile)) {
                if ($key == "{module_}") {
                    $parts = preg_split('/(?=[A-Z])/', $name, -1, PREG_SPLIT_NO_EMPTY);
                    $parts = array_map('strtolower', $parts);
                    $value = implode('_', $parts);
                }

                if ($key == '{module-}') {
                    $parts = preg_split('/(?=[A-Z])/', $name, -1, PREG_SPLIT_NO_EMPTY);
                    $parts = array_map('strtolower', $parts);
                    $value = implode('-', $parts);
                }
                file_put_contents($sourceFile, str_replace($key, $value, file_get_contents($sourceFile)));
            }
        }
    }

    public function append($sourceFile, $content)
    {
        $filesystem = new SymfonyFilesystem;
        if ($filesystem->exists($sourceFile)) {
            $filesystem->appendToFile($sourceFile, $content);
        }
    }

    public function delete($sourceFile)
    {
        $filesystem = new SymfonyFilesystem;
        if ($filesystem->exists($sourceFile)) {
            $filesystem->remove($sourceFile);
        }
    }
}