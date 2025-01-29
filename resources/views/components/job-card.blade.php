@props(['job'])

<x-panel class="flex flex-col text-center">
    <div class="self-start text-sm flex justify-between w-full">
        <span>{{ $job->employer->employer }}</span>  
        <a href="{{ route('jobs.show', $job->id) }}" class="ml-auto "><h1 class="bg-blue-700 hover:bg-blue-900 rounded-2xl text-2xs font-bold transition-colors duration-300 px-4 py-1">show</h1></a>
    </div>
    
    <div class="py-8">
        <h3 class="group-hover:text-blue-600 text-xl font-bold transition-colors duration-1000">
            <a href="{{ $job->url }}" target="_blank">{{ $job->title }}</a>
        </h3>
        <p class="text-sm mt-4">{{ $job->salary }} - {{ $job->schedule }}</p>
           
        <p class="text-sm my-1">{{ $job->location }}</p>
    </div>

    <div class="flex justify-between items-center mt-auto">
        <div>
            @if($job->tags)
         @foreach ($job->tags as $tag)
             <x-tag :tag="$tag" size="small" />
         @endforeach
         @endif
     
        </div>

        <x-employer-logo :employer="$job->employer" :width="42" />
    </div>
</x-panel>
