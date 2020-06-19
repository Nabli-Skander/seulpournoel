<nav class="nav flex-column side-nav">
    <a class="nav-link icon{{ Request::is('*profile') ? ' active' : '' }}"
       href="{{ route('profile.edit') }}">
        <i class="fa fa-user"></i> @lang('Mon profil')
    </a>
    <a class="nav-link icon{{ Request::is('*dashboard/events*') ? ' active' : '' }}"
       href="{{ route('dashboard.events.index') }}">
        <i class="fa fa-heart"></i> @lang('Mes événements')
    </a>
    <a class="nav-link icon{{ Request::is('*invitations*') ? ' active' : '' }}"
       href="{{ route('invitations.index') }}">
        <i class="fa fa-user-plus"></i> @lang('Mes invitations')
    </a>
    <a class="nav-link icon{{ Request::is('*password') ? ' active' : '' }}"
       href="{{ route('password.edit') }}">
        <i class="fa fa-recycle"></i> @lang('Changer de mot de passe')
    </a>
    @if (Auth::user() && Auth::user()->isAdmin())
        <a class="nav-link icon{{ Request::is('*admin') ? ' active' : '' }}"
           href="{{ route('admin.index') }}">
            <i class="fa fa-flag"></i> @lang('Administration')
        </a>
    @endif
</nav>