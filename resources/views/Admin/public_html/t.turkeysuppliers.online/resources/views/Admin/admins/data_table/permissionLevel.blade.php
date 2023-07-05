    {{-- @forelse ($admin->getRoleNames() as $permission)
        <label class="badge badge-success">{{ $permission }}</label>
        @empty
        <label class="badge badge-warning">{{ trans('Admin/roles.this_user_not_have_any_permission') }}</label>
    @endforelse --}}

    {{-- <label class="badge badge-success">{{ $admin->roles->name ?? null }}</label> --}}
@forelse ($admin->permissions as $permission)
        <label class="badge badge-success">{{ $permission->display_name }}</label>
@empty
        <label class="badge badge-warning">{{ trans('roles.this_user_not_have_any_permission') }}</label>
@endforelse
