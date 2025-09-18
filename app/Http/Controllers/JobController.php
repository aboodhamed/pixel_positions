<?php

 namespace App\Http\Controllers;

 use App\Models\Employer;
 use App\Models\Job;
 use App\Models\Tag;
 use Illuminate\Auth\Access\Gate;
 use Illuminate\Auth\Middleware\Authorize;
 use Illuminate\Contracts\Auth\Access\Gate as AccessGate;
 use Illuminate\Http\Request;
 use Illuminate\Support\Arr;
 use Illuminate\Support\Facades\Auth;
 use Illuminate\Support\Facades\Gate as FacadesGate;
 use Illuminate\Validation\Rule;

class JobController extends Controller
{

    // Display a listing of the resource.
    public function index()
    {
        $jobs = Job::latest()->with(['employer', 'tags'])->get()->groupBy('featured');

        // Check if the group keys 0 and 1 exist
        $featuredJobs = $jobs->has(1) ? $jobs[1] : collect(); // Default to an empty collection if 1 doesn't exist
        $normalJobs = $jobs->has(0) ? $jobs[0] : collect();  // Default to an empty collection if 0 doesn't exist
    
        return view('jobs.index', [
            'jobs' => $normalJobs,
            'featuredJobs' => $featuredJobs,
            'tags' => Tag::all(),
        ]);
    }
    
    // Show the form for creating a new resource.
    public function create()
    {
        return view('jobs.create');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => ['required'],
            'salary' => ['required'],
            'location' => ['required'],
            'schedule' => ['required'],
            'url' => ['required', 'active_url'],
            'tags' => ['nullable'], 
        ]);
    
        $attributes['featured'] = $request->has('featured');

        $employer = Auth::user()->employer->firstOrCreate([
            'user_id' => Auth::id()
        ]);
    
        $job = $employer->jobs()->create(Arr::except($attributes, 'tags'));
    
        if ($attributes['tags'] ?? false) {
            foreach (explode(',', $attributes['tags']) as $tagName) {
                $tag = Tag::firstOrCreate(['name' => trim($tagName)]); // Find or create the tag
                $job->tags()->attach($tag); // Attach the tag to the job
            }
        }
    
        return redirect('/');
    }

    // Display the specified resource.
    public function show(Job $job)
    {     
        if(Auth::guest())
        {   return redirect('/login');  }
        

        $job->load('tags');
        return view('jobs.show', [
            'job' => $job,
        ]);
    }
    public function edit(Job $job)
    {
        FacadesGate::authorize('update', $job);
        return view('jobs.edit', ['job' => $job->load('tags')]);
    }

     public function update(Request $request, Job $job)
     {
        if(Auth::guest())
        {    return redirect('/login');   }

        $attributes = $request->validate([
          'title' => 'required',
          'salary' => 'required',
          'location' => 'required',
          'schedule' => 'required',
          'url' => 'required|url',
          'tags' => 'nullable',
         ]);

         $attributes['featured'] = $request->has('featured'); 
        
          // Remove tags from attributes before updating the job
          $tags = $attributes['tags'] ?? '';
           unset($attributes['tags']);

           // Update the job details
           $job->update($attributes);

           // Handle tags update
           $job->tags()->detach();
           if (!empty($tags)) {
             foreach (explode(',', $tags) as $tagName) {
             $tag = Tag::firstOrCreate(['name' => trim($tagName)]);
             $job->tags()->attach($tag);
             }
            }

            return redirect()->route('jobs.show', $job->id)->with('success', 'Job updated successfully.');
     }
    public function destroy(Job $job)
    {
        FacadesGate::authorize('delete', $job);
        $job->delete();
        return redirect('/');
    }

}