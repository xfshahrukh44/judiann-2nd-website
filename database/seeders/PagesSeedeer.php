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
        Page::create([
            'name' => 'About Judiann',
            'slug' => 'about-judiann',
            'content' => json_encode([
                'main_content' => 'Judiann Echezabal is a Fashion Design Professor with over a decade of experience teaching college level courses. She teaches at Parsons and Pratt Institute.She has taught at various other institutions such as Columbia University, Westchester Community College and Long Island University. She has taught master Classes for an institution in China, and continues to teach with them online. Judiann has been a Fashion Designer for over 3 decades. She holds a BFA in Fashion design with a minor in manufacturing and an MBA in business management.

                    Judiann has served as Curriculum Integration Coordinator, created one-of-a-kind classes, and aided in the fruition of the Master’s of Fine Arts Fashion Degree.

                       She has developed a fashion design and marketing program for Long Island University for at risk middle school students empowering students who were economically and mentally burdened, living in homeless shelters or foster care. She was awarded Instructor of the year for her development and involvement.

                        Judiann holds many outlets in her creative practice outside of teaching including, academic research and professional work that ranges from published works, one of a kind academic curriculum, international public speaking events, and an established design company.'
            ]),
        ]);
    }
}
