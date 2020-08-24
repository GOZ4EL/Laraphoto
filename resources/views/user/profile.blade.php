@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include("includes.message")

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
                            <h1 class="nickname">{{ "@".$user->nick }}</h1>
                            <h2>{{ $user->name." ".$user->surname }}</h2>
                            <p class="date">Se unió {{ \FormatTime::LongTimeFilter($user->created_at) }}</p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                </div>

                @foreach($user->images as $image)
                    @include("includes.image", ["image" => $image])
                @endforeach

            </div>
        </div>
    </div>
@endsection
