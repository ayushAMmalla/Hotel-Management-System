@if(auth()->user()->isCustomer())
@include('welcome')
@endif

@if(auth()->user()->isAdmin())
@include('admin.dashboard')
@endif
