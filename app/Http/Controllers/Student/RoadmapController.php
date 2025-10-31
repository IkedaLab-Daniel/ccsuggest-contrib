<?php
namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\TechField;
use Illuminate\Http\Request;

class RoadmapController extends Controller
{
    public function show(TechField $field)
    {
       
        $roadmaps = config('roadmaps'); 
        $steps    = $roadmaps[$field->name] ?? [];

        return view('student.roadmap.show', compact('field','steps'));
    }
}
