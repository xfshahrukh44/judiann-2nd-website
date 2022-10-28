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

            $about = Page::where('name', 'About')->first();

            try{
                if($about){
                    $decodedContent = json_decode($about->content);
                }

                //bannerImage
                if ($request->hasFile('banner_image')) {
                    $banner_image = time() . '_' . $request['banner_image']->getClientOriginalName();
                    $request['banner_image']->move(public_path() . '/front/images/cms/', $banner_image);
                }
                //abtImage
                if ($request->hasFile('abt_image')) {
                    $abt_image = time() . '_' . $request['abt_image']->getClientOriginalName();
                    $request['abt_image']->move(public_path() . '/front/images/cms/', $abt_image);
                }

                $content = [
                    'banner_image' => $request->hasFile('banner_image') ? $banner_image : ($decodedContent->banner_image ?? ''),
                    'abt_image' => $request->hasFile('abt_image') ? $abt_image : ($decodedContent->abt_image ?? ''),
                    'banner_title' => !empty($request['banner_title']) ? $request['banner_title'] : '',
                    'abt_heading' => !empty($request['abt_heading']) ? $request['abt_heading'] : '',
                    'sub_content' => !empty($request['sub_content']) ? $request['sub_content'] : '',
                    'main_content' => !empty($request['main_content']) ? $request['main_content'] : ''
                ];

                $page = Page::updateOrCreate(
                    [
                        'name' => 'About',
                    ],
                    [
                        'slug' => $home->slug ?? 'about-us',
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
            $about = Page::where('name', 'About')->first();
            if($about){
                $data = json_decode($about->content);
                return view('admin.cms.about', compact('about', 'data'));
            }
            return view('admin.cms.about', compact('about'));
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

    public function aboutJudiann(Request $request)
    {
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

            $about = Page::where('name', 'About Judiann')->first();

            try{
                if($about){
                    $decodedContent = json_decode($about->content);
                }

                //bannerImage
                if ($request->hasFile('banner_image')) {
                    $banner_image = time() . '_' . $request['banner_image']->getClientOriginalName();
                    $request['banner_image']->move(public_path() . '/front/images/cms/', $banner_image);
                }
                //abtImage
                if ($request->hasFile('abt_image')) {
                    $abt_image = time() . '_' . $request['abt_image']->getClientOriginalName();
                    $request['abt_image']->move(public_path() . '/front/images/cms/', $abt_image);
                }

                $content = [
                    'banner_image' => $request->hasFile('banner_image') ? $banner_image : ($decodedContent->banner_image ?? ''),
                    'abt_image' => $request->hasFile('abt_image') ? $abt_image : ($decodedContent->abt_image ?? ''),
                    'banner_title' => !empty($request['banner_title']) ? $request['banner_title'] : '',
                    'abt_heading' => !empty($request['abt_heading']) ? $request['abt_heading'] : '',
                    'abt_heading2' => !empty($request['abt_heading2']) ? $request['abt_heading2'] : '',
                    'main_content' => !empty($request['main_content']) ? $request['main_content'] : '',
                    'abt_content' => !empty($request['abt_content']) ? $request['abt_content'] : ''
                ];

                $page = Page::updateOrCreate(
                    [
                        'name' => 'About Judiann',
                    ],
                    [
                        'slug' => $home->slug ?? 'about-judiann',
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
            $about = Page::where('name', 'About Judiann')->first();
            if($about){
                $data = json_decode($about->content);
                return view('admin.cms.about-judiann', compact('about', 'data'));
            }
            return view('admin.cms.about-judiann', compact('about'));
        }
    }
}
