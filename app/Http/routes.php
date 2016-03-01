<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// search

Route::get('search', ['as' => 'search', 'uses' => 'SearchController@search']);
Route::get('suggest', 'SearchController@suggest');

// study
Route::get('study/{id}', 'StudyController@view');

Route::get("/", array("as" => "pages.root", "uses" => "PagesController@index"));

# Catch all route for the static pages
Route::get("{path?}", array("as" => "pages.show", "uses" => "PagesController@show"))->where("path", "(.*)?");
