<?php

namespace App\Http\Controllers\Resume;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class SkillsController extends Controller
{
    public function index()
    {
        return Inertia::render('Resume/Skills', []);
    }
}
