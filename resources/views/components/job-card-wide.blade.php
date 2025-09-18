@props(['job'])

<x-panel class="flex gap-x-6">  
    <div>
        <x-employer-logo :employer="$job->employer" />
    </div>

    <div class="flex-1 flex flex-col">
        <a href="#" class="self-start text-sm text-gray-400 transition-colors duration-300">{{ $job->employer->employer }}</a>
        <h3 class="font-bold text-lg mt-3 group-hover:text-blue-800 p-1">
            <a href="{{ $job->url }}" target="_blank"> {{ $job->title }} </a>
        </h3>

        <p class="text-sm text-gray-400 mt-auto p-1">{{ $job->salary }} - {{ $job->schedule }}</p>
        <p class="text-sm text-gray-400 mt-auto p-1"> {{ $job->location }}</p>

        <div class="ml-auto pb-4">
    
            @if($job->tags)
                @foreach ($job->tags as $tag)
                    <x-tag :tag="$tag" size="small" />
                @endforeach
          
            @endif
        </div>

        @if(!request()->routeIs('jobs.show'))
            <a href="{{ route('jobs.show', $job->id) }}" class="p-1 text-center">
                <h1 class="bg-blue-700 hover:bg-blue-900 rounded-2xl text-2xs font-bold transition-colors duration-300 px-4 py-1">show</h1>
            </a>
        @else
         
            <div class="flex ">
            <a href="{{ route('jobs.edit', $job->id) }}" class="p-1 text-center w-11/12">
                <h1 class="bg-blue-700 hover:bg-blue-900 rounded-2xl text-2xs font-bold transition-colors duration-300 px-4 py-1">edit</h1>
            </a>
          
            <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" class="pl-1 text-center" >
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-700 hover:bg-red-900 rounded-2xl text-2xs font-bold transition-colors duration-300 px-4 py-1">delete</button>
            </form>
          
            </div>
    
        @endif
    </div>
</x-panel>
