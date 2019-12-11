<?php
/**
 * Created by PhpStorm.
 * User: Mikhaylov Sergey Sergeevich ( @smskin )
 * Date: 06.12.2019
 * Time: 13:49
 */

namespace SMSkin\ImageStorage;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public const SINGLETON_ABSTRACT = 'ImageStorageImage';
    
    /**
     * register the service provider
     *
     * @return void
     */
    final public function register(): void
    {
        $this->app->singleton(self::SINGLETON_ABSTRACT, function($app)
        {
            return new Image();
        });

        $this->app->bind(\SMSkin\ImageStorage\Contracts\Manager::class, \SMSkin\ImageStorage\Manager::class);

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
        $this->publishes([
            __DIR__ . '/config/image-storage.php' => config_path('image-storage.php'),
        ], 'config');
    }
}