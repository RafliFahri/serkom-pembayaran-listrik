@extends('.admin.app')
@section('content')
<div class="flex flex-col">
    <span class="text-9xl font-bold">
        Halo,
        @if(\Illuminate\Support\Facades\Auth::guard('admin')->hasUser())
            {{\Illuminate\Support\Facades\Auth::guard('admin')->user()->nama_admin}}
        @else
            Admin
        @endif
</div>
@endsection
