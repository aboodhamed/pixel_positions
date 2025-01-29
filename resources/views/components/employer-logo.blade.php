@props(['employer','width' => 100])
<img src="http://picsum.photos/seed/{{ rand(0,10000) }}/{{ $width }}/{{ $width }}" alt="" class="rounded-xl">
{{-- <img src="{{asset( $employer->logo ) }}" alt="" class="rounded-xl" width="{{ $width }}"> --}}
