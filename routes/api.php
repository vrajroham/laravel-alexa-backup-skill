<?php

	Route::group(['middleware' => 'auth:api'], function () {
		require 'alexa.php';
	});
