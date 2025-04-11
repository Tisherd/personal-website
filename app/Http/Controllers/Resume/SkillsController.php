<?php

namespace App\Http\Controllers\Resume;

use Inertia\Inertia;
use Inertia\Response;

use App\Http\Controllers\Controller;
use App\Models\SkillGroup;

class SkillsController extends Controller
{
    public function index(): Response
    {
        $skillGroups = SkillGroup::with(['skills' => function($query) {
            $query->orderBy('sort');
        }])
            ->orderBy('sort')
            ->get();

        return Inertia::render('Resume/Skills', [
            'skillGroups' => $skillGroups
        ]);
    }
}
