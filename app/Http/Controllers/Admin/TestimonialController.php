<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        try {
            if (request()->ajax()) {
                return datatables()->of(Testimonial::get())
                    ->addIndexColumn()
                    ->editColumn('created_at', function($data){
                        $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d M Y, h:i A');
                        return $formatedDate;
                    })
                    ->addColumn('action', function ($data) {
                        return '<a title="View" href="testimonial-view/' . $data->id . '" class="btn btn-dark btn-sm"><i class="fas fa-eye"></i></a>&nbsp;<button title="Delete" type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>'
                            .
                            (is_null($data->is_approved) ?
                                '&nbsp;<a title="Approve" href="testimonial-approve/' . $data->id . '" class="btn btn-success btn-sm"><i class="fas fa-check"></i></a>
                                &nbsp;<a title="Reject" href="testimonial-reject/' . $data->id . '" class="btn btn-danger btn-sm"><i class="fas fa-ban"></i></a>'
                                : '');
                    })->rawColumns(['action'])->make(true);
            }
        } catch (\Exception $ex) {
            return redirect('/')->with('error', $ex->getMessage());
        }
        return view('admin.testimonial.list');
    }

    final public function destroy(int $id)
    {
        $content=Testimonial::find($id);
        $content->delete();
        echo 1;
    }

    public function approve(Request $request, $id)
    {
        $content = Testimonial::find($id);
        $content->is_approved = 1;
        $content->save();
        return redirect()->route('testimonial')->with(['success' => 'Testimonial Approved Successfully']);
    }

    public function reject(Request $request, $id)
    {
        $content = Testimonial::find($id);
        $content->is_approved = 0;
        $content->save();
        return redirect()->route('testimonial')->with(['success' => 'Testimonial Rejected Successfully']);
    }
}
