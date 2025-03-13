@if(auth()->user()->isAdmin())
	@include('layouts.menu.admin')
@elseif(auth()->user()->isUser())
	@include('layouts.menu.user')
@endif
