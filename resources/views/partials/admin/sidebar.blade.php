<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <img src="{{asset('img/bone.png')}}" alt="{{ config("app.name") }}" style="width:25px;">
        </div>
        <div class="sidebar-brand-text mx-3">{{ config("app.name", "BoNeMEAL")}}</div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Players
    </div>

    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-users"></i>
            <span>Players</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-comments"></i>
            <span>Player Notes</span></a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Punishments
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePunishments" aria-expanded="true" aria-controls="collapsePunishments">
            <i class="fas fa-fw fa-cog"></i>
            <span>Active Punishments</span>
        </a>
        <div id="collapsePunishments" class="collapse" aria-labelledby="headingPunishments" data-parent="#accordionSidebar">
            <div class="py-2 collapse-inner bg-light rounded">
                <a class="collapse-item" href="#">Active Bans</a>
                <a class="collapse-item" href="#">Active Warnings</a>
                <a class="collapse-item" href="#">Active Mutes</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePunish" aria-expanded="true" aria-controls="collapsePunish">
            <i class="fas fa-fw fa-hammer"></i>
            <span>Punish Player</span>
        </a>
        <div id="collapsePunish" class="collapse" aria-labelledby="headingPunish" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="#">Ban Player</a>
                <a class="collapse-item" href="#">Warn Player</a>
                <a class="collapse-item" href="#">Mute Player</a>
                <a class="collapse-item" href="#">Add Note to Player</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Settings
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseConfig" aria-expanded="true" aria-controls="collapseConfig">
            <i class="fas fa-fw fa-cog"></i>
            <span>Configuration</span>
        </a>
        <div id="collapseConfig" class="collapse" aria-labelledby="headingConfig" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="#">Servers</a>
                <a class="collapse-item" href="#">Settings</a>
                <a class="collapse-item" href="#">Users</a>

            </div>
        </div>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    {{--    Update Available!--}}
    <div class="d-none d-sm-block">
        <div class="sidebar-card">
            <img class="sidebar-card-illustration mb-2" src="{{ asset('img/rocket.png') }}" alt="">
            <p class="text-center mb-2"><strong>Upgrade Available</strong> Lorem ipsum dolor set amet </p>
            <a class="btn btn-success btn-sm" href="https://github.com/ftbastler/BoNeMEAL">Upgrade Now!</a>
        </div>
    </div>

</ul>
