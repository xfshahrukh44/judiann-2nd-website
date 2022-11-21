<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Page;
use App\Models\PortfolioImage;
use App\Models\Services;
use App\Models\Settings;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CmsController extends Controller
{
    public function home(Request $request)
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

            $home = Page::where('name', 'Home')->first();

            try {
                if ($home) {
                    $decodedContent = json_decode($home->content);
                }

                //bannerImage
                if ($request->hasFile('banner_image')) {
                    $banner_image = time() . '_' . $request['banner_image']->getClientOriginalName();
                    $request['banner_image']->move(public_path() . '/front/images/cms/', $banner_image);
                }

                if ($request->hasFile('vid_img1')) {
                    $vid_img1 = time() . '_' . $request['vid_img1']->getClientOriginalName();
                    $request['vid_img1']->move(public_path() . '/front/images/cms/', $vid_img1);
                }

                if ($request->hasFile('vid_img2')) {
                    $vid_img2 = time() . '_' . $request['vid_img2']->getClientOriginalName();
                    $request['vid_img2']->move(public_path() . '/front/images/cms/', $vid_img2);
                }

                if ($request->hasFile('vid_img3')) {
                    $vid_img3 = time() . '_' . $request['vid_img3']->getClientOriginalName();
                    $request['vid_img3']->move(public_path() . '/front/images/cms/', $vid_img3);
                }

                if ($request->hasFile('vid_img4')) {
                    $vid_img4 = time() . '_' . $request['vid_img4']->getClientOriginalName();
                    $request['vid_img4']->move(public_path() . '/front/images/cms/', $vid_img4);
                }

                $content = [
                    'banner_image' => $request->hasFile('banner_image') ? $banner_image : ($decodedContent->banner_image ?? ''),
                    'vid_img1' => $request->hasFile('vid_img1') ? $vid_img1 : ($decodedContent->vid_img1 ?? ''),
                    'vid_img2' => $request->hasFile('vid_img2') ? $vid_img2 : ($decodedContent->vid_img2 ?? ''),
                    'vid_img3' => $request->hasFile('vid_img3') ? $vid_img3 : ($decodedContent->vid_img3 ?? ''),
                    'vid_img4' => $request->hasFile('vid_img4') ? $vid_img4 : ($decodedContent->vid_img4 ?? ''),
                    'banner_title' => !empty($request['banner_title']) ? $request['banner_title'] : '',
                    'banner_content' => !empty($request['banner_content']) ? $request['banner_content'] : '',
                    'abt_title' => !empty($request['abt_title']) ? $request['abt_title'] : '',
                    'abt_content' => !empty($request['abt_content']) ? $request['abt_content'] : '',
                    'portfolio_title' => !empty($request['portfolio_title']) ? $request['portfolio_title'] : '',
                    'stdnt_title' => !empty($request['stdnt_title']) ? $request['stdnt_title'] : '',
                    'vogue_content' => !empty($request['vogue_content']) ? $request['vogue_content'] : '',
                    'vogue_url' => !empty($request['vogue_url']) ? $request['vogue_url'] : '',
                    'master_title' => !empty($request['master_title']) ? $request['master_title'] : '',
                    'master_content' => !empty($request['master_content']) ? $request['master_content'] : '',
                    'service_title' => !empty($request['service_title']) ? $request['service_title'] : '',
                    'service_content' => !empty($request['service_content']) ? $request['service_content'] : '',
                    'offer_title' => !empty($request['offer_title']) ? $request['offer_title'] : '',
                    'offer_content1' => !empty($request['offer_content1']) ? $request['offer_content1'] : '',
                    'offer_content2' => !empty($request['offer_content2']) ? $request['offer_content2'] : '',
                    'vid_url1' => !empty($request['vid_url1']) ? $request['vid_url1'] : '',
                    'vid_url2' => !empty($request['vid_url2']) ? $request['vid_url2'] : '',
                    'vid_url3' => !empty($request['vid_url3']) ? $request['vid_url3'] : '',
                    'vid_url4' => !empty($request['vid_url4']) ? $request['vid_url4'] : '',
                ];

                $page = Page::updateOrCreate(
                    [
                        'name' => 'Home',
                    ],
                    [
                        'slug' => $home->slug ?? 'home',
                        'content' => json_encode($content) ?? '',
                        'meta_title' => $request['meta_title'] ?? '',
                        'meta_description' => $request['meta_description'] ?? ''
                    ],
                );

                return back()->with('success', 'Page Updated Successfully');

            } catch (\Exception $exception) {
                return back()->with('error', $exception->getMessage());
            }
        } else {
            $home = Page::where('name', 'Home')->first();
            if ($home) {
                $data = json_decode($home->content);
                return view('admin.cms.home', compact('data', 'home'));
            }
            return view('admin.cms.home', compact('home'));
        }
    }

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

            try {
                if ($about) {
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


            } catch (\Exception $exception) {
                return back()->with('error', $exception->getMessage());
            }
        } else {
            $about = Page::where('name', 'About')->first();
            if ($about) {
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

            try {
                if ($faq) {
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

            } catch (\Exception $exception) {
                return back()->with('error', $exception->getMessage());
            }
        } else {
            $faqPage = Page::where('name', 'FAQ')->first();
            if ($faqPage) {
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

            try {
                if ($about) {
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


            } catch (\Exception $exception) {
                return back()->with('error', $exception->getMessage());
            }
        } else {
            $about = Page::where('name', 'About Judiann')->first();
            if ($about) {
                $data = json_decode($about->content);
                return view('admin.cms.about-judiann', compact('about', 'data'));
            }
            return view('admin.cms.about-judiann', compact('about'));
        }
    }

    public function contactUs(Request $request)
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

            try {
                if ($about) {
                    $decodedContent = json_decode($about->content);
                }

                //bannerImage
                if ($request->hasFile('banner_image')) {
                    $banner_image = time() . '_' . $request['banner_image']->getClientOriginalName();
                    $request['banner_image']->move(public_path() . '/front/images/cms/', $banner_image);
                }

                $content = [
                    'banner_image' => $request->hasFile('banner_image') ? $banner_image : ($decodedContent->banner_image ?? ''),
                    'banner_title' => !empty($request['banner_title']) ? $request['banner_title'] : '',
                    'form_title' => !empty($request['form_title']) ? $request['form_title'] : ''
                ];

                $page = Page::updateOrCreate(
                    [
                        'name' => 'Contact',
                    ],
                    [
                        'slug' => $home->slug ?? 'contact-us',
                        'content' => json_encode($content) ?? '',
                        'meta_title' => $request['meta_title'] ?? '',
                        'meta_description' => $request['meta_description'] ?? ''
                    ],
                );

                return back()->with('success', 'Page Updated Successfully');


            } catch (\Exception $exception) {
                return back()->with('error', $exception->getMessage());
            }
        } else {
            $contact = Page::where('name', 'Contact')->first();
            if ($contact) {
                $data = json_decode($contact->content);
                return view('admin.cms.contact', compact('contact', 'data'));
            }
            return view('admin.cms.contact', compact('contact'));
        }
    }

    public function portfolio(Request $request)
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

            $portfolio = Page::where('name', 'Portfolio')->first();

            try {
                if ($portfolio) {
                    $decodedContent = json_decode($portfolio->content);
                }

                //bannerImage
                if ($request->hasFile('banner_image')) {
                    $banner_image = time() . '_' . $request['banner_image']->getClientOriginalName();
                    $request['banner_image']->move(public_path() . '/front/images/cms/', $banner_image);
                }

                $content = [
                    'banner_image' => $request->hasFile('banner_image') ? $banner_image : ($decodedContent->banner_image ?? ''),
                    'banner_title' => !empty($request['banner_title']) ? $request['banner_title'] : '',
                    'section_title' => !empty($request['section_title']) ? $request['section_title'] : ''
                ];

                $page = Page::updateOrCreate(
                    [
                        'name' => 'Portfolio',
                    ],
                    [
                        'slug' => $home->slug ?? 'portfolio',
                        'content' => json_encode($content) ?? '',
                        'meta_title' => $request['meta_title'] ?? '',
                        'meta_description' => $request['meta_description'] ?? ''
                    ],
                );

                return back()->with('success', 'Page Updated Successfully');


            } catch (\Exception $exception) {
                return back()->with('error', $exception->getMessage());
            }
        } else {
            $portfolios = \App\Models\Portfolio::all();
            $portfolio = Page::where('name', 'Portfolio')->first();
            if ($portfolio) {
                $data = json_decode($portfolio->content);
                return view('admin.cms.portfolio', compact('portfolio', 'data', 'portfolios'));
            }
            return view('admin.cms.portfolio', compact('portfolio', 'portfolios'));
        }
    }

    public function student_work(Request $request)
    {
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

        $student_work = Page::where('name', 'Students Work')->first();

        try {
            if ($student_work) {
                $decodedContent = json_decode($student_work->content);
            }

            //bannerImage
            if ($request->hasFile('banner_image')) {
                $banner_image = time() . '_' . $request['banner_image']->getClientOriginalName();
                $request['banner_image']->move(public_path() . '/front/images/cms/', $banner_image);
            }

            $content = [
                'banner_image' => $request->hasFile('banner_image') ? $banner_image : ($decodedContent->banner_image ?? ''),
                'banner_title' => !empty($request['banner_title']) ? $request['banner_title'] : '',
                'section_title' => !empty($request['section_title']) ? $request['section_title'] : ''
            ];

            $page = Page::updateOrCreate(
                [
                    'name' => 'Students Work',
                ],
                [
                    'slug' => $home->slug ?? 'students-work',
                    'content' => json_encode($content) ?? '',
                    'meta_title' => $request['meta_title'] ?? '',
                    'meta_description' => $request['meta_description'] ?? ''
                ],
            );

            return back()->with('success', 'Page Updated Successfully');


        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }

    }

    public function student_index()
    {
        try {
            if (request()->ajax()) {
                return datatables()->of(Student::get())
                    ->addIndexColumn()
                    ->addColumn('image', function ($data) {
                        return $data->get_student_image();
                    })
                    ->editColumn('created_at', function ($data) {
                        $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y');
                        return $formatedDate;
                    })
                    ->addColumn('action', function ($data) {
                        return '<a title="View" href="student-view/' . $data->id . '" class="btn btn-dark btn-sm"><i class="fas fa-eye"></i></a>&nbsp;<a title="edit" href="student-edit/' . $data->id . '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>&nbsp;<button title="Delete" type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>';
                    })->make(true);
            }
        } catch (\Exception $ex) {
            return redirect('/')->with('error', $ex->getMessage());
        }
        $student_work = Page::where('name', 'Students Work')->first();
        if ($student_work) {
            $data = json_decode($student_work->content);
            return view('admin.cms.student-work', compact('student_work', 'data', 'student_work'));
        }
        return view('admin.cms.student-work', compact('student_work', 'student_work'));
//        return view('admin.cms.student-work');
    }

    public function student_add(Request $request)
    {
        if ($request->method() == 'POST') {
            $this->validate($request, array(
                'name' => 'required|string|max:50',
                'image' => 'required',
                'portfolio_images' => 'required',
            ));

            //create course
            $student = Student::create([
                'name' => $request->input('name'),
            ]);

            //student image
            if ($request->has('image')) {
                $student->addMediaFromRequest('image')->toMediaCollection('student_images');
            }

            //portfolio images
            if ($request->has('portfolio_images')) {
                $portfolio_array = $request['portfolio_images'];
                foreach ($portfolio_array as $image) {
                    $portfolio_image = PortfolioImage::create([
                        'student_id' => $student->id
                    ]);

                    $portfolio_image->addMedia($image)->toMediaCollection('portfolio_images');
                }
            }

            if ($student) {
                return redirect()->route('student')->with(['success' => 'Student Added Successfully']);
            }
        }

        return view('admin.student.add-student');
    }

    final public function student_show(int $id)
    {
        $content = Student::find($id);
        return view('admin.student.view', compact('content'));
    }

    final public function student_edit(Request $request, $id)
    {
        if ($request->method() == 'POST') {
            $this->validate($request, array(
                'name' => 'required|string|max:50',
                'image' => 'sometimes',
                'portfolio_images' => 'sometimes',
            ));

            $student = Student::find($id);

            $student->name = $request->input('name');

            //student image
            if ($request->has('image')) {
                $student->clearMediaCollection('student_images');
                $student->addMediaFromRequest('image')->toMediaCollection('student_images');
            }

            //portfolio images
            if ($request->has('portfolio_images')) {
                $portfolio_array = $request['portfolio_images'];
                foreach ($portfolio_array as $image) {
                    $portfolio_image = PortfolioImage::create([
                        'student_id' => $student->id
                    ]);

                    $portfolio_image->addMedia($image)->toMediaCollection('portfolio_images');
                }
            }

            if ($student->save()) {
                return redirect()->route('student')->with(['success' => 'Course Edit Successfully']);
            }
        } else {
            $content = Student::findOrFail($id);
            return view('admin.student.add-student', compact('content'));
        }
    }

    final public function student_destroy(int $id)
    {
        $content = Student::find($id);
        $portfolio = PortfolioImage::where('student_id', $id)->delete();
        $content->delete();
        echo 1;
    }

    public function portfolio_image_destroy(int $id)
    {
        $portfolio_image = PortfolioImage::find($id);

        $portfolio_image->clearMediaCollection('portfolio_images');

        $portfolio_image->delete();

        return redirect()->back()->with('success', 'Portfolio Image deleted successfully!');
    }

    public function schedule(Request $request)
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

            $schedule = Page::where('name', 'Schedule')->first();

            try {
                if ($schedule) {
                    $decodedContent = json_decode($schedule->content);
                }

                //bannerImage
                if ($request->hasFile('banner_image')) {
                    $banner_image = time() . '_' . $request['banner_image']->getClientOriginalName();
                    $request['banner_image']->move(public_path() . '/front/images/cms/', $banner_image);
                }

                $content = [
                    'banner_image' => $request->hasFile('banner_image') ? $banner_image : ($decodedContent->banner_image ?? ''),
                    'banner_title' => !empty($request['banner_title']) ? $request['banner_title'] : '',
                    'section_title' => !empty($request['section_title']) ? $request['section_title'] : ''
                ];

                $page = Page::updateOrCreate(
                    [
                        'name' => 'Schedule',
                    ],
                    [
                        'slug' => $home->slug ?? 'schedule',
                        'content' => json_encode($content) ?? '',
                        'meta_title' => $request['meta_title'] ?? '',
                        'meta_description' => $request['meta_description'] ?? ''
                    ],
                );

                return back()->with('success', 'Page Updated Successfully');


            } catch (\Exception $exception) {
                return back()->with('error', $exception->getMessage());
            }
        } else {
            $schedule = Page::where('name', 'Schedule')->first();
            if ($schedule) {
                $data = json_decode($schedule->content);
                return view('admin.cms.schedule', compact('schedule', 'data'));
            }
            return view('admin.cms.schedule', compact('schedule'));
        }
    }

    public function services(Request $request)
    {
        $all_services = Services::all();
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

            $services = Page::where('name', 'Services')->first();

            try {
                if ($services) {
                    $decodedContent = json_decode($services->content);
                }

                //bannerImage
                if ($request->hasFile('banner_image')) {
                    $banner_image = time() . '_' . $request['banner_image']->getClientOriginalName();
                    $request['banner_image']->move(public_path() . '/front/images/cms/', $banner_image);
                }

                $content = [
                    'banner_image' => $request->hasFile('banner_image') ? $banner_image : ($decodedContent->banner_image ?? ''),
                    'banner_title' => !empty($request['banner_title']) ? $request['banner_title'] : '',
                    'service_title' => !empty($request['service_title']) ? $request['service_title'] : '',
                    'service_content' => !empty($request['service_content']) ? $request['service_content'] : '',
                    'offer_title' => !empty($request['offer_title']) ? $request['offer_title'] : '',
                    'offer_content1' => !empty($request['offer_content1']) ? $request['offer_content1'] : '',
                    'offer_content2' => !empty($request['offer_content2']) ? $request['offer_content2'] : '',
                ];

                $page = Page::updateOrCreate(
                    [
                        'name' => 'Services',
                    ],
                    [
                        'slug' => $home->slug ?? 'services',
                        'content' => json_encode($content) ?? '',
                        'meta_title' => $request['meta_title'] ?? '',
                        'meta_description' => $request['meta_description'] ?? ''
                    ],
                );

                return back()->with('success', 'Page Updated Successfully');

            } catch (\Exception $exception) {
                return back()->with('error', $exception->getMessage());
            }
        } else {
            $services = Page::where('name', 'Services')->first();
            if ($services) {
                $data = json_decode($services->content);
                return view('admin.cms.services', compact( 'all_services', 'data', 'services'));
            }
            return view('admin.cms.services', compact( 'all_services', 'services'));
        }
    }

    public function terms(Request $request)
    {
        if ($request->method() == 'POST') {
            $request->validate([
                'terms' => 'required'
            ]);

            $setting = Settings::find(1);
            $setting->terms = $request->get('terms');
            $setting->save();

            return back()->with('success', 'Page Updated Successfully');
        } else {
            return view('admin.cms.terms');
        }
    }

    public function policy(Request $request)
    {
        if ($request->method() == 'POST') {
            $request->validate([
                'policy' => 'required'
            ]);

            $setting = Settings::find(1);
            $setting->policy = $request->get('policy');
            $setting->save();

            return back()->with('success', 'Page Updated Successfully');
        } else {
            return view('admin.cms.policy');
        }
    }

}
