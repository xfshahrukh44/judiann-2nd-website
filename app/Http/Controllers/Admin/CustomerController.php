<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use App\Models\User;
use App\Traits\PHPCustomMail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    use PHPCustomMail;

    public function index()
    {
        try {
            if (request()->ajax()) {
                return datatables()->of(User::where('role_id', 2))
                    ->addIndexColumn()
                    ->editColumn('created_at', function($data){
                        $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y');
                        return $formatedDate;
                    })
                    ->addColumn('action', function ($data) {
                        return
                            $data->is_blocked == 1 ?
                            '<a title="View" href="customer-view/' . $data->id . '" class="btn btn-dark btn-sm"><i class="fas fa-eye"></i></a><button type="button" id="' . $data->id . '" title="Unblock" href="customer-block/' . $data->id . '" class="btn btn-success btn-sm block" data-block="0"><i class="fas fa-stop"></i></button>&nbsp;<a title="edit" href="customer-edit/' . $data->id . '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>&nbsp;<button title="Delete" type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>'
                            : '<a title="View" href="customer-view/' . $data->id . '" class="btn btn-dark btn-sm"><i class="fas fa-eye"></i></a><button type="button" id="' . $data->id . '" title="Block" href="customer-block/' . $data->id . '" class="btn btn-danger btn-sm block" data-block="1"><i class="fas fa-stop"></i></button>&nbsp;<a title="edit" href="customer-edit/' . $data->id . '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>&nbsp;<button title="Delete" type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>';
                    })->make(true);
            }
        } catch (\Exception $ex) {
            return redirect('/')->with('error', $ex->getMessage());
        }
        return view('admin.customer.list');
    }

    final public function show(int $id){
        $content= User::find($id);
        return view('admin.customer.view',compact('content'));
    }

    final public function edit(Request $request, $id){
        if ($request->method() == 'POST') {
            $this->validate($request, array(
                'name' => 'required|string|max:50',
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'sometimes',
                'phone' => 'sometimes',
            ));

            $customer = User::find($id);

            $customer->name = $request->input('name');
            $customer->email = $request->input('email');
            if(!empty($request->password)) {
                $customer->password = hash::make($request->input('password'));
            }
            $customer->phone = $request->input('phone');

            if ($customer->save()) {
                return redirect()->route('customer')->with(['success' => 'Course Edit Successfully']);
            }
        }else {
            $content=User::findOrFail($id);
            return view('admin.customer.add-customer', compact('content'));
        }
    }

    final public function destroy(int $id)
    {
        $content=User::find($id);

        //send account termination email
        $this->accountTerminationMail($content->email, $content->name);

        $content->delete();
        echo 1;
    }

    final public function block(int $id)
    {
        $content=User::find($id);
        $content->is_blocked = $content->is_blocked == 0 ? 1 : 0;
        $content->save();
        echo 1;
    }

    public function accountTerminationMail($email_to, $name)
    {
        try {
            $message = 'Dear '.$name.', your Judiann student account has been terminated.';

            return $this->customMail('info@judiannsfashiondesignstudios.com', $email_to, 'Judiann Fashion Design Studios | Account Termination', $message);
        } catch (\Exception $exception) {
            return redirect()->back()->with('errors', $exception->getMessage());
        }
    }
}
