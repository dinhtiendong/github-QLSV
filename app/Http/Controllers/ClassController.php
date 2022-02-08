<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ClassModel;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\App;
class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         $lang = $request->session()->get('lang')?$request->session()->get('lang'):'en';
         App::setLocale($lang);
        //
        $classes = ClassModel::orderBy('id','desc')->paginate(5);
        return view('class.index',['classes'=>$classes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('class.new');
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
            'name' => "required"
        ];

        $Validator = Validator::make($request->all(), $rules);

        if($Validator->fails())
        {
            return redirect()->route('class.create')->withErrors($Validator)->withInput();
        }
        else {
            $class = new ClassModel;
            $class->name = $request->name;
            $class->description = $request->description;

            $class->save();
            return redirect()->route('class.index');
        }
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $class = ClassModel::find($id);
        return view('class.edit', ['class'=>$class]);
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
        //
        $rules=[
            'name' => 'required|max:30'
        ];

        $Validator = Validator::make($request->all(),$rules);

        if($Validator->fails()){
            return redirect()->route('class.edit',['class'=>$id]->withErrors($Validator)->withInput());
        }
        else {
            $class = ClassModel::find($id);
            $class->name = $request->name;
            $class->description = $request->description;

            $class->save();

            return redirect()->route('class.index');


        }
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
        $class = ClassModel::findOrFail($id);

        $class->delete();

        return redirect()->route('class.index');
    }
}
