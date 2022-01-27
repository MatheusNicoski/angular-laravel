<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'welcome', [
    'routes' => [
        'User' => [
            'GET'   => ['uri' => ['list','profile'], 'color' => 'primary'],
            'POST'  => ['uri' => ['register', 'login', 'logout'], 'color' => 'success'],
            'PUT'   => ['uri' => ['update'], 'color' => 'warning'],
        ],
        'Contact' => [
            'GET'       => ['uri' => ['list','show'], 'color' => 'primary'],
            'POST'      => ['uri' => ['register'], 'color' => 'success'],
            'PUT'       => ['uri' => ['update/{id}'], 'color' => 'warning'],
            'DELETE'    => ['uri' => ['delete/{id}'], 'color' => 'danger'],
        ],
    ],
    'prefix' => 'api/v1/',
    'url'   => 'http://127.0.0.1:8000/'
]);
