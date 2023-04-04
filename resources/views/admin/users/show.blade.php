@extends(isset($profile) && $profile == true ? 'admin.partials.main_profile' : 'admin.partials.main')

@section('raccourcis')
    {{-- @if(!isset($profile) || (isset($profile) && !$profile)) --}}
    @if(!isset($profile) || !$profile)
        @include('admin.users._header')
    @endif
    {{-- @include(isset($profile) && $profile == true ? 'admin.partials._header' : 'admin.users._header') --}}
@endsection

@section('stylesheets')
<link rel="stylesheet" type="text/css" href="{{ asset('myplugins/Dual-Listbox-Transfer/icon_font/css/icon_font.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('myplugins/Dual-Listbox-Transfer/css/jquery.transfer.css?v=0.0.3') }}" />
<link rel="stylesheet" href="{{ asset('myplugins/dropify/css/dropify.css') }}" />
@endsection

@section('menuTitle')
{{ isset($profile) && $profile == true ? 'Mon compte' : 'Utilisateurs' }}
@endsection

@section('pageTitle')
{{ isset($profile) && $profile == true ? 'Mon compte' : 'Utilisateurs' }}
@endsection

@section('content')
<div class="row">
    <div class="container-fluid">
        <div class="card user-profile o-hidden mb-4">
            <div class="header-cover" style="background-image: url({{ asset('images/photo-wide-6.jpg') }}); background-position:center;"></div>
            <div class="user-info"><img class="profile-picture avatar-lg mb-2" src="{{ asset($user->image()) }}" alt="" />
                <p class="m-0 pb-2 text-24">{{ ucfirst($user->username) }} {{ $user->isEmploye() ? '('.$user->employe->civilite.' '.$user->employe->name().')' : ''  }}</p>
                <p class="text-muted m-0">{{ $user->role->name }} {{ $user->isEmploye() ? 'à '. $user->employe->entreprise->name : '' }}</p>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs profile-nav mb-4 text-primary" id="profileTab" role="tablist">
                    <li class="nav-item"><a class="nav-link active" id="user-tab" data-toggle="tab" href="#user" role="tab" aria-controls="user" aria-selected="false">Compte Utilisateur</a></li>
                    {{-- <li class="nav-item"><a class="nav-link" id="role-tab" data-toggle="tab" href="#role" role="tab" aria-controls="role" aria-selected="true">Rôle & permissions</a></li> --}}
                    @if($user->isEmploye())
                        <li class="nav-item"><a class="nav-link" id="employe-tab" data-toggle="tab" href="#employe" role="tab" aria-controls="employe" aria-selected="false">Espace Employé</a></li>
                    @endif
                    {{-- <li class="nav-item"><a class="nav-link" id="timeline-tab" data-toggle="tab" href="#timeline" role="tab" aria-controls="timeline" aria-selected="false">Timeline</a></li>
                    <li class="nav-item"><a class="nav-link" id="about-tab" data-toggle="tab" href="#about" role="tab" aria-controls="about" aria-selected="true">About</a></li>
                    <li class="nav-item"><a class="nav-link" id="friends-tab" data-toggle="tab" href="#friends" role="tab" aria-controls="friends" aria-selected="false">Friends</a></li>
                    <li class="nav-item"><a class="nav-link" id="photos-tab" data-toggle="tab" href="#photos" role="tab" aria-controls="photos" aria-selected="false">Photos</a></li> --}}
                </ul>
                <div class="tab-content" id="profileTabContent">
                    <div class="tab-pane fade active show" id="user" role="tabpanel" aria-labelledby="user-tab">
                        <div class="row">
                            <div class="col-md-8">
                                <h4 class="mb-5">Compte utilisateur</h4>

                                @php $notifs = Auth::user()->all_notifs; $count = count($notifs);@endphp

                                <div class="card mb-4">
                                    <div class="card-header bg-transparent">
                                        <h3 class="card-title text-primary">Notifications</h3>
                                    </div>
                                    <div class="card-body p-0 px-1">
                                        <div class="ul-widget-notification pr-2" style="height: 30rem; overflow-y: auto;">
                                            @forelse ($notifs->sortByDesc('created_at') as $notification)
                                                {{-- <div class="ul-widget-notification-item-div">
                                                    <a class="ul-widget-notification-item" href="{{ $notification->link ?? 'javascript:void(0);' }}">
                                                        <div class="ul-widget-notification-item-icon">
                                                            <i class="i-Bell1 text-white bg-{{ $notification->type() }} rounded-circle p-2 mr-3"></i>
                                                        </div>
                                                        <div class="ul-widget-notification-item-details">
                                                            <div class="ul-widget-notification-item-title {{ !$notification->opened ? 'font-weight-bold' : '' }}">{{ $notification->title }}</div>
                                                            <div class="text-secondary">{{ $notification->body }}</div>
                                                            <div class="ul-widget-notification-item-time">{{ $notification->moment() }}</div>
                                                        </div>
                                                        
                                                    </a>
                                                </div> --}}
                                                <a class="ul-widget-notification-item" href="{{ $notification->link ?? 'javascript:void(0);' }}">
                                                    <div class="d-flex justify-content-space-between pl-2">
                                                        <div class="my-auto">
                                                            <i class="i-Bell1 text-white bg-{{ $notification->type() }} rounded-circle p-2 mr-3"></i>
                                                        </div>
                                                        <div class="">
                                                            <h5 class="text-dark {{ !$notification->opened ? 'font-weight-bold' : '' }}">{{ $notification->title }}</h5>
                                                            <div class="text-secondary pr-5">{{ $notification->body }}</div>
                                                            <p class="text-mute">{{ $notification->moment() }}</p>
                                                        </div>
                                                    </div>
                                                </a>
                                                <hr class="m-0">
                                            @empty
                                                <div class="text-center text-16">Aucune Notification</div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>

                                <div class="card mb-4">
                                    <div class="card-header bg-transparent">
                                        <h3 class="card-title text-primary">Historique de connexion</h3>
                                    </div>
                                    <div class="card-body p-5 text-center" style="height: 16rem; overflow-y: auto;">
                                        <h4 class="text-primary">Coming soon !</h4>
                                        <div class="spinner-bubble spinner-bubble-primary m-5"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="container-fluid">
                                        <div class="card mb-4">
                                            <form action="{{ isset($profile) && $profile == true ? route('profile.update') : route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="card">
                                                    <div class="card-header bg-transparent">
                                                        <h3 class="card-title text-primary">Modification d'informations</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <label class="action-bar-horizontal-label" for="image">Photo de profil:</label>
                                                            <div class="">
                                                                <input type="file" name="image" class="dropify-fr" data-bs-height="180" accept=".png, .jpg, .jpeg" data-default-file="{{ asset($user->image()) }}" />
                                                            </div>
                                                            <div class="mb-4">
                                                                <small class="ul-form__text form-text" id="imageHelpBlock">Veuillez glisser-deposer une image ou cliquer pour selectionner (.png | .jpg | .jpeg)</small>
                                                            </div>

                                                            <label class="action-bar-horizontal-label" for="username">Nom d'utilisateur:</label>
                                                            <div class="mb-4">
                                                                <input class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" id="username" name="username" type="text" value="{{ old('username') ?? $user->username }}" placeholder="Saisissez votre nouveau nom d'utilisateur" required>
                                                                <small class="ul-form__text form-text" id="usernameHelpBlock">Veuillez saisir votre nouveau nom d'utilisateur</small>
                                                                @if ($errors->has('username'))
                                                                    <ul class="alert-danger p-2 rounded list-unstyled">
                                                                        @foreach ($errors->get('username') as $error)
                                                                            <li class="h6">{{ $error }}</li>
                                                                        @endforeach
                                                                    </ul>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <div class="mc-footer">
                                                            <div class="row text-right">
                                                                <div class="container text-center">
                                                                    <button class="btn btn-primary m-1" type="submit">Mettre à jour</button>
                                                                    {{-- <button class="btn btn-outline-secondary m-1" type="reset">Reinitialiser</button> --}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="container-fluid">
                                        <div class="card mb-4">
                                            <form action="{{ isset($profile) && $profile == true ? route('profile.password') : route('admin.users.password', $user) }}" method="POST">
                                                @csrf
                                                <div class="card">
                                                    <div class="card-header bg-transparent">
                                                        <h3 class="card-title text-primary">Modification du mot de passe</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            @if (Auth::user()->id == $user->id)
                                                                <label class="action-bar-horizontal-label" for="oldPassword">Ancien mot de passe:</label>
                                                                <div class=" mb-4">
                                                                    <input class="form-control {{ $errors->has('old_password') ? 'is-invalid' : '' }}" id="oldPassword" name="old_password" type="password" placeholder="Saisissez votre ancien mot de passe" required>
                                                                    <small class="ul-form__text form-text" id="oldPasswordHelpBlock">Veuillez saisir votre ancien mot de passe</small>
                                                                    @if ($errors->has('old_password'))
                                                                        <ul class="alert-danger p-2 rounded list-unstyled">
                                                                            @foreach ($errors->get('old_password') as $error)
                                                                                <li class="h6">{{ $error }}</li>
                                                                            @endforeach
                                                                        </ul>
                                                                    @endif
                                                                </div>
                                                            @endif

                                                            <label class="action-bar-horizontal-label" for="password">Nouveau mot de passe:</label>
                                                            <div class=" mb-4">
                                                                <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="password" name="password" type="password" placeholder="Saisissez votre nouveau mot de passe" required>
                                                                <small class="ul-form__text form-text" id="passwordHelpBlock">Veuillez saisir votre nouveau mot de passe</small>
                                                            </div>

                                                            <label class="action-bar-horizontal-label" for="passwordConfirmation">Confirmation mot de passe:</label>
                                                            <div class="">
                                                                <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="passwordConfirmation" name="password_confirmation" type="password" placeholder="Confirmez votre nouveau mot de passe" required>
                                                                <small class="ul-form__text form-text" id="passwordConfirmationHelpBlock">Veuillez confirmer votre nouveau mot de passe</small>
                                                                @if ($errors->has('password'))
                                                                    <ul class="alert-danger p-2 rounded list-unstyled">
                                                                        @foreach ($errors->get('password') as $error)
                                                                            <li class="h6">{{ $error }}</li>
                                                                        @endforeach
                                                                    </ul>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <div class="mc-footer">
                                                            <div class="row text-right">
                                                                <div class="container text-center">
                                                                    <button class="btn btn-primary m-1" type="submit">Mettre à jour</button>
                                                                    {{-- <button class="btn btn-outline-secondary m-1" type="reset">Reinitialiser</button> --}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="role" role="tabpanel" aria-labelledby="role-tab">
                        <div id="transfer" class="transfer-demo"></div>
                    </div>
                    @if($user->isEmploye())
                        <div class="tab-pane fade" id="employe" role="tabpanel" aria-labelledby="employe-tab">
                            <div class="row">
                                <div class="container">
                                    <h4>Espace Employé</h4>
                                    <div class="p-5 text-center" style="height: 16rem; overflow-y: auto;">
                                        <h4 class="text-primary">Coming soon !</h4>
                                        <div class="spinner-bubble spinner-bubble-primary m-5"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- <div class="tab-pane fade" id="timeline" role="tabpanel" aria-labelledby="timeline-tab">
                        <ul class="timeline clearfix">
                            <li class="timeline-line"></li>
                            <li class="timeline-item">
                                <div class="timeline-badge"><i class="badge-icon bg-primary text-white i-Cloud-Picture"></i></div>
                                <div class="timeline-card card">
                                    <div class="card-body">
                                        <div class="mb-1"><strong class="mr-1">Timothy Carlson</strong> added a new photo
                                            <p class="text-muted">3 hours ago</p>
                                        </div><img class="rounded mb-2" src="../../dist-assets/images/photo-wide-1.jpg" alt="" />
                                        <div class="mb-3"><a class="mr-1" href="#">Like</a><a href="#">Comment</a></div>
                                        <div class="input-group">
                                            <input class="form-control" type="text" placeholder="Write comment" aria-label="comment" />
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" id="button-comment1" type="button">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-item">
                                <div class="timeline-badge"><img class="badge-img" src="{{ asset('images/faces/1.jpg') }}" alt="" /></div>
                                <div class="timeline-card card">
                                    <div class="card-body">
                                        <div class="mb-1"><strong class="mr-1">Timothy Carlson</strong> updated his sattus
                                            <p class="text-muted">16 hours ago</p>
                                        </div>
                                        <p>
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi dicta beatae illo illum iusto iste mollitia explicabo quam officia. Quas ullam, quisquam architecto aspernatur enim iure debitis dignissimos suscipit
                                            ipsa.
                                        </p>
                                        <div class="mb-3"><a class="mr-1" href="#">Like</a><a href="#">Comment</a></div>
                                        <div class="input-group">
                                            <input class="form-control" type="text" placeholder="Write comment" aria-label="comment" />
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" id="button-comment2" type="button">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <ul class="timeline clearfix">
                            <li class="timeline-line"></li>
                            <li class="timeline-group text-center">
                                <button class="btn btn-icon-text btn-primary"><i class="i-Calendar-4"></i> 2018</button>
                            </li>
                        </ul>
                        <ul class="timeline clearfix">
                            <li class="timeline-line"></li>
                            <li class="timeline-item">
                                <div class="timeline-badge"><i class="badge-icon bg-danger text-white i-Love-User"></i></div>
                                <div class="timeline-card card">
                                    <div class="card-body">
                                        <div class="mb-1"><strong class="mr-1">New followers</strong>
                                            <p class="text-muted">2 days ago</p>
                                        </div>
                                        <p><a href="#">Henry krick</a> and 16 others followed you</p>
                                        <div class="mb-3"><a class="mr-1" href="#">Like</a><a href="#">Comment</a></div>
                                        <div class="input-group">
                                            <input class="form-control" type="text" placeholder="Write comment" aria-label="comment" />
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" id="button-comment3" type="button">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-item">
                                <div class="timeline-badge"><i class="badge-icon bg-primary text-white i-Cloud-Picture"></i></div>
                                <div class="timeline-card card">
                                    <div class="card-body">
                                        <div class="mb-1"><strong class="mr-1">Timothy Carlson</strong> added a new photo
                                            <p class="text-muted">2 days ago</p>
                                        </div><img class="rounded mb-2" src="../../dist-assets/images/photo-wide-2.jpg" alt="" />
                                        <div class="mb-3"><a class="mr-1" href="#">Like</a><a href="#">Comment</a></div>
                                        <div class="input-group">
                                            <input class="form-control" type="text" placeholder="Write comment" aria-label="comment" />
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" id="button-comment4" type="button">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <ul class="timeline clearfix">
                            <li class="timeline-line"></li>
                            <li class="timeline-group text-center">
                                <button class="btn btn-icon-text btn-warning"><i class="i-Calendar-4"></i> Joined
                                    in 2013
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="about" role="tabpanel" aria-labelledby="about-tab">
                        <h4>Personal Information</h4>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet, commodi quam! Provident quis voluptate asperiores ullam, quidem odio pariatur. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatem, nulla eos?
                            Cum non ex voluptate corporis id asperiores doloribus dignissimos blanditiis iusto qui repellendus deleniti aliquam, vel quae eligendi explicabo.
                        </p>
                        <hr />
                        <div class="row">
                            <div class="col-md-4 col-6">
                                <div class="mb-4">
                                    <p class="text-primary mb-1"><i class="i-Calendar text-16 mr-1"></i> Birth Date</p><span>1 Jan, 1994</span>
                                </div>
                                <div class="mb-4">
                                    <p class="text-primary mb-1"><i class="i-Edit-Map text-16 mr-1"></i> Birth Place</p><span>Dhaka, DB</span>
                                </div>
                                <div class="mb-4">
                                    <p class="text-primary mb-1"><i class="i-Globe text-16 mr-1"></i> Lives In</p><span>Dhaka, DB</span>
                                </div>
                            </div>
                            <div class="col-md-4 col-6">
                                <div class="mb-4">
                                    <p class="text-primary mb-1"><i class="i-MaleFemale text-16 mr-1"></i> Gender</p><span>1 Jan, 1994</span>
                                </div>
                                <div class="mb-4">
                                    <p class="text-primary mb-1"><i class="i-MaleFemale text-16 mr-1"></i> Email</p><span>example@ui-lib.com</span>
                                </div>
                                <div class="mb-4">
                                    <p class="text-primary mb-1"><i class="i-Cloud-Weather text-16 mr-1"></i> Website</p><span>www.ui-lib.com</span>
                                </div>
                            </div>
                            <div class="col-md-4 col-6">
                                <div class="mb-4">
                                    <p class="text-primary mb-1"><i class="i-Face-Style-4 text-16 mr-1"></i> Profession</p><span>Digital Marketer</span>
                                </div>
                                <div class="mb-4">
                                    <p class="text-primary mb-1"><i class="i-Professor text-16 mr-1"></i> Experience</p><span>8 Years</span>
                                </div>
                                <div class="mb-4">
                                    <p class="text-primary mb-1"><i class="i-Home1 text-16 mr-1"></i> School</p><span>School of Digital Marketing</span>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <h4>Other Info</h4>
                        <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum dolore labore reiciendis ab quo ducimus reprehenderit natus debitis, provident ad iure sed aut animi dolor incidunt voluptatem. Blanditiis, nobis aut.</p>
                        <div class="row">
                            <div class="col-md-2 col-sm-4 col-6 text-center"><i class="i-Plane text-32 text-primary"></i>
                                <p class="text-16 mt-1">Travelling</p>
                            </div>
                            <div class="col-md-2 col-sm-4 col-6 text-center"><i class="i-Camera text-32 text-primary"></i>
                                <p class="text-16 mt-1">Photography</p>
                            </div>
                            <div class="col-md-2 col-sm-4 col-6 text-center"><i class="i-Car-3 text-32 text-primary"></i>
                                <p class="text-16 mt-1">Driving</p>
                            </div>
                            <div class="col-md-2 col-sm-4 col-6 text-center"><i class="i-Gamepad-2 text-32 text-primary"></i>
                                <p class="text-16 mt-1">Gaming</p>
                            </div>
                            <div class="col-md-2 col-sm-4 col-6 text-center"><i class="i-Music-Note-2 text-32 text-primary"></i>
                                <p class="text-16 mt-1">Music</p>
                            </div>
                            <div class="col-md-2 col-sm-4 col-6 text-center"><i class="i-Shopping-Bag text-32 text-primary"></i>
                                <p class="text-16 mt-1">Shopping</p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="friends" role="tabpanel" aria-labelledby="friends-tab">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card card-profile-1 mb-4">
                                    <div class="card-body text-center">
                                        <div class="avatar box-shadow-2 mb-3"><img src="{{ asset('images/faces/16.jpg') }}" alt="" /></div>
                                        <h5 class="m-0">Jassica Hike</h5>
                                        <p class="mt-0">UI/UX Designer</p>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae cumque.</p>
                                        <button class="btn btn-primary btn-rounded">Contact Jassica</button>
                                        <div class="card-socials-simple mt-4"><a href=""><i class="i-Linkedin-2"></i></a><a href=""><i class="i-Facebook-2"></i></a><a href=""><i class="i-Twitter"></i></a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card card-profile-1 mb-4">
                                    <div class="card-body text-center">
                                        <div class="avatar box-shadow-2 mb-3"><img src="{{ asset('images/faces/2.jpg') }}" alt="" /></div>
                                        <h5 class="m-0">Frank Powell</h5>
                                        <p class="mt-0">UI/UX Designer</p>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae cumque.</p>
                                        <button class="btn btn-primary btn-rounded">Contact Frank</button>
                                        <div class="card-socials-simple mt-4"><a href=""><i class="i-Linkedin-2"></i></a><a href=""><i class="i-Facebook-2"></i></a><a href=""><i class="i-Twitter"></i></a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card card-profile-1 mb-4">
                                    <div class="card-body text-center">
                                        <div class="avatar box-shadow-2 mb-3"><img src="{{ asset('images/faces/3.jpg') }}" alt="" /></div>
                                        <h5 class="m-0">Arthur Mendoza</h5>
                                        <p class="mt-0">UI/UX Designer</p>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae cumque.</p>
                                        <button class="btn btn-primary btn-rounded">Contact Arthur</button>
                                        <div class="card-socials-simple mt-4"><a href=""><i class="i-Linkedin-2"></i></a><a href=""><i class="i-Facebook-2"></i></a><a href=""><i class="i-Twitter"></i></a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card card-profile-1 mb-4">
                                    <div class="card-body text-center">
                                        <div class="avatar box-shadow-2 mb-3"><img src="{{ asset('images/faces/4.jpg') }}" alt="" /></div>
                                        <h5 class="m-0">Jacqueline Day</h5>
                                        <p class="mt-0">UI/UX Designer</p>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae cumque.</p>
                                        <button class="btn btn-primary btn-rounded">Contact Jacqueline</button>
                                        <div class="card-socials-simple mt-4"><a href=""><i class="i-Linkedin-2"></i></a><a href=""><i class="i-Facebook-2"></i></a><a href=""><i class="i-Twitter"></i></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="photos" role="tabpanel" aria-labelledby="photos-tab">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card text-white o-hidden mb-3"><img class="card-img" src="{{ asset('images/products/headphone-1.jpg') }}" alt="" />
                                    <div class="card-img-overlay">
                                        <div class="p-1 text-left card-footer font-weight-light d-flex"><span class="mr-3 d-flex align-items-center"><i class="i-Speach-Bubble-6 mr-1"></i>12</span><span class="d-flex align-items-center"><i class="i-Calendar-4 mr-2"></i>03.12.2018</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-white o-hidden mb-3"><img class="card-img" src="{{ asset('images/products/headphone-2.jpg') }}" alt="" />
                                    <div class="card-img-overlay">
                                        <div class="p-1 text-left card-footer font-weight-light d-flex"><span class="mr-3 d-flex align-items-center"><i class="i-Speach-Bubble-6 mr-1"></i>12</span><span class="d-flex align-items-center"><i class="i-Calendar-4 mr-2"></i>03.12.2018</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-white o-hidden mb-3"><img class="card-img" src="{{ asset('images/products/headphone-3.jpg') }}" alt="" />
                                    <div class="card-img-overlay">
                                        <div class="p-1 text-left card-footer font-weight-light d-flex"><span class="mr-3 d-flex align-items-center"><i class="i-Speach-Bubble-6 mr-1"></i>12</span><span class="d-flex align-items-center"><i class="i-Calendar-4 mr-2"></i>03.12.2018</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-white o-hidden mb-3"><img class="card-img" src="{{ asset('images/products/iphone-1.jpg') }}" alt="" />
                                    <div class="card-img-overlay">
                                        <div class="p-1 text-left card-footer font-weight-light d-flex"><span class="mr-3 d-flex align-items-center"><i class="i-Speach-Bubble-6 mr-1"></i>12</span><span class="d-flex align-items-center"><i class="i-Calendar-4 mr-2"></i>03.12.2018</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-white o-hidden mb-3"><img class="card-img" src="{{ asset('images/products/iphone-2.jpg') }}" alt="" />
                                    <div class="card-img-overlay">
                                        <div class="p-1 text-left card-footer font-weight-light d-flex"><span class="mr-3 d-flex align-items-center"><i class="i-Speach-Bubble-6 mr-1"></i>12</span><span class="d-flex align-items-center"><i class="i-Calendar-4 mr-2"></i>03.12.2018</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-white o-hidden mb-3"><img class="card-img" src="{{ asset('images/products/watch-1.jpg') }}" alt="" />
                                    <div class="card-img-overlay">
                                        <div class="p-1 text-left card-footer font-weight-light d-flex"><span class="mr-3 d-flex align-items-center"><i class="i-Speach-Bubble-6 mr-1"></i> 12</span><span class="d-flex align-items-center"><i class="i-Calendar-4 mr-2"></i>03.12.2018</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascripts')
<script type="text/javascript" src="{{ asset('myplugins/Dual-Listbox-Transfer/js/jquery.transfer.js?v=0.0.6') }}"></script>
<script src="{{ asset('myplugins/dropify/js/dropify.js') }}"></script>
<script>
    // Basic
    $('.dropify').dropify();

    // Translated
    $('.dropify-fr').dropify({
        messages: {
            default: '', // 'Glissez-déposez un fichier ici ou cliquez',
            replace: '', // 'Glissez-déposez un fichier ou cliquez pour remplacer',
            remove:  'Supprimer <i class="i-Remove"></i>',
            error:   'Désolé, le fichier trop volumineux'
        }
    });
</script>

<script>
    var groupDataArray1 = [
        {
            "groupName": "China",
            "groupData": [
                {
                    "city": "Beijing",
                    "value": 122
                },
                {
                    "city": "Shanghai",
                    "value": 643
                },
                {
                    "city": "Qingdao",
                    "value": 422
                },
                {
                    "city": "Tianjin",
                    "value": 622
                }
            ]
        },
        {
            "groupName": "Japan",
            "groupData": [
                {
                    "city": "Tokyo",
                    "value": 132
                },
                {
                    "city": "Osaka",
                    "value": 112
                },
                {
                    "city": "Yokohama",
                    "value": 191
                }
            ]
        }
    ];

    var settings3 = {
        "groupDataArray": groupDataArray1,
        "groupItemName": "groupName",
        "groupArrayName": "groupData",
        "itemName": "city",
        "valueName": "value",
        "callable": function (items) {
            console.dir(items)
        }
    };

    $("#transfer").transfer(settings3);
</script>
@endsection
