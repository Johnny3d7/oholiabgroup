<header class="main-header bg-white d-flex justify-content-between p-2" >
    <div class="header-toggle">
        <div class="menu-toggle mobile-menu-icon">
            <div></div>
            <div></div>
            <div></div>
        </div>
        <a href="{{ route('backStack') }}" class="mr-3" style="text-decoration: none !important;">
            <i class="i-To-Left text-20 cursor-pointer" data-toggle="tooltip" data-placement="top" title="" data-original-title="Retour"></i>
        </a>
        @yield('raccourcis')
    </div>
    <div class="header-part-right">
        <!-- Full screen toggle-->
        <i class="i-Full-Screen header-icon d-none d-sm-inline-block" data-fullscreen=""></i>

        <!-- Grid menu Dropdown-->
        <div class="dropdown dropleft">
            <i class="i-Safe-Box text-muted header-icon" id="dropdownMenuButton" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <div class="menu-icon-grid">
                    @can('show_module_page')
                        <a href="{{ route('modules.index') }}"><i class="i-Shop-4"></i> Modules</a>
                    @endcan
                    @if (\Auth::user()->home())
                        <a href="{{ route(\Auth::user()->home()['name']) }}"><i class="i-Home-4"></i> Accueil</a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Notification -->
        {{-- <div class="dropdown dropleft">
            <div role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="cursor: pointer;">
                <i class="i-Bell header-icon" id="notificationMenuButton"></i>
                @php $count = 7; @endphp
                @if ($count > 0 )
                    <span class="button__badge">{{ $count < 100 ? $count : '9+'  }}</span>
                @endif
            </div>
            <div class="dropdown-menu bg-primary py-1" aria-labelledby="dropdownMenuButton" style="border-radius: 10px;">
                <div class="card" style="width: 30rem; max-width: 90vw;">
                    <div class="card-body pr-1">
                        <div class="card-title border-bottom pb-2 mb-3">
                            Notifications
                            <a href="#" class="float-right pr-2 text-14"><u>Tout marquer comme lu</u></a>
                        </div>
                        <div class="ul-widget-app__browser-list pr-3" style="height: 25rem; overflow-y: auto;">
                            @if ($count > 0)
                                <div class="ul-widget-app__browser-list-1 mb-4"><i class="i-Bell1 text-white bg-warning rounded-circle p-2 mr-3"></i><span class="text-15">You have 9 pending Tasks</span><span class="text-mute">in a sec</span></div>
                                <div class="ul-widget-app__browser-list-1 mb-4"><i class="i-Internet text-white green-500 rounded-circle p-2 mr-3"></i><span class="text-15">Traffic Overloaded</span><span class="text-mute">4 Hours ago</span></div>
                                <div class="ul-widget-app__browser-list-1 mb-4"><i class="i-Shopping-Cart text-white cyan-500 rounded-circle p-2 mr-3"></i><span class="text-15">New Order Received</span><span class="text-mute">yesterday </span></div>
                                <div class="ul-widget-app__browser-list-1 mb-4"><i class="i-Add-UserStar text-white teal-500 rounded-circle p-2 mr-3"></i><span class="text-15">New User </span><span class="text-mute">2 April </span></div>
                                <div class="ul-widget-app__browser-list-1 mb-4"><i class="i-Bell text-white purple-500 rounded-circle p-2 mr-3"></i><span class="text-15">New Update </span><span class="text-mute">2 April </span></div>
                                <div class="ul-widget-app__browser-list-1 mb-4"><i class="i-Shopping-Cart text-white bg-danger rounded-circle p-2 mr-3"></i><span class="text-15">New Order Received</span><span class="text-mute">yesterday </span></div>
                                <div class="ul-widget-app__browser-list-1 mb-4"><i class="i-Internet text-white green-500 rounded-circle p-2 mr-3"></i><span class="text-15">Traffic Overloaded</span><span class="text-mute">4 Hours ago</span></div>
                            @else
                                <div class="text-center text-16">Aucune Notification</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="dropdown dropleft">
            <div role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="cursor: pointer;">
                <i class="i-Bell header-icon" id="notificationMenuButton"></i>
                @php $notifications = \Auth::user()->notifs(); $count = count($notifications); @endphp
                @if ($count > 0 )
                    <span class="button__badge">{{ $count < 10 ? $count : '9+'  }}</span>
                @endif
            </div>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="border-radius: 10px;">
                {{-- <div class="text-center p-1 mb-2 border-bottom">
                    <h5 class="text-primary text-uppercase font-weight-bold">{{ \Auth::user()->username }}</h5>
                    <h6><i>Profession - Company</i></h6>
                </div> --}}
                <div class="py-3 pl-3 pr-1" style="width: 25rem; max-width: 70vw;">
                    <div class="pr-1">
                        <div class="border-bottom pb-2 mb-3">
                            <h4 style="vertical-align: bottom">
                                Notifications
                                <a href="{{ $count > 0 ? route('markAllAsRead') : 'javascript:void(0);' }}" class="float-right pr-2 text-12">
                                    <u>Tout marquer comme lu</u>
                                </a>
                            </h4>

                        </div>

                        <div class="ul-widget-app__recent-messages" style="height: 25rem; overflow-y: auto;">
                            @forelse ($notifications->sortByDesc('created_at') as $notification)
                                <div class="ul-widget-app__row-comments border-bottom-gray-200 mb-0 notifLink" data-link="{{ $notification->link ?? '#' }}">
                                    <div class="ul-widget-app__profile-pic mr-1">
                                        {{-- <img class="profile-picture avatar-md mb-2 rounded-circle img-fluid" src="../../dist-assets/images/faces/1.jpg" alt="alt"> --}}
                                        <i class="i-Bell1 text-white bg-{{ $notification->type() }} rounded-circle p-2 mr-3"></i>
                                    </div>
                                    <div class="ul-widget-app__comment">
                                        <div class="ul-widget-app__profile-title">
                                            <h6 class="heading">{{ $notification->title }}</h6>
                                            <p class="mb-1">{{ $notification->body }}</p>
                                        </div>
                                        <div class="ul-widget-app__profile-status"><small class="text-mute">2 min ago</small></div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center text-16">Aucune Notification</div>
                            @endforelse
                        </div>

                        {{-- <div class="ul-widget-app__browser-list pr-3" style="height: 25rem; overflow-y: auto;">
                            @forelse ($notifications as $notification)
                                <div class="ul-widget-app__browser-list-1 mb-4">
                                    <i class="i-Bell1 text-white bg-warning rounded-circle p-2 mr-3"></i>
                                    <div class="">
                                        <span class="text-15">{{ $notification->title }}</span> <br>
                                        <span class="text-13">{{ $notification->body }}</span> <br>
                                        <span class="text-mute">in a sec</span>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center text-16">Aucune Notification</div>
                            @endforelse
                            <hr>
                            @if ($count > 0)
                                <div class="ul-widget-app__browser-list-1 mb-4"><i class="i-Bell1 text-white bg-warning rounded-circle p-2 mr-3"></i><span class="text-15">You have 9 pending Tasks</span><span class="text-mute">in a sec</span></div>
                                <div class="ul-widget-app__browser-list-1 mb-4"><i class="i-Internet text-white green-500 rounded-circle p-2 mr-3"></i><span class="text-15">Traffic Overloaded</span><span class="text-mute">4 Hours ago</span></div>
                                <div class="ul-widget-app__browser-list-1 mb-4"><i class="i-Shopping-Cart text-white cyan-500 rounded-circle p-2 mr-3"></i><span class="text-15">New Order Received</span><span class="text-mute">yesterday </span></div>
                                <div class="ul-widget-app__browser-list-1 mb-4"><i class="i-Add-UserStar text-white teal-500 rounded-circle p-2 mr-3"></i><span class="text-15">New User </span><span class="text-mute">2 April </span></div>
                                <div class="ul-widget-app__browser-list-1 mb-4"><i class="i-Bell text-white purple-500 rounded-circle p-2 mr-3"></i><span class="text-15">New Update </span><span class="text-mute">2 April </span></div>
                                <div class="ul-widget-app__browser-list-1 mb-4"><i class="i-Shopping-Cart text-white bg-danger rounded-circle p-2 mr-3"></i><span class="text-15">New Order Received</span><span class="text-mute">yesterday </span></div>
                                <div class="ul-widget-app__browser-list-1 mb-4"><i class="i-Internet text-white green-500 rounded-circle p-2 mr-3"></i><span class="text-15">Traffic Overloaded</span><span class="text-mute">4 Hours ago</span></div>
                                <div class="ul-widget-app__browser-list-1 mb-4"><i class="i-Bell text-white purple-500 rounded-circle p-2 mr-3"></i><span class="text-15">New Update </span><span class="text-mute">2 April </span></div>
                                <div class="ul-widget-app__browser-list-1 mb-4"><i class="i-Shopping-Cart text-white bg-danger rounded-circle p-2 mr-3"></i><span class="text-15">New Order Received</span><span class="text-mute">yesterday </span></div>
                                <div class="ul-widget-app__browser-list-1 mb-4"><i class="i-Internet text-white green-500 rounded-circle p-2 mr-3"></i><span class="text-15">Traffic Overloaded</span><span class="text-mute">4 Hours ago</span></div>
                            @else
                                <div class="text-center text-16">Aucune Notification</div>
                            @endif
                        </div> --}}
                    </div>
                </div>

            </div>
        </div>

        {{-- <div class="dropdown dropleft">
            <div role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="cursor: pointer;">
                <i class="i-Bell header-icon" id="notificationMenuButton"></i>
                @php $count = 7; @endphp
                @if ($count > 0 )
                    <span class="button__badge">{{ $count < 100 ? $count : '9+'  }}</span>
                @endif
            </div>
            <div class="dropdown-menu bg-primary py-1" aria-labelledby="dropdownMenuButton" style="border-radius: 10px;">
                <div class="" style="width: 30rem; max-width: 90vw;">
                    <div class="pr-1">
                        <div class="border-bottom pb-2 mb-3">
                            Notifications
                            <a href="#" class="float-right pr-2 text-14"><u>Tout marquer comme lu</u></a>
                        </div>
                        <div class="ul-widget-app__browser-list pr-3" style="height: 25rem; overflow-y: auto;">
                            @if ($count > 0)
                                <div class="ul-widget-app__browser-list-1 mb-4"><i class="i-Bell1 text-white bg-warning rounded-circle p-2 mr-3"></i><span class="text-15">You have 9 pending Tasks</span><span class="text-mute">in a sec</span></div>
                                <div class="ul-widget-app__browser-list-1 mb-4"><i class="i-Internet text-white green-500 rounded-circle p-2 mr-3"></i><span class="text-15">Traffic Overloaded</span><span class="text-mute">4 Hours ago</span></div>
                                <div class="ul-widget-app__browser-list-1 mb-4"><i class="i-Shopping-Cart text-white cyan-500 rounded-circle p-2 mr-3"></i><span class="text-15">New Order Received</span><span class="text-mute">yesterday </span></div>
                                <div class="ul-widget-app__browser-list-1 mb-4"><i class="i-Add-UserStar text-white teal-500 rounded-circle p-2 mr-3"></i><span class="text-15">New User </span><span class="text-mute">2 April </span></div>
                                <div class="ul-widget-app__browser-list-1 mb-4"><i class="i-Bell text-white purple-500 rounded-circle p-2 mr-3"></i><span class="text-15">New Update </span><span class="text-mute">2 April </span></div>
                                <div class="ul-widget-app__browser-list-1 mb-4"><i class="i-Shopping-Cart text-white bg-danger rounded-circle p-2 mr-3"></i><span class="text-15">New Order Received</span><span class="text-mute">yesterday </span></div>
                                <div class="ul-widget-app__browser-list-1 mb-4"><i class="i-Internet text-white green-500 rounded-circle p-2 mr-3"></i><span class="text-15">Traffic Overloaded</span><span class="text-mute">4 Hours ago</span></div>
                            @else
                                <div class="text-center text-16">Aucune Notification</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        <!-- Profile -->
        <div class="dropdown dropleft">
            <img class="rounded-circle m-0 ul-task-manager__avatar header-icon p-1" src="{{ asset(\Auth::user()->image()) }}" alt="alt" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{-- <i class="i-Safe-Box text-muted header-icon" id="dropdownMenuButton"></i> --}}
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <div class="text-center p-1 mb-2 border-bottom">
                    <h5 class="text-primary text-uppercase font-weight-bold">{{ \Auth::user()->username }}</h5>
                    <h6><i>Profession - Company</i></h6>
                </div>
                <div class="menu-icon-grid">
                    {{-- <a href="{{ route('modules.index') }}"><i class="i-Shop-4"></i> Modules</a> --}}
                    <a href="{{ route('profile.index') }}"><i class="i-Male-21"></i> Profile</a>
                    <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        <i class="i-Close"></i> Déconnexion
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>

    </div>
</header>
