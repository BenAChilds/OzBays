@extends('layouts.app')

@section('content')

<div style="width: 100vw; margin: -50px calc(-50vw + 50%) -1.5rem;">
    <iframe
        src="{{ route('mapEmbed') }}"
        title="OzBays Live Network Map"
        style="display: block; width: 100%; height: 80vh; border: 0;"
        loading="lazy"
        allowfullscreen
    ></iframe>
</div>

@endsection
