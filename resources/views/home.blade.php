@extends('layouts.app')

@section('content')

<div class="oz-hero">
    <span class="oz-eyebrow"><span class="oz-dot"></span>Alpha Development &middot; VATSIM Network Bay Assignment System (OzBays)</span>

    @if(Auth::guest())
        <h1>Welcome to <span class="oz-amber-text">OzBays</span> &mdash; coming in 2026</h1>
    @else
        <h1>Welcome back, {{Auth::user()->fullName('F')}} <br> <span class="oz-amber-text">OzBays</span> is coming in 2026</h1>
    @endif

    <p class="lead">Automatic bay assignment for VATSIM Australia Pacific (VATPAC) controlled airports. This system is still in active development and is currently <strong>not deployed</strong> on the VATSIM network.</p>

    <div class="oz-actions">
        <a href="{{route('airportIndex')}}" class="oz-btn oz-btn-primary"><i class="fa fa-plane"></i> Explore Airports</a>
        <a href="{{route('mapIndex')}}" target="_blank" class="oz-btn oz-btn-ghost"><i class="fa fa-map"></i> View Live Map</a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="oz-card-dark">
                    <div class="oz-section-title"><i class="fa fa-info-circle"></i> About the System</div>
                    <p>Utilise the nav bar to access information for each airport currently supported by the system, as well as a map showing all aircraft currently being monitored by OzBays. This information is dynamic and will change frequently.</p>
                    <p class="mb-0">The system is still in alpha development, meaning it is not yet used by OzStrips or sending messages via the Hoppies network. Over time, airports will be activated to assign bays to aircraft and advise the pilot/ATC &mdash; this will show in the status section of the <a href="{{route('airportIndex')}}">Airports</a> view.</p>
                </div>
            </div>
        </div>

        <div class="oz-card-dark">
            <div class="oz-section-title"><i class="fa fa-plane-arrival"></i> Ground Traffic</div>
            <x id="ground-traffic"></x>
        </div>
    </div>

    <div class="col-md-4">
        <div class="oz-card-dark">
            @if(Auth::guest())
                <div class="oz-section-title"><i class="fa fa-discord"></i> OzBays Discord</div>
                <p>OzBays has a dedicated Discord Server for VATSIM community members. This server is a place for announcements, discussion, as well as feedback to be provided from the community directly to those developing &amp; maintaining the program.</p>
                <p class="mb-0">Sign in with VATSIM SSO in order to link your Discord account, to access the OzBays Discord server.</p>
            @elseif(Auth::user()->discord_member == false)
                <div class="oz-section-title"><i class="fa fa-discord"></i> OzBays Discord</div>
                <p>OzBays has a dedicated Discord Server for VATSIM community members. This server is a place for announcements, discussion, as well as feedback to be provided from the community directly to those developing &amp; maintaining the program.</p>
                <p class="mb-0"><strong>Access your Dashboard and link your Discord account to access the server.</strong></p>
            @elseif(Auth::user()->discord_user_id !== null && Auth::user()->discord_member == true)
                <div class="oz-section-title"><i class="fa fa-discord"></i> OzBays Discord</div>
                <p class="mb-0">You are already a member of the OzBays server, use this to report any issues you come across, or recommend any potential new features to the OzBays team!</p>
            @endif
        </div>
    </div>
</div>

<script>
    function loadLadder() {
        fetch('/partial/home/airport-stats')
            .then(res => res.text())
            .then(html => {
                const container = document.getElementById('ground-traffic');

                // Create temp wrapper
                const temp = document.createElement('div');
                temp.innerHTML = html;

                // Replace children in one operation
                container.replaceChildren(...temp.children);
            });
        }

        // Initial load
        loadLadder();

        // Refresh every 15s
        setInterval(loadLadder, 15000);
</script>
@endsection