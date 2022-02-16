<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    public function index()
    {
        $categories = Category::get();

        $courses = Course::where([
            'is_home' => true,
            'is_active' => true
        ])->get();

        return view('home', [
            'courses' => $courses
        ]);
    }


    public function courseList()
    {
        if ($_GET) {
            $categories = Category::get();
            $user = Auth::user();

            $search = $_GET["search"];
            $result = Course::where('courseName', 'LIKE', '%' . $search . '%')
                ->orWhere('description', 'LIKE', '%' . $search . '%')
                ;


            if ($user) {
                if ($user->role == 'admin') {
                    $courses = $result->get();
                } else {
                    $courses = $result->where([
                        'is_active' => true
                    ])->get();

                }
            } else {
                $courses = $result->where([
                    'is_active' => true
                ])->get();
            }


            return view('courses.courseList', [
                'courses' => $courses,
                'categories' => $categories
            ]);
        }

        $categories = Category::get();
        $user = Auth::user();
        if ($user) {
            if ($user->role == 'admin') {
                $courses = Course::get();
            } else {
                $courses = Course::where([
                    'is_active' => true
                ])->get();
            }
        } else {
            $courses = Course::where([
                'is_active' => true
            ])->get();
        }


        return view('courses.courseList', [
            'courses' => $courses,
            'categories' => $categories
        ]);
    }

    public function createForm()
    {
        $user = Auth::user();
        if ($user->role == 'admin') {
            return view('courses.createCourse', [
                'categories' => Category::get()
            ]);
        } else {
            return redirect('/');
        }
    }

    public function create(Request $request)
    {
        $user = Auth::user();
        if ($user->role == 'admin') {
            $course = Course::where([
                'slug' => Str::slug($request->name)
            ])->get();

            if (json_decode(json_encode($course), 1) != null) {
                return view('courses.createCourse', [
                    'error' => 'Check course name'
                ]);
            } else {
                if ($request->is_home) {
                    $is_home = true;
                } else {
                    $is_home = false;
                }
                if ($request->is_active) {
                    $is_active = true;
                } else {
                    $is_active = false;
                }
                $imageName =rand(0,100000).".".$request->image->getClientOriginalExtension();
                $upload = $request->image->move(public_path("image"),$imageName);
                Course::create([
                    "courseName" => $request->name,
                    "description" => $request->description,
                    "category" => Str::slug($request->category),
                    "imageUrl" => $imageName,
                    "is_active" => $is_active,
                    "is_home" => $is_home,
                    "slug" => Str::slug($request->name)
                ]);
                return redirect('/courses');
            }
        } else {
            return redirect('/');
        }
    }

    public function course_by_categories($categoryName)
    {

        $courses = Course::where([
            'is_active' => true,
            'category' => $categoryName
        ])->get();

        return view('courses.courseList', [
            'courses' => $courses,
            'categories' => Category::get()
        ]);
    }

    public function course_detail($courseName)
    {
        $user = Auth::user();
        if ($user) {
            if ($user->role == 'admin') {
                $course = Course::where([
                    'slug' => $courseName
                ])->get();
            } else {
                $course = Course::where([
                    'is_active' => true,
                    'slug' => $courseName
                ])->get();
            }
        } else {
            $course = Course::where([
                'is_active' => true,
                'slug' => $courseName
            ])->get();
        }

        return view('courses.course_detail', [
            'course' => json_decode(json_encode($course), 1)[0],
            'categories' => Category::get()
        ]);
    }

    public function editCoursePage($courseSlug)
    {
        if(Auth::user()->role == 'admin')
        {
            $course = Course::where('slug', $courseSlug)->first();

            return view('courses.editCourse', [
                'course' => $course,
                'categories' => Category::get()
            ]);
        }else{
            return redirect('/');
        }

    }

    public function editCourse(Request $request, $courseSlug)
    {
        if(Auth::user()->role == 'admin')
        {
            $course = Course::where('slug', $courseSlug)->first();
            $checkCourse = Course::where('courseName', $request->name)->first();

            if ($checkCourse == null) {
                if ($request->is_home) {
                    $is_home = true;
                } else {
                    $is_home = false;
                }
                if ($request->is_active) {
                    $is_active = true;
                } else {
                    $is_active = false;
                }

                $course["courseName"] = $request->name;
                $course["description"] = $request->description;
                $course["category"] = Str::slug($request->category);
                $course["imageUrl"] = $request->image;
                $course["is_active"] = $is_active;
                $course["is_home"] = $is_home;
                $course["slug"] = Str::slug($request->name);
                #dd($course);
                $course->save();
                return redirect('/courses');
            } else {
                return view('courses.editCourse', [
                    'error' => 'please check course name',
                    'course' => $course,
                    'categories' => Category::get()
                ]);
            }
        }else{
            return redirect('/');
        }
    }

    public function createCategory(Request $request)
    {
        $user = Auth::user();
        if ($user->role == 'admin') {
            $category = Category::where([
                'slug' => Str::slug($request->name)
            ])->get();

            if (json_decode(json_encode($category), 1) != null) {
                return view('courses.create_category', [
                    'error' => 'Check category name'
                ]);
            } else {
                Category::create([
                    "categoryName" => $request->name,
                    "slug" => Str::slug($request->name)
                ]);
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
    }
}
