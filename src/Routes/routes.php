<?php

Route::middleware(['web'])->namespace('Cirote\Estrategias\Controllers')
	->prefix('estrategias')
	->name('estrategias.')
	->group(function() 
	{
		Route::get('/bases', 'EstrategiasController@bases')->name('bases');
		Route::get('/bases_nuevas', 'EstrategiasController@bases_nuevas')->name('bases.nuevas');
		Route::get('/spreads', 'EstrategiasController@spreads')->name('spreads');
		Route::get('/lanzamiento', 'EstrategiasController@lanzamiento_cubierto')->name('lanzamiento_cubierto');
		Route::get('/tester', 'EstrategiasController@tester')->name('tester');
	});
