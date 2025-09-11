<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProjectController extends Controller
{
    //
    use AuthorizesRequests;

    protected array $headers = [
        'Content-Type' => 'application/json'
    ];

    public function index(){
        $projects = Project::where('owner_id', Auth::id())->get();
        return response()->json($projects, 200, $this->headers);
    }

    public function show(Project $project){
        $this->authorize('view', $project);
        return response()->json($project, 200, $this->headers);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $project = Project::create([
            'name' => $request -> name,
            'description' => $request -> description,
            'owner_id' => Auth::id(),
        ]);

        return response()->json($project, 201, $this->headers);
    }

    public function update(Request $request, Project $project){
        $this->authorize('update', $project);

        $request->validate([
            'name' => 'required|string|max:250',
            'description' => 'nullable|string',
            'archived' => 'boolean'
        ]);

        $project->update($request->only('name','description', 'archived'));

        return response()->json($project, 200, $this->headers);
    }

    public Function destroy(Project $project){
        $this->authorize('delete',$project);
        $project->delete();

        return response()->json(['messaje' => 'Project deleted'], 200, $this->headers);
    }

    public Function archive(Request $request, Project $project){
        $this->authorize('update', $project);

        $request->validate([
            'archived' => 'required|boolean',
        ]);

        $project->archived=$request->archived;
        $project->save();
        
        return response()->json([
            'message' => $project->archived ? 'Project archived' : 'Project unarchived', 'project' => $project
        ], 200, $this->headers);
    }
}
