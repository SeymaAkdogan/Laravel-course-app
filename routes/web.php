<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

#AUTH
Route::get('/login', function(){
    return view('auth.login');
});
Route::post('/login', [AuthController::class,'login'])->name('login');

Route::get('/register', function(){
    return view('auth.register');
});
Route::post('/register', [AuthController::class,'register']);
Route::get('/logout', [AuthController::class,'logout']);

Route::get('/profile', function(){
    return view('auth.profile');
})->middleware('auth');
Route::post('/profile',[AuthController::class,'updateProfile'] )->middleware('auth');

# COURSE
Route::get('/', [CourseController::class,'index']);
Route::get('/courses', [CourseController::class,'courseList']);

Route::get('/categories/{categoryName}',[CourseController::class,'course_by_categories']);

Route::get('/courses/{courseName}',[CourseController::class,'course_detail']);

#ADMIN
Route::get('/create-course',[CourseController::class,'createForm'])->middleware('auth');
Route::post('/create-course', [CourseController::class,'create'])->middleware('auth');

Route::get('/edit-course/{courseName}',[CourseController::class,'editCoursePage'])->middleware('auth');
Route::post('/edit-course/{courseName}',[CourseController::class,'editCourse'])->middleware('auth');

Route::get('/admin/users',[AuthController::class,'getUsers'])->middleware('auth');

Route::get('/create-category',function(){
    return view('courses.create_category');
})->middleware('auth');

Route::post('/create-category',[CourseController::class,'createCategory'])->middleware('auth');
