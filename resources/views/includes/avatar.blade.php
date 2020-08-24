@if(Auth::user()->image)
    <div class="container-avatar">
        <img src="{{ route("user.avatar", ["filename" => Auth::user()->image]) }}" alt="User Avatar" class="avatar">
    </div>
@endif
