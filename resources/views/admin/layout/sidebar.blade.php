
<li class="nav-item-header pt-0">
    <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Main</div>
    <i class="ph-dots-three sidebar-resize-show"></i>
</li>
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : ''}}" href="{{ route('dashboard') }}">
        <i class="ph-house"></i>
        <span>Dashboard</span>
    </a>
</li>
@canany(['roles-list', 'users-list'])
<li class="nav-item-header">
    <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Access Management</div>
    <i class="ph-dots-three sidebar-resize-show"></i>
</li>
@endcanany
@can('roles-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('roles*') ? 'active' : ''}}" href="{{ route('roles.index') }}">
        <i class="ph-shield"></i>
        <span>Roles</span>
    </a>
</li>
@endcan
@can('users-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('users*') ? 'active' : ''}}" href="{{ route('users.index') }}">
        <i class="ph-users"></i>
        <span>Users</span>
    </a>
</li>
@endcan
@canany(['packagings-list', 'consignees-list', 'chemicals-list','invoices-list'])
<li class="nav-item-header">
    <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Main Features</div>
    <i class="ph-dots-three sidebar-resize-show"></i>
</li>
@endcanany
@can('packagings-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('packagings*') ? 'active' : ''}}" href="{{ route('packagings.index') }}">
        <i class="ph-tote"></i>
        <span>Packagings</span>
    </a>
</li>
@endcan
@can('consignees-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('consignees*') ? 'active' : ''}}" href="{{ route('consignees.index') }}">
        <i class="ph-address-book"></i>
        <span>Consignees</span>
    </a>
</li>
@endcan
@can('chemicals-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('chemicals*') ? 'active' : ''}}" href="{{ route('chemicals.index') }}">
        <i class="ph-atom"></i>
        <span>Chemicals</span>
    </a>
</li>
@endcan
@can('invoices-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('invoices*') ? 'active' : ''}}" href="{{ route('invoices.index') }}">
        <i class="ph-notepad"></i>
        <span>Invoices</span>
    </a>
</li>
@endcan
@canany(['notifications-list','audits-list', 'logs-list'])
<li class="nav-item-header">
    <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Configuration</div>
    <i class="ph-dots-three sidebar-resize-show"></i>
</li>
@endcanany
@can('audits-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('notifications*') ? 'active' : ''}}" href="{{ route('notifications.index') }}">
        <i class="ph-bell"></i>
        <span>Notifications</span>
    </a>
</li>
@endcan
@can('audits-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('audits*') ? 'active' : ''}}" href="{{ route('audits.index') }}">
        <i class="ph-diamonds-four"></i>
        <span>Audit</span>
    </a>
</li>
@endcan
@can('logs-list')
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('logs*') ? 'active' : ''}}" href="{{ route('logs') }}" target="_blank">
        <i class="ph-bug"></i>
        <span>Errors</span>
    </a>
</li>
@endcan
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('settings*') ? 'active' : ''}}" href="{{ route('settings.index') }}">
        <i class="ph-gear"></i>
        <span>Settings</span>
    </a>
</li>
