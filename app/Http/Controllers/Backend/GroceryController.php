<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use GroceryCrud\Core\GroceryCrud;

class GroceryController extends Controller
{
    public function _getGroceryCrudEnterprise()
    {
        $database = $this->_getDatabaseConnection();

        $config = config('grocerycrud');

        $crud = new GroceryCrud($config, $database);
        $crud->unsetBootstrap()->unsetJquery()->unsetDeleteMultiple();

        return $crud;
    }

    public function _showOutput($output, $data = [], $view = 'backend.grocery')
    {
        if ($output->isJSONResponse) {
            return response($output->output, 200)
              ->header('Content-Type', 'application/json')
              ->header('charset', 'utf-8');
        }

        $css_files = $output->css_files;
        $js_files = $output->js_files;
        $output = $output->output;

        return view('backend.grocery', [
            'output' => $output,
            'css_files' => $css_files,
            'js_files' => $js_files,
            'type_menu' => $data['type_menu'] ?? '',
            'title' => $data['title'] ?? '',
        ]);
    }

    public function _getDatabaseConnection()
    {
        return [
            'adapter' => [
                'driver' => 'Pdo_Mysql',
                'database' => env('DB_DATABASE'),
                'username' => env('DB_USERNAME'),
                'password' => env('DB_PASSWORD'),
                'charset' => 'utf8',
            ],
        ];
    }
}
