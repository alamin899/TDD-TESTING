<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();

        return view('projects.index', compact('projects'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'owner_id' => 'required'
        ]);

        Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'owner_id' => $request->owner_id,
        ]);

        return redirect('/projects');
    }


    public function show()
    {
        $project = Project::findOrFail(\request('project')); //request('project') url parameter

        return view('projects.show',compact('project'));
    }
}
