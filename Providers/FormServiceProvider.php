<?php
namespace Modules\Form\Providers;

use Illuminate\Support\ServiceProvider;

class FormServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Form';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'form';

    public function boot()
    {
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));        
        $this->registerConfig()
             ->registerViews()
             ->registerTranslations();
    }

    public function registerConfig()
    {
        $local_path   = __DIR__ .'/../Config/config.php';
        $this->mergeConfigFrom($local_path, $this->moduleNameLower);

        return $this;
    }

    public function registerViews()
    {
        $local_path   = __DIR__ .'/../Resources/views';
        $this->loadViewsFrom($local_path, $this->moduleNameLower);

        return $this;
    }  

    public function registerTranslations()
    {
        $local_path   = __DIR__ .'/../Resources/lang';
        $publish_path = resource_path('lang/form');

        if (is_dir($publish_path)) {
            $this->loadTranslationsFrom($publish_path, $this->moduleNameLower);
        } else {
            $this->loadTranslationsFrom($local_path, $this->moduleNameLower);
        }

        return $this;
    }  
}