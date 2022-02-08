<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\StudentModel;

use App\Models\ClassModel;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\App;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!$request->session()->has('starting_time'))
            $request->session()->put('starting_time', time());
        session_start();

        $lang = $request->session()->get('lang')?$request->session()->get('lang'):'en';
        // isset($_SESSION['lang'])?$_SESSION['lang']:'en';
        // App::setLocale($lang);
        echo "Ngôn Ngữ: ".$lang;
        App::setlocale($lang);
        $students = StudentModel::orderBy('id','DESC')-> paginate(10);
         // $classes = ClassModel::all();
         // $classArray = array();

         // foreach ($classes as $class) 
         //     $classArray[$class->id] = $class->name;
         // echo ("Ngôn Ngữ:".App::getLocale());
        return view('student.index',['students'=>$students]);
    }
    public function api_index(Request $request)
    {
        $students = StudentModel::orderBy('id','DESC')-> paginate(10);

        return response()->json($students,201);
    }


    // public function api_index(Request $request)
    // {
    //      $students = StudentModel::orderBy('id','DESC')-> paginate(10);

    //      return response()->json($students,201);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        //
        $classes = ClassModel::all();
        $starting_time = $request->session()->get('starting_time', time());
        return view('student.new',['classes'=> $classes, 'starting_time'=>$starting_time]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
             $rules = [
            'fullname' => "required",
            'avatar' => "mimes:jpeg,mp,png"
        ];

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails())
            return redirect()->route('student.create')->withErrors($validator)->withInput();
        else {
            $student = new StudentModel;
            $student->fullname = $request->fullname;
            $student->DOB = $request->DOB;
            $student->sex = $request->sex;
            $student->address = $request->address;
            $student->class_id = $request->class_id;
            $student->description = $request->description;

            $student->save();

            // Xử lý upload file
            $id = $student->id;
            $file = $request->avatar;
          $file -> move("/uploads/","$id.jpg");

        return redirect()->route('student.index');
        }

    }

    public function api_store(request $request)
    {
            $student = new StudentModel;
            $student->fullname = $request->fullname;
            $student->DOB = $request->DOB;
            $student->sex = $request->sex;
            $student->address = $request->address;
            $student->class_id = $request->class_id;
            $student->description = $request->description;

            $student->save();
            $data['id'] = $student->id;
            return response()->json($student->id,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
   

    }

      public function api_show($id)
    {
       
        $student = StudentModel::findOrFail($id);
        return response()->json($student,200);
   

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
         $student = StudentModel::findOrFail($id);
         $classes = ClassModel::all();
        return view('student.edit', ['student'=>$student],['classes'=>$classes] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules=[
            'fullname' => 'required',
            'avatar' => 'mimes:jpeg,bmp,png'
        ];
        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){
            return redirect()->route('student.edit',['student'=>$id]->withErrors($validator)->withInput());
        }
        else {
            $student = StudentModel::findOrFail($id);
             $student->class_id = $request->class_id;
            $student->fullname = $request->fullname;
            $student->DOB = $request->DOB;
            $student->sex = $request->sex;
            $student->address = $request->address;
            
            $student->description = $request->description;
            $student->save();

                $id = $student->id;
            $file = $request -> avatar;
            if(!is_null($file))                
          $file -> move("./uploads/","$id.jpg");

            return redirect()->route('student.index');
        }
    }

    public function api_update(request $request, $id)
    {
           $student = StudentModel::findOrFail($id);
            $student->class_id = $request->class_id;
            $student->fullname = $request->fullname;
            $student->DOB = $request->DOB;
            $student->sex = $request->sex;
            $student->address = $request->address;
            
            $student->description = $request->description;

            $student->save();

            return response()->json("",204);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $student = StudentModel::findOrFail($id);

        $student->delete();

        if(file_exists("./public/uploads/$id.jpg"))
            unlink("./public/uploads/$id.jpg");
        return redirect()->route('student.index');
    }



   public function api_destroy($id)
    {
              $student = StudentModel::findOrFail($id);

        $student->delete();

        if(file_exists("./public/uploads/$id.jpg"))
            unlink("./public/uploads/$id.jpg");
        return response()->json("",204);
    }

        }
