<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function index()
    {
        try {
            if (request()->ajax()) {
                return datatables()->of(Voucher::get())
                    ->addIndexColumn()
                    ->editColumn('created_at', function($data){
                        $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y');
                        return $formatedDate;
                    })
                    ->editColumn('discount_rate', function($data){
                        return $data->discount_rate . '% Off';
                    })
                    ->editColumn('valid_until', function ($data) {
                        $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y');
                        return $formatedDate;
                    })
                    ->addColumn('course', function ($data) {
                        return $data->course->name ?? 'N/A';
                    })
                    ->addColumn('action', function ($data) {
                        return '<button title="Delete" type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>';
                    })->make(true);
            }
        } catch (\Exception $ex) {
            return redirect('/')->with('error', $ex->getMessage());
        }
        return view('admin.voucher.list');
    }

    public function addVoucher(Request $request)
    {
        if ($request->method() == 'POST') {
            $this->validate($request, array(
                'course_id' => 'required',
                'description' => 'required',
                'code' => 'required',
                'discount_rate' => 'required',
                'valid_until' => 'required'
            ));

            //create voucher
            $voucher = Voucher::create([
                'course_id' => $request->input('course_id'),
                'description' => $request->input('description'),
                'code' => $request->input('code'),
                'discount_rate' => $request->input('discount_rate'),
                'valid_until' => $request->input('valid_until'),
            ]);

            if ($voucher) {
                return redirect()->route('voucher')->with(['success' => 'Voucher Added Successfully']);
            }
        }

        $courses = Course::all();
        return view('admin.voucher.add-voucher', compact('courses'));
    }

    final public function edit(Request $request, $id)
    {
        if ($request->method() == 'POST') {
            $this->validate($request, array(
                'course_id' => 'required',
                'description' => 'required',
                'code' => 'required',
                'discount_rate' => 'required',
                'valid_until' => 'required'
            ));

            $voucher = Voucher::find($id);

            $voucher->course_id = $request->input('course_id');
            $voucher->description = $request->input('description');
            $voucher->code = $request->input('code');
            $voucher->discount_rate = $request->input('discount_rate');
            $voucher->valid_until = $request->input('valid_until');

            if ($voucher->save()) {
                return redirect()->route('voucher')->with(['success' => 'Voucher Edit Successfully']);
            }
        } else {
            $content = Voucher::findOrFail($id);
            return view('admin.voucher.add-voucher', compact('content'));
        }
    }

    final public function destroy(int $id)
    {
        $content = Voucher::find($id);
        $content->delete();
        echo 1;
    }
}
