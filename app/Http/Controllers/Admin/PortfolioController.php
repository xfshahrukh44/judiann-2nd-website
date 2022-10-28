<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PortfolioController extends Controller
{
    public function index(){
        return view('admin.portfolio.create');
    }

    public function store(Request $request){
        $rules = [
            'image' => 'required',
            'image_order' => 'required|unique:portfolios'
        ];
        $customs = [
            'image.required' => 'Image Field is Required',
            'image_order.required' => 'Order Field Must be Unique'
        ];
        $validator = Validator::make($request->all(), $rules, $customs);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->getMessageBag()->first());
        }

        try{
            $page = Portfolio::create(
                [
                    'image_order' => $request['image_order']
                ]
            );

            if($request->has('image')) {
                $page->addMediaFromRequest('image')->toMediaCollection('portfolio_images');
            }

            return redirect()->route('admin.cms.portfolio')->with('success', 'Portfolio Created Successfully');

        }catch (\Exception $exception){
            return back()->with('error', $exception->getMessage());
        }
    }

    public function edit($id){
        $portfolio = Portfolio::where('id', $id)->first();
        return view('admin.portfolio.edit', compact('portfolio'));
    }

    public function update(Request $request, $id){
        $portfolio = Portfolio::where('id', $id)->first();
        $inputs = $request->all();

        $portfolio->image_order = $inputs['image_order'];
        $portfolio->update();

        return redirect()->route('admin.cms.portfolio')->with('success', 'Portfolio Updated Successfully');
    }

    public function delete($id){
        $portfolio = Portfolio::find($id);
        $portfolio->delete();
        return redirect()->back()->with('success', 'Portfolio Deleted Successfully');
    }
}
