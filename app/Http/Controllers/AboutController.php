<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AboutController extends Controller
{
    public function index()
    {
        $about = [
            'full_name' => 'Иванов Андрей Борисович',
            'date_of_birth' => '1997-03-16',
            'photo' => asset('storage/images/avatar.jpg'), // путь к изображению
            'education' => '-',
            'about_me' => 'Я опытный разработчик с более чем 5-летним стажем работы в области веб-разработки.',
            'email' => 'ivan.ivanov@example.com',
            'phone' => '+7 (900) 123-45-67',
        ];

        return Inertia::render('About', ['about' => $about]);
    }
}
