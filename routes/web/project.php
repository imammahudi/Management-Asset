<?php

// use Illuminate\Routing\Route;

// Route::group(['prefix' => 'project', 'middleware' => ['auth']], function() ){

//     Route::get(
//         '{projectID}/checkout',
//         ['as' => 'checkout/project', 'uses' => 'ProjectController#getCheckout']
//     );
// }


Route::group([ 'prefix' => 'project', 'middleware' => ['auth']], function () {

    Route::get(
        '{projectID}/checkout',
        [ 'as' => 'checkout/project', 'uses' => 'ProjectController@getCheckout' ]
    );
    Route::post(
        '{projectID}/checkout',
        [ 'as' => 'checkout/project', 'uses' => 'ProjectController@postCheckout' ]
    );

    Route::get(
        '{projectID}/checkin/{backto?}',
        [ 'as' => 'checkin/project', 'uses' => 'ProjectController@getCheckin' ]
    );
    Route::post(
        '{projectID}/checkin/{backto?}',
        [ 'as' => 'checkin/project', 'uses' => 'ProjectController@postCheckin' ]
    );

});

Route::resource('project', 'ProjectController', [
    'middleware' => ['auth'],
    'parameters' => ['project' => 'project_id']
]);
