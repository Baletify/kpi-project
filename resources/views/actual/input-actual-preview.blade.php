<x-app-layout :title="$title" :desc="$desc">
    @foreach ($previews as $preview)
    @php
        dd($preview)->toArray();
    @endphp        
    @endforeach
</x-app-layout>