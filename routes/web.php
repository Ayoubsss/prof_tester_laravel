<?php

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

// Index
Route::get('/', 'PageController@index')->name('home');
Route::get('/home', 'PageController@index')->name('home');

Auth::routes();

// Classes resource
Route::resource('class', 'ClassController');

// Quizzes resource
Route::resource('quizzes', 'QuizController');




// Teacher or Student User profile routes
Route::get('/profile', 'PageController@index')->name('profile');


Route::prefix('student')->group(function() {
    Route::put('update', 'UserController@updateStudent');
    Route::get('make', 'UserController@makeStudent')->name('makeStudent');
    Route::prefix('quiz')->group(function() {
        Route::get('take/{quiz_id}', ['as' => 'takeQuiz', 'uses' => 'QuizController@takeQuiz']);
        Route::post('submit', 'QuizController@saveAttempt');
    });
});

Route::prefix('teacher')->group(function() {

    Route::put('update', 'UserController@updateTeacher');
    Route::get('make', 'UserController@makeTeacher')->name('makeTeacher');
});



Route::prefix('classes')->group(function() {

    Route::post('list', 'StudentClassesController@searchForClass');
    
    Route::post('{class_id}/join', ['as' => 'joinClass', 'uses' => 'StudentClassesController@joinClass']);
    
    Route::post('{class_id}/drop/{student_id}', ['as' => 'dropStudent', 'uses' => 'StudentClassesController@dropStudent']);

    Route::post('request/{request_id}/approve', ['as' => 'approveRequest', 'uses' => 'StudentClassesController@approveRequest']);
    
    Route::get('list', 'PageController@list_classes')->name('list_classes');

    Route::get('{class_id}', ['as' => 'viewClass', 'uses' => 'ClassController@show']);
});






