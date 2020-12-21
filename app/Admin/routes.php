<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Dcat\Admin\Admin;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('Article',ArticleController::class);
    $router->resource('Cause',CauseController::class);
    $router->resource('ClassCard',ClassCardController::class);
    $router->resource('Course',CourseController::class);
    $router->resource('Team',TeamController::class);
    $router->resource('User',UserController::class);


    $router->get('ClassCard/{id}/change','ClassCardController@change');
    $router->get('ClassCard/{id}/change1','ClassCardController@change1');
    $router->get('user/ownerDate','UserController@ownerDate');
    $router->get('team/teamData','TeamController@teamData');
//    $router->get('user/ownerDate','GetCategoryDataController@bankowner');
});
