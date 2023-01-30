<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use App\Models\Voucher;
use App\Traits\PHPCustomMail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    use PHPCustomMail;

    public function index()
    {
        try {
            if (request()->ajax()) {
                return datatables()->of(Voucher::get())
                    ->addIndexColumn()
                    ->editColumn('created_at', function ($data) {
                        $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y');
                        return $formatedDate;
                    })
                    ->editColumn('discount_rate', function ($data) {
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
                        return '<a title="View" href="voucher-view/' . $data->id . '" class="btn btn-dark btn-sm"><i class="fas fa-eye"></i></a>&nbsp;<button title="Delete" type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>';
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

    final public function show(int $id)
    {
        $content = Voucher::find($id);
        $customers = User::where('role_id', 2)->get();
        return view('admin.voucher.view', compact('content', 'customers'));
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

    public function sendByEmail(Request $request)
    {
        $voucher = Voucher::find($request->voucher_id);
        foreach ($request->emails as $email) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $message = 'Dear User,' . "<br />";
                $message .= "You've been sent a voucher by administration."  . "<br /><br />";
                $message .= 'Voucher Course: ' . $voucher->course->name . "<br />";
                $message .= 'Voucher Code: ' . $voucher->code . "<br />";
                $message .= 'Voucher Valid Until: ' . Carbon::parse($voucher->valid_until)->format('m-d-Y') . ",<br />";
                $this->customMail('noreply@jefds.com', $email, 'Course Voucher', $message);
            }
        }

        return redirect()->back()->with('success', 'Voucher Details Sent Successfully!');
    }
}
