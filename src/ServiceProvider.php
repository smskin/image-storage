<?php
/**
 * Created by PhpStorm.
 * User: Mikhaylov Sergey Sergeevich ( @smskin )
 * Date: 06.12.2019
 * Time: 13:49
 */

namespace SMSkin\ImageStorage;

use SMSkin\ImageStorage\Services\HttpService\Service as HttpService;
use SMSkin\ImageStorage\Services\ImageService\Service as ImageService;
use SMSkin\ImageStorage\Services\ImageManagerService\Service as ImageManagerService;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * register the service provider
     *
     * @return void
     */
    final public function register(): void
    {
        $this->app->singleton(ImageService::class, function()
        {
            return new ImageService();
        });

        $this->app->singleton(ImageManagerService::class, function()
        {
            return new ImageManagerService();
        });

        $this->app->singleton(HttpService::class, function()
        {
            return new HttpService();
        });

        $this->registerHelper('render_helper.php');
    }

    private function registerHelper(string $fileName): void
    {
        $file = __DIR__ . '/Helpers/' . $fileName;
        if (file_exists($file)) {
            /** @noinspection PhpIncludeInspection */
            require_once $file;
        }
    }

    /**
     * boot the service provider
     *
     * @return void
     */
    final public function boot(): void
    {
        //publish configuration
        /** @noinspection PhpUndefinedFunctionInspection */
        $this->publishes([
            __DIR__ . '/config/image-storage.php' => config_path('image-storage.php'),
        ], 'config');
    }
}