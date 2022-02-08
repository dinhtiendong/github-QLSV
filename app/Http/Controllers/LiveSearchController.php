<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LiveSearchController extends Controller
{
    
    public function index(){
    	$student = StudentModel::all();
    	return view('student.index',['student'=>$student]);
    }

    public function search (Request $request)
    {
    	$output = '';
    	$students = StudentModel::where('name','LIKE','%'.$request->keyword.'%')->get();
    	foreach ($students as $user) {
    		$output .= '<tr>
    		<td>'.$user->fullname.'</td>
    		<td>'.$user->DOB.'</td>
    		<td>'.$user->sex?"Nam":"Nữ".'</td>
    		<td>'.$user->address.'</td>
    		<td>'.$user->class->name.'</td>
    		<td>'.$user->address.'</td>
			</tr>';
    	}
    	return response()->json($output);
    }
}
