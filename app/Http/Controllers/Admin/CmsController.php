<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class
CmsController extends Controller
{
    public function aboutUs(Request $request)
    {
        if ($request->method() == 'POST') {

        } else {
            return view('admin.cms.about');
        }
    }

    public function faq(Request $request)
    {
        $faqs = Faq::all();
        if ($request->method() == 'POST') {
            $rules = [
                'banner_title' => 'required',
            ];
            $customs = [
                'banner_title.required' => 'Banner Title Field is Required',
            ];
            $validator = Validator::make($request->all(), $rules, $customs);

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->getMessageBag()->first());
            }

            $faq = Page::where('name', 'FAQ')->first();

            try{
                if($faq){
                    $decodedContent = json_decode($faq->content);
                }

                //bannerImage
                if ($request->hasFile('banner_image')) {
                    $banner_image = time() . '_' . $request['banner_image']->getClientOriginalName();
                    $request['banner_image']->move(public_path() . '/front/images/cms/', $banner_image);
                }

                $content = [
                    'banner_image' => $request->hasFile('banner_image') ? $banner_image : ($decodedContent->banner_image ?? ''),
                    'banner_title' => !empty($request['banner_title']) ? $request['banner_title'] : '',
                    'faq_title' => !empty($request['faq_title']) ? $request['faq_title'] : '',
                ];

                $page = Page::updateOrCreate(
                    [
                        'name' => 'FAQ',
                    ],
                    [
                        'slug' => $home->slug ?? 'faq',
                        'content' => json_encode($content) ?? '',
                        'meta_title' => $request['meta_title'] ?? '',
                        'meta_description' => $request['meta_description'] ?? ''
                    ],
                );

                return back()->with('success', 'Page Updated Successfully');

            }catch (\Exception $exception){
                return back()->with('error', $exception->getMessage());
            }
        } else {
            $faqPage = Page::where('name', 'FAQ')->first();
            if($faqPage){
                $data = json_decode($faqPage->content);
                return view('admin.cms.faq', compact('faqs', 'data', 'faqPage'));
            }
            return view('admin.cms.faq', compact('faqs', 'faqPage'));
        }
    }
}
