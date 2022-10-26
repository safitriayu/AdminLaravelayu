<?php

namespace App\Http\Controllers;

use App\Models\StudentSubject;
use App\Models\Major;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            // $data = StudentSubject::distinct('student_id')->where('status',"PENDING")->get();
            $data = Major::all();

            //id civil engineering
            $data_subject = MajorSubject::where('major_id',$id_major)->get('subject_id');
            return view('admin.option.index', [
                'data' => $data,
                'data_subject'=>$data_subject
            ]);
        } catch (\Throwable $th) {
            dd($th);
            return redirect('/option')->with('toast_error',  'Halaman tidak dapat di akses!');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $data = StudentSubject::all();

            return view('admin.option.create', [
                'data' => $data,
            ]);
        } catch (\Throwable $th) {
            return redirect('/option')->with('toast_error',  'Halaman tidak dapat di akses!');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            Option::create([
                'user_id' => $request->user_id,
            ]);
            return redirect('/option')->with('toast_success', 'Data berhasil ditambah!');
        } catch (\Throwable $th) {
            dd($th);
            return redirect('/option')->with('toast_error',  'Data tidak berhasil ditambah!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $data = StudentSubject::where('student_id',$id)
                                    ->whereBetween('created_at',array(Carbon::now()->subDays(60),Carbon::now()))
                                    ->get();
            foreach($data as $x){
                $x['count'] = StudentSubject::where('subject_id',$x->subject_id)->count();
            }

            return view('admin.option.edit', [
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            dd($th);
            return redirect('/option')->with('toast_error',  'Halaman tidak dapat di akses!');
        }
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
        try {
            if(($request->value)=="true"){
                StudentSubject::where('id',$id)->update([
                    'status'=>'ONGOING'
                ]);
            }
            if(($request->value)=="false"){
                StudentSubject::where('id',$id)->update([
                    'status'=>'REJECTED'
                ]);
            }
            if(($request->value)=="revert"){
                StudentSubject::where('id',$id)->update([
                    'status'=>'PENDING'
                ]);
            }
            return response()->json(['result'=>$request->value]);

            
        } catch (\Throwable $th) {
            return redirect()->back()->with('toast_error',  'Data tidak berhasil diubah!');
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
        try {
            Option::where('id', $id)->delete();
            return redirect('/option')->with('toast_success', 'Data berhasil dihapus!');
        } catch (\Throwable $th) {
            return redirect('/option')->with('toast_error',  'Data tidak berhasil dihapus!');
        }
    }
}