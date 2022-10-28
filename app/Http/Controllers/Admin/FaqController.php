<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FaqController extends Controller
{
    public function index(){
        return view('admin.faq.create');
    }

    public function store(Request $request){
        $rules = [
            'ques' => 'required',
            'ans' => 'required'
        ];
        $customs = [
            'ques.required' => 'Question Field is Required',
            'ans.required' => 'Answer Field is Required'
        ];
        $validator = Validator::make($request->all(), $rules, $customs);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->getMessageBag()->first());
        }

        try{
            $page = Faq::create(
                [
                    'question' => $request['ques'],
                    'answer' => $request['ans']
                ]
            );
            return redirect()->route('admin.cms.faq')->with('success', 'FAQ Created Successfully');

        }catch (\Exception $exception){
            return back()->with('error', $exception->getMessage());
        }
    }

    public function delete($id){
        $faq = Faq::find($id);
        $faq->delete();
        return redirect()->back()->with('success', 'FAQ Deleted Successfully');
    }

    public function edit($id){
        $faq = Faq::where('id', $id)->first();
        return view('admin.faq.edit', compact('faq'));
    }

    public function update(Request $request, $id){
        $faq = Faq::where('id', $id)->first();
        $inputs = $request->all();

        $faq->question = $inputs['ques'];
        $faq->answer = $inputs['ans'];
        $faq->update();

        return redirect()->route('admin.cms.faq')->with('success', 'FAQ Updated Successfully');
    }
}
