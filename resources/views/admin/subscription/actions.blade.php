@canany(['subscriptions-view', 'subscriptions-edit', 'subscriptions-delete'])
<div class="d-inline-flex">
    <div class="dropdown">
        <a href="#" class="text-body" data-bs-toggle="dropdown">
            <i class="ph-list"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            <form action="{{ route('subscriptions.destroy',$subscription->id) }}" method="POST">
                @csrf
                @method('DELETE')
                @can('subscriptions-view')
                    <a href="{{ route('subscriptions.show',$subscription->id) }}" class="dropdown-item">
                        <i class="ph-eye me-2"></i>{{ __('Show') }}
                    </a>
                @endcan
                @can('subscriptions-edit')
                    <a href="{{ route('subscriptions.edit',$subscription->id) }}" class="dropdown-item">
                        <i class="ph-note-pencil me-2"></i>{{ __('Edit') }}
                    </a>
                @endcan
                @can('subscriptions-delete')
                    <button type="submit" class="dropdown-item sa-confirm">
                        <i class="ph-trash me-2"></i>{{ __('Delete') }}
                    </button>
                @endcan
            </form>
        </div>
    </div>
</div>
@endcanany