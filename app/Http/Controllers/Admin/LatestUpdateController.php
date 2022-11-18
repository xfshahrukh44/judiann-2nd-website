<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LatestUpdate;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LatestUpdateController extends Controller
{
    public function index()
    {
        try {
            if (request()->ajax()) {
                return datatables()->of(LatestUpdate::orderBy('created_at', 'DESC')->get())
                    ->addIndexColumn()
                    ->editColumn('created_at', function($data){
                        $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y');
                        return $formatedDate;
                    })
                    ->addColumn('action', function ($data) {
                        return '<a title="View" href="latest-update-view/' . $data->id . '" class="btn btn-dark btn-sm"><i class="fas fa-eye"></i></a>&nbsp;<a title="edit" href="latest-update-edit/' . $data->id . '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>&nbsp;<button title="Delete" type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>';
                    })->make(true);
            }
        } catch (\Exception $ex) {
            return redirect('/')->with('error', $ex->getMessage());
        }
        return view('admin.latest-update.list');
    }

    public function addLatestUpdate(Request $request)
    {
        if ($request->method() == 'POST') {
            $this->validate($request, array(
                'title' => 'required|string|max:50',
                'description' => 'required',
            ));

            $latest_update = LatestUpdate::create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
            ]);

            if ($latest_update) {
                return redirect()->route('latest-update')->with(['success' => 'Course Update Added Successfully']);
            }
        }

        return view('admin.latest-update.add-latest-update');
    }

    final public function show(int $id){
        $content= LatestUpdate::find($id);
        return view('admin.latest-update.view',compact('content'));
    }

    final public function edit(Request $request, $id){
        if ($request->method() == 'POST') {
            $this->validate($request, array(
                'title' => 'required|string|max:50',
                'description' => 'required',
            ));

            $latest_update = LatestUpdate::find($id);

            $latest_update->title = $request->input('title');
            $latest_update->description = $request->input('description');

            if ($latest_update->save()) {
                return redirect()->route('latest-update')->with(['success' => 'Course Update Edit Successfully']);
            }
        }else {
            $content=LatestUpdate::findOrFail($id);
            return view('admin.latest-update.add-latest-update', compact('content'));
        }
    }

    final public function destroy(int $id)
    {
        $content=LatestUpdate::find($id);
        $content->delete();
        echo 1;
    }
}
