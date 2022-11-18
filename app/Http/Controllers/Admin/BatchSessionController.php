<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BatchSession;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BatchSessionController extends Controller
{
    public function index()
    {
        try {
            if (request()->ajax()) {
                return datatables()->of(BatchSession::with('user', 'batch.course')->get())
                    ->addIndexColumn()
                    ->editColumn('created_at', function($data){
                        $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y');
                        return $formatedDate;
                    })
                    ->addColumn('action', function ($data) {
                        return '<a title="View" href="order-view/' . $data->id . '" class="btn btn-dark btn-sm"><i class="fas fa-eye"></i></a>';
                    })->make(true);
            }
        } catch (\Exception $ex) {
            return redirect('/')->with('error', $ex->getMessage());
        }
        return view('admin.order.list');
    }

    final public function show(int $id){
        $content= BatchSession::find($id);
        return view('admin.order.view',compact('content'));
    }
}
