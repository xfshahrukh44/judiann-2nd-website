<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PagesSeedeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::query()->truncate();

        //ABOUT JUDIANN
        Page::create([
            'name' => 'About Judiann',
            'slug' => 'about-judiann',
            'content' => json_encode([
                'banner_title' => 'About Judiann',
                'abt_heading' => 'About Judiann',
                'abt_heading2' => 'About The Studio:',
                'abt_content' => '<h3>What does our studio offer: </h3>
                        <p><strong>Sewing Classes Offered: Beginning, Advanced, Couture, Tailoring Pattern Making and
                                Draping Classes: </strong></p>
                        <p class="mt-4"><strong>(Note:</strong> For Pattern Making and Draping Classes we recommend that
                            you to take at least a beginner sewing class first) </p>',
                'main_content' => 'Judiann Echezabal is a Fashion Design Professor with over a decade of experience teaching college level courses. She teaches at Parsons and Pratt Institute.She has taught at various other institutions such as Columbia University, Westchester Community College and Long Island University. She has taught master Classes for an institution in China, and continues to teach with them online. Judiann has been a Fashion Designer for over 3 decades. She holds a BFA in Fashion design with a minor in manufacturing and an MBA in business management.

                    Judiann has served as Curriculum Integration Coordinator, created one-of-a-kind classes, and aided in the fruition of the Master’s of Fine Arts Fashion Degree.

                       She has developed a fashion design and marketing program for Long Island University for at risk middle school students empowering students who were economically and mentally burdened, living in homeless shelters or foster care. She was awarded Instructor of the year for her development and involvement.

                        Judiann holds many outlets in her creative practice outside of teaching including, academic research and professional work that ranges from published works, one of a kind academic curriculum, international public speaking events, and an established design company.'
            ]),
        ]);

        //ABOUT US
        Page::create([
            'name' => 'About',
            'slug' => 'about-us',
            'content' => json_encode([
                'banner_title' => 'About Us',
                'abt_heading' => 'About Us',
                'sub_content' => 'Our in-house programs and remote learning classes create a hands-on, collaborative learning experience.',
                'main_content' => 'Judiann’s Fashion Design Studios aims at providing a higher
                        education level for students looking to enhance their skill sets and learn professional methods of constructing a garment.
                        Additionally we aim to teach students just starting out who want to gain a professional level of
                        learning. Our programs are designed to help the individual reach their goals. These goals could
                        be just personal learning to make things for themselves., for students applying to college and
                        need to prepare a professional portfolio, or for students who just need extra help while in
                        college.'
            ]),
        ]);

        //CONTACT US
        Page::create([
            'name' => 'Contact',
            'slug' => 'contact-us',
            'content' => json_encode([
                'banner_title' => 'Contact Us',
                'form_title' => 'Contact form'
            ]),
        ]);

        //PORTFOLIO
        Page::create([
            'name' => 'Portfolio',
            'slug' => 'portfolio',
            'content' => json_encode([
                'banner_title' => 'Judiann’s Portfolio',
                'section_title' => 'Judiann’s Portfolio'
            ]),
        ]);

        //FAQS
        Page::create([
            'name' => 'FAQ',
            'slug' => 'faq',
            'content' => json_encode([
                'banner_title' => 'Faq`s',
                'faq_title' => 'Faq`s'
            ]),
        ]);

        //STUDENTS WORK
        Page::create([
            'name' => 'Students Work',
            'slug' => 'students-work',
            'content' => json_encode([
                'banner_title' => 'Student’s Work',
                'section_title' => 'Student’s Work'
            ]),
        ]);

        //SCHEDULE
        Page::create([
            'name' => 'Schedule',
            'slug' => 'schedule',
            'content' => json_encode([
                'banner_title' => 'Schedule A Class',
                'section_title' => 'Schedule A Class'
            ]),
        ]);

        //SERVICE
        Page::create([
            'name' => 'Services',
            'slug' => 'services',
            'content' => json_encode([
                'banner_title' => 'Services',
                'service_title' => 'Services',
                'service_content' => '5-15 day intensive training courses are devoted to creating a garment. These intensives offer classes for specific garments such as couture garments (such as evening wear or a wedding dress). Learn to tailor a coat, jacket or pair of trousers.',
                'offer_title' => 'What we Offer',
                'offer_content1' => 'Sewing classes from beginner to advanced. Classes will be offered as private classes and
                            group classes. Please see the schedule for class times or contact us for a one on one class.
                            Classes are hold online and in person',
                'offer_content2' => 'College prep and College students specialized portfolio courses:'
            ]),
        ]);

        //HOME
        Page::create([
            'name' => 'Home',
            'slug' => 'home',
            'content' => json_encode([
                'banner_title' => 'Judiann’s Fashion Design Studios',
                'banner_content' => 'Learn beginner, College level and industry professional
                                        level skills through our Master Classes.',
                'abt_title' => 'About Us',
                'abt_content' => 'Our in-house programs and remote learning classes create a hands-on,
                                  collaborative learning experience.',
                'portfolio_title' => 'Judiann’s Portfolio',
                'stdnt_title' => 'Student’s Work',
                'vogue_content' => 'Students in the news showcased in Vogue Magazine',
                'vogue_url' => 'https://www.vogue.com/fashion-shows/fall-2022-ready-to-wear/pratt-institute#review',
                'master_title' => 'MASTER CLASS',
                'master_content' => '<h3 class="headTwo">Portfolio Development for College Applications</h3>
                    <p>Are you looking to apply to a Fashion or Art school and need help in preparing a
                        professional portfolio to include with your applications? Most Art schools will require
                        some type of portfolio to be included when you apply.</p>
                    <p>We offer private sessions where we work with you individually on the development of your
                        portfolio. </p>
                    <h3 class="headTwo">What is a Portfolio?</h3>
                    <p>Think of the portfolio as a visual resume which is used to express the best of your work
                        that is well edited and curated. Your portfolio is a very important tool that you will
                        use to sell yourself to a prospective school.</p>
                    <p>Your portfolio should be able to express to the viewer your ideas, aesthetics, vision and
                        who you are as a designer. It should communicate your quality, values and skills.</p>
                    <p>Individual Classes dates and times will be determined after a consultation. We can
                        schedule these based on your needs and my availability. </p>
                    <p>12 classes over a 3 month period. (1 class per week x 3 months) This can be adjusted if
                        needed. Each class is one hour. The student will be expected to do the work discussed in
                        the session and have it ready for the next session.<br>Cost $2500</p>',
                'service_title' => 'Services',
                'service_content' => '5-15 day intensive training courses are devoted to creating a garment. These intensives offer classes for specific garments such as couture garments (such as evening wear or a wedding dress). Learn to tailor a coat, jacket or pair of trousers.',
                'offer_title' => 'What we Offer',
                'offer_content1' => 'Sewing classes from beginner to advanced. Classes will be offered as private classes and group classes. Please see the schedule for class times or contact us for a one on one class. Classes are hold online and in person',
                'offer_content2' => 'College prep and College students specialized portfolio courses:',
                'vid_url1' => 'https://www.youtube.com/watch?v=cKjdTA91xPQ&feature=youtu.be',
                'vid_url2' => 'https://www.youtube.com/watch?v=cKjdTA91xPQ&feature=youtu.be',
                'vid_url3' => 'https://www.youtube.com/watch?v=cKjdTA91xPQ&feature=youtu.be',
                'vid_url4' => 'https://www.youtube.com/watch?v=cKjdTA91xPQ&feature=youtu.be',
            ]),
        ]);
    }
}
