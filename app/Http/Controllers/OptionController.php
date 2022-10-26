<?php

namespace App\Http\Controllers;

use App\Models\Major;
use App\Models\MajorSubject;
use App\Models\StudentSubject;
use App\Models\Subject;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function index(){
        return view('admin/option/index', [
            'data' => Major::all(),
            'data_subject' => Subject::all()
        ]);  
        
    }

    public function getmatakuliah(request $request){
        $id_jurusan = $request->id_jurusan;
        $data_subject = MajorSubject::with("subject")->where('major_id','=',$id_jurusan)->get();

        return response()->json([
            'data' => $data_subject,
        ]);
    }
}
                  
