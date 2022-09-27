<div class="deznav">
    <div class="deznav-scroll">
		<ul class="metismenu" id="menu">
            <li><a href="{{route('admin.home')}}">
					<span class="nav-text">Dashboard</span>
				</a>
            </li>
        </ul>

        <ul class="metismenu" id="menu">
            <li><a href="{{route('admin.indigencies')}}">
					<span class="nav-text">Indigents</span>
				</a>
            </li>
        </ul>
        <ul class="metismenu" id="menu">
            <li><a href="{{route('admin.tasks')}}">
                    <span class="nav-text">Tasks</span>
                </a>
            </li>
        </ul>
        <ul class="metismenu" id="menu">
            <li><a href="{{route('admin.verification.bidderVetting')}}">
                    <span class="nav-text">Bidder Vetting</span>
                </a>
            </li>
        </ul>
@can('superuser', Auth::user())
        <ul class="metismenu" id="menu">
            <li><a class="has-arrow ai-icon" href="javascript:void(0)" aria-expanded="false">
                    <span class="nav-text">Users</span>
                </a>
                <ul aria-expanded="false">
                    <ul><a href="{{route('admin.users')}}">User List</a></ul>
                    <ul><a href="{{route('admin.users.create')}}">New User</a></ul>
                </ul>
            </li>
        </ul>
@endcan
	</div>
</div>