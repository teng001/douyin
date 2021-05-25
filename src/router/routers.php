<?php
use Illuminate\Support\Facades\Route;

Route::get('douyin/code', 'DouYinAuthorizationController@code')->name('douyin.code');
Route::get('douyin/code/callback', 'DouYinAuthorizationController@token')->name('douyin.callback');
Route::get('douyin/code/user', 'DouYinAuthorizationController@user')->name('douyin.user');
