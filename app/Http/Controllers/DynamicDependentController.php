<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DynamicDependentController extends Controller
{
    public function index()
    {
        $departments = DB::table('courses')->groupBy('department')->get();
        $years = DB::table('courses')->groupBy('year')->get();

        return view('courses')->with('departments', $departments)->with('years', $years);
    }

    public function fetch(Request $request)
    {
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        $department = $request->get('department');
        $data = DB::table('courses')->where('department', $department)->where($select, $value)->groupBy($dependent)->get();

        $output = '<option value="">Select '.ucfirst($dependent).'</option>';

        foreach($data as $row)
        {
            $output .= '<option value="'.$row->$dependent.'">'.$row->$dependent.'</option>';
        }

        echo $output;
    }
}
