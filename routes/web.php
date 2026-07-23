<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/peserta', function () {
    return view('admin.peserta.index');
});

Route::get('/peserta/create', function () {
    return view('admin.peserta.create');
});

Route::get('/peserta/edit', function () {
    return view('admin.peserta.edit');
});