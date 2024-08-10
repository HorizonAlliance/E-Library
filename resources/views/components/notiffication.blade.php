    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="alert alert-warning" role="alert">
            {{ session('error') }}
        </div>
    @endif
{{-- 
    @props(['type' => null, 'message' => null])

    @php
        $type = $type ?? session('notif_type');
        $message = $message ?? session('notif_message');
    @endphp

    @if ($type && $message)
        <div class="alert alert-{{ $type }}" role="alert">
            {{$message }}
        </div>
    @endif --}}
