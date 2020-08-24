@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Gente</h1>
                <hr>
                @foreach($users as $user)
                    <div class="profile-user">
                        @if($user->image)
                            <div class="col-md-4">
                                <div class="container-avatar">
                                    <img src="{{route("user.avatar", ["filename" => $user->image])}}">
                                </div>
                            </div>
                        @endif
                        <div class="col-md-8">
                            <div class="user-info">
                                <h2 class="nickname">{{ "@".$user->nick }}</h2>
                                <h3>{{ $user->name." ".$user->surname }}</h3>
                                <p class="date">Se unió {{ \FormatTime::LongTimeFilter($user->created_at) }}</p>
                                <a href="{{ route("user.profile", ["id" => $user->id]) }}" class="btn btn-success">Ver perfil</a>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                    </div>
                @endforeach

                <div class="clearfix"></div>
                <div class="offset-md-5">{{ $users->links() }}</div>
            </div>
        </div>
    </div>
@endsection
