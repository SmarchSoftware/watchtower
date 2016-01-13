<?php

Route::group(['middleware' => 'web'], function () {
	require __DIR__.'/routes.php';
});