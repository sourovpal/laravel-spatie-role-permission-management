<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'dashboard'], function(){
	Route::get('/', 'Backend\DashboardController@index')->name('dashboard.home');
	// admin role route
	Route::resource('roles', 'Backend\RolesController', ['names' => 'dashboard.roles']);
	// admin user route
	Route::resource('users', 'Backend\AdminController', ['names' => 'dashboard.users']);
});

// Admin  Auth login

Route::get('admin/login', 'Backend\Auth\LoginController@showLoginForm')->name('dashboard.login');
Route::post('admin/login/submit', 'Backend\Auth\LoginController@login')->name('dashboard.login.submit');
Route::get('admin/logout', 'Backend\Auth\LoginController@adminLogout')->name('dashboard.logout');

// Admin create 
