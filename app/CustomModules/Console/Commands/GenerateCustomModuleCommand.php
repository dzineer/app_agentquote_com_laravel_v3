<?php

namespace App\CustomModules\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GenerateCustomModuleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dzineer:custom-module {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Custom Module Skeleton';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        [ $className, $moduleName ] = $this->generateNames();

        $stub = $this->getCustomClass( $className, $moduleName );

        [ $settingView, $renderView ] = $this->readViewTemplates();

        $viewsPath = resource_path('views/custom_modules');

        if (
            $this->generateClass( $className, $stub )
        ) {
            $this->compileTemplates( $viewsPath, $moduleName, $settingView, $renderView );
            $this->info( 'Custom module ' . $className . ' was created successfully!' );
        }
    }

    /**
     * @param string $className
     * @param string $moduleName
     *
     * @return false|mixed|string
     */
    private function getCustomClass( string $className, string $moduleName ) {
        $stub = file_get_contents( app_path( 'CustomModules/Console/custom-module.stub' ) );
        $stub = str_replace( '{{CLASS}}', $className, $stub );
        $stub = str_replace( '{{MODULE}}', $moduleName, $stub );

        return $stub;
    }

    private function getSettingsView() {
        return file_get_contents( app_path( 'CustomModules/Console/custom-module-settings.stub' ) );
    }

    private function getRenderView() {
        return file_get_contents( app_path( 'CustomModules/Console/custom-module-render.stub' ) );
    }

    /**
     * @param string $viewsPath
     * @param string $moduleName
     * @param string $settingView
     * @param string $renderView
     */
    private function compileTemplates(
        string $viewsPath,
        string $moduleName,
        string $settingView,
        string $renderView
    ): void {

        if ( ! is_dir( resource_path('views/custom_modules/' . $moduleName ) ) ) {
            mkdir( resource_path('views/custom_modules/' . $moduleName ) );

            if ( resource_path('views/custom_modules/' . $moduleName ) ) {

                file_put_contents( resource_path( 'views/custom_modules/' . $moduleName . '/' . 'settings.blade.php' ), $settingView );
                file_put_contents( resource_path( 'views/custom_modules/' . $moduleName . '/' . 'render.blade.php' ), $renderView );

                $this->info('Settings view is located: ' . resource_path( 'views/custom_modules/' . $moduleName . '/' . 'settings.blade.php' ) );
                $this->info('Render view is located: ' . resource_path( 'views/custom_modules/' . $moduleName . '/' . 'render.blade.php' ) );

            } else {
                $this->error($moduleName . ' was not created!');
            }
        } else {
            $this->error('Views already exists... Not generating views!');
        }
    }

    /**
     * @param string $className
     * @param string $stub
     *
     * @return bool
     */
    private function generateClass( string $className, string $stub ): bool {
        if ( ! is_file( app_path( 'Modules/' . $className . '.php' ) ) ) {
            file_put_contents( app_path( 'Modules/' . $className . '.php' ), $stub );
            $this->info('Custom module class is located at: ' . app_path( 'Modules/' . $className . '.php' ) );
            $this->info('Add: \\App\\CustomModules\\' . $className . '::class to modules array in config file located here: ' . base_path('config/custom_modules.php') );
            return true;
        } else {
            $this->error('Module already exists... Not generating!');
            return false;
        }
    }/**
 * @return array
 */
    private function readViewTemplates(): array {
        $settingView = $this->getSettingsView();
        $renderView  = $this->getRenderView();

        return [ $settingView, $renderView ];
    }/**
 * @return array
 */
    private function generateNames(): array {
        $name       = $this->argument( 'name' );
        $className  = $name . 'Module';
        $moduleName = Str::snake( $name );

        return [ $className, $moduleName ];
    }
}
