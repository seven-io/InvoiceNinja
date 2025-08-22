<?php

namespace Modules\Seven\Providers;

use App\Events\Client\ClientWasCreated;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Modules\Seven\Listeners\ClientWasCreatedListener;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class SevenServiceProvider extends ServiceProvider
{
    protected string $name = 'Seven';
    protected string $nameLower = 'seven';

    public function boot(): void
    {
        $this->registerConfig();

        Event::listen(ClientWasCreated::class, ClientWasCreatedListener::class);
    }

    protected function registerConfig(): void
    {
        $configPath = module_path($this->name, config('modules.paths.generator.config.path'));

        if (is_dir($configPath)) {
            $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($configPath));

            foreach ($iterator as $file) {
                if ($file->isFile() && $file->getExtension() === 'php') {
                    $relativePath = str_replace($configPath . DIRECTORY_SEPARATOR, '', $file->getPathname());
                    $configKey = $this->nameLower . '.' . str_replace([DIRECTORY_SEPARATOR, '.php'], ['.', ''], $relativePath);
                    $key = ($relativePath === 'config.php') ? $this->nameLower : $configKey;

                    $this->publishes([$file->getPathname() => config_path($relativePath)], 'config');
                    $this->mergeConfigFrom($file->getPathname(), $key);
                }
            }
        }
    }
}
