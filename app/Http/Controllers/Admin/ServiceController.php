<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    public function index()
    {
        return view('admin.service.create');
    }

    public function store(Request $request){
        $rules = [
            'title' => 'required',
            'service' => 'required'
        ];
        $customs = [
            'title.required' => 'Title Field is Required',
            'service.required' => 'Service Field is Required'
        ];
        $validator = Validator::make($request->all(), $rules, $customs);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->getMessageBag()->first());
        }

        try{
            $page = Services::create(
                [
                    'title' => $request['title'],
                    'service' => $request['service']
                ]
            );

            if($request->has('image')) {
                $page->addMediaFromRequest('image')->toMediaCollection('service_images');
            }

            return redirect()->route('admin.cms.services')->with('success', 'Service Created Successfully');

        }catch (\Exception $exception){
            return back()->with('error', $exception->getMessage());
        }
    }

    public function delete($id){
        $service = Services::find($id);
        $service->delete();
        return redirect()->back()->with('success', 'Service Deleted Successfully');
    }

    public function edit($id){
        $service = Services::where('id', $id)->first();
        return view('admin.service.edit', compact('service'));
    }

    public function update(Request $request, $id){
        $service = Services::where('id', $id)->first();
        $inputs = $request->all();

        $service->title = $inputs['title'];
        $service->service = $inputs['service'];

        if($request->has('image')) {
            $service->clearMediaCollection('service_images');
            $service->addMediaFromRequest('image')->toMediaCollection('service_images');
        }

        $service->update();

        return redirect()->route('admin.cms.services')->with('success', 'Service Updated Successfully');
    }
}
