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

    public function handle()
    {
        $this->container['name'] = ucwords($this->ask('Please enter a name'));
        if (strlen($this->container['name']) == 0) {
            $this->error("\nName cannot be empty.");
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
        $folder = $this->container['folder'];
        $this->copy(base_path($folder), base_path('generator-temp'));
        $folderPath = base_path('generator-temp');

        foreach ($this->caseTypes as $typeName => $case) {
            $finder = new Finder();
            $finder->files()->in($folderPath)->name("#$typeName#");
            foreach ($finder as $file) {
                $type       = Str::endsWith($file->getPath(), 'migrations') ? 'migration' : '';
                $sourceFile = $file->getPath().'/'.$file->getFilename();
                $this->replaceInFile($sourceFile);

                $name  = ucwords($this->container['name']);
                $model = Str::singular($name);
                $words = [
                    'Module' => $name,
                    'module' => strtolower($name),
                    'Model'  => $model,
                    'model'  => strtolower($model)
                ];

                $this->alterFilename($typeName, $sourceFile, $words[$typeName], $type);
            }
        }

        //append content to file
        //$content = "\nrequire base_path('routes/api/v1/".$module."-routes.php');";
        //$this->append(base_path('routes/api/v1/routes.php'), $content);

        $this->copy($folderPath, './');
        $this->delete($folderPath);
    }

    protected function alterFilename($toReplace, $sourceFile, $name, $type = '')
    {
        $targetFile = str_replace($toReplace, $name, $sourceFile);
        $targetFile = str_replace("/app/$name", "/app/Model", $targetFile);
        $this->rename($sourceFile, $targetFile, $type);
    }

    protected function rename($path, $targetFile, $type = '')
    {
        $filesystem = new SymfonyFilesystem;
        if ($filesystem->exists($path)) {
            if ($type == 'migration') {
                $targetFile = $this->appendTimestamp($targetFile);
            }
            $filesystem->rename($path, $targetFile, true);
        }
    }

    protected function appendTimestamp($path)
    {
        $timestamp = date('Y_m_d_his_');
        $file      = $this->getFileFromPath($path);
        return str_replace($file, $timestamp.$file, $path);
    }

    protected function getFileFromPath($path)
    {
        $parts = explode('/', $path);
        return end($parts);
    }

    protected function copy($path, $target)
    {
        $filesystem = new SymfonyFilesystem;
        if ($filesystem->exists($path)) {
            $filesystem->mirror($path, $target);
        }
    }

    protected function replaceInFile($path)
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
            if (file_exists($path)) {
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
                file_put_contents($path, str_replace($key, $value, file_get_contents($path)));
            }
        }
    }

    public function append($path, $content)
    {
        $filesystem = new SymfonyFilesystem;
        if ($filesystem->exists($path)) {
            $filesystem->appendToFile($path, $content);
        }
    }

    public function delete($path)
    {
        $filesystem = new SymfonyFilesystem;
        if ($filesystem->exists($path)) {
            $filesystem->remove($path);
        }
    }
}