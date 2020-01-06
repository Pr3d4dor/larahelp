<div class="flash-message pl-2 pr-2 mt-2 mb-2">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if (Session::has('alert-' . $msg))
            <div class="alert alert-{{ $msg }} alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <span>{{ Session::get('alert-' . $msg) }}</span>
            </div>
        @endif
    @endforeach
</div>
