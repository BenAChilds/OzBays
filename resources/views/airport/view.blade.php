@extends('layouts.app')

@section('content')

<div class="oz-board-header">
    <div>
        <span class="oz-eyebrow"><span class="oz-dot"></span>Live Arrivals Board</span>
        <h1 class="oz-board-title"><span class="oz-fids-icao">{{$airport->icao}}</span> {{$airport->name}}</h1>
        <a href="{{route('airportIndex')}}" class="oz-board-back"><i class="fas fa-arrow-left"></i> See All Airports</a>
    </div>

    <div class="oz-board-clock">
        <span class="oz-board-clock-label">UTC / Zulu</span>
        <span class="oz-board-clock-time" id="oz-zulu-clock">--:--:--</span>
    </div>
</div>

<x id="controller-info">

</x>

<script>
    const airportIcao = @json($airport->icao);

    function loadLadder() {
        fetch(`/partial/airport/ladder/${airportIcao}`)
            .then(res => res.text())
            .then(html => {
                document.getElementById('controller-info').innerHTML = html;
            });
    }

    function tickClock() {
        const el = document.getElementById('oz-zulu-clock');
        if (!el) return;
        el.textContent = new Date().toISOString().substr(11, 8);
    }

    // Initial load
    loadLadder();
    tickClock();

    // Then run update every 30s / every second
    setInterval(loadLadder, 30000);
    setInterval(tickClock, 1000);
</script>


@endsection
