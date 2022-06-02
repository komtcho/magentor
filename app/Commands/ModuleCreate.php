<?php

namespace App\Commands;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ModuleCreate extends CommandMage
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'module:create';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Create new module';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $vendor = $this->ask('Vendor name?');
        $module = $this->ask('Module name?');

        // dd(
        //     $this->argument('name'), 
        //     $this->moudles_pool, 
        //     Str::finish($this->moudles_pool, '/') . ltrim($this->argument('name'), '/')
        // );

        $vendor_name = $this->createVendor($vendor);

        $module_name = $this->createModule($vendor_name, $module);

        $ritten = File::get(__DIR__ . '/../stubs/registration.stub');

        $mode = $vendor . '_' . $module;

        $ritten = Str::replace('<MODULE>', $mode, $ritten);

        $written = File::put($module_name . '/registration.php', $ritten);

        dd($written);
    }

    private function createVendor($vendor_name)
    {
        $module_name = $this->moudles_pool . '/' . $vendor_name;

        if (!File::exists($module_name)) {
            File::makeDirectory($module_name, 0755);
        }

        return $module_name;
    }

    private function createModule($vendor_name, $module_name)
    {
        $module_name = $vendor_name . '/' . $module_name;

        if (!File::exists($module_name)) {
            File::makeDirectory($module_name, 0755);
        }

        return $module_name;
    }
}
