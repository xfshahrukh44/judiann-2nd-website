<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Page;
use App\Models\Portfolio;
use App\Models\Settings;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function aboutJudiann()
    {
        $about = Page::where('name', 'About Judiann')->first();
        if ($about) {
            $data = json_decode($about->content);
            return view('front.about-judiann', compact('data', 'about'));
        }
        return view('front.about-judiann', compact('about'));
    }

    public function aboutUs()
    {
        $about = Page::where('name', 'About')->first();
        if($about){
            $data = json_decode($about->content);
            return view('front.about-us', compact('data', 'about'));
        }
        return view('front.about-us', compact('about'));
    }

    public function faqs()
    {
        $faqs = Faq::all();
        $faqPage = Page::where('name', 'FAQ')->first();
        if($faqPage){
            $data = json_decode($faqPage->content);
            return view('front.faqs', compact('data', 'faqs', 'faqPage'));
        }
        return view('front.faqs', compact('faqPage', 'faqs'));
    }

    public function judiannPortfolio()
    {
        $sort_portfolio = Portfolio::all()->sortBy('image_order');
        $portfolio = Page::where('name', 'Portfolio')->first();
        if($portfolio){
            $data = json_decode($portfolio->content);
            return view('front.judiann-portfolio', compact('data', 'portfolio', 'sort_portfolio'));
        }
        return view('front.judiann-portfolio', compact('portfolio', 'sort_portfolio'));
    }

    public function contact()
    {
        $setting = Settings::all();
        $contact = Page::where('name', 'Contact')->first();
        if($contact){
            $data = json_decode($contact->content);
            return view('front.contact', compact('contact', 'data', 'setting'));
        }
        return view('front.contact', compact('setting', 'contact'));
    }
}
