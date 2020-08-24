@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @include("includes.message")
                    <div class="card pub_image pub_image_detail">
                        <div class="card-header">
                            @if ($image->user->image)
                                <div class="container-avatar">
                                    <img src="{{ route("user.avatar", ["filename" => $image->user->image]) }}" alt="User Avatar">
                                </div>
                            @endif
                            <div class="data-user">
                                {{ $image->user->name." ".$image->user->surname." | " }}
                                <span class="nickname">{{ "@".$image->user->nick }}</span>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="image-container image-detail">
                                <img src="{{ route("image.get", ["filename" => $image->image_path]) }}" alt="">
                            </div>
                            <hr>
                            <div class="description">
                                <span class="nickname">{{ "@".$image->user->nick }}</span>
                                <span class="date"> {{ " | ".\FormatTime::LongTimeFilter($image->created_at) }}</span>
                                <br>
                                <p>{{ $image->description }}</p>
                            </div>

                            <div class="likes">
                                <?php $userLiked = false; ?>

                                @foreach($image->likes as $like)
                                    @if($like->user_id == Auth::user()->id)
                                        <?php $userLiked = true; ?>
                                    @endif
                                @endforeach

                                @if($userLiked)
                                    <img src="{{ asset("img/heart-red.png") }}" alt="Dislike Button" class="btn-dislike" data-id="{{ $image->id }}">
                                @else
                                    <img src="{{ asset("img/heart-black.png") }}" alt="Like Button" class="btn-like" data-id="{{ $image->id }}">
                                @endif

                                    <span class="number_likes">{{ count($image->likes) }}</span>
                            </div>

                            @if(Auth::user() && Auth::user()->id == $image->user_id)
                                <div class="actions">
                                    <a href="{{ route("image.edit", ["id" => $image->id]) }}" class="btn btn-sm btn-primary">Actualizar</a>
                                    <a href="{{ route("image.delete", ["id" => $image->id]) }}" class="btn btn-sm btn-danger">Borrar</a>
                                </div>
                            @endif

                            <div class="clearfix"></div>

                            <div class="comments">
                                <h2>Comentarios ({{ count($image->comments) }})</h2>
                                <hr>
                                <form method="POST" action="{{ route("comment.save") }}">
                                    @csrf
                                    <input type="hidden" name="image_id" value="{{ $image->id }}">
                                    <p>
                                        <textarea class="form-control-lg comment-textarea" name="content" required></textarea>
                                        @if($errors->has("content"))
                                            <span class="alert alert-danger" role="alert">
                                                <strong>{{ $errors->first("content") }}</strong>
                                            </span>
                                        @endif
                                    </p>
                                    <button type="submit" class="btn btn-primary">
                                        Enviar
                                    </button>
                                </form>
                                <br>
                                <br>
                                @foreach($image->comments as $comment)
                                    <div class="comment">
                                        <p>
                                            <span class="nickname">{{ "@".$comment->user->nick.": " }}</span>
                                            {{ $comment->content }}
                                        </p>
                                        <span class="date">{{ \FormatTime::LongTimeFilter($comment->created_at) }}</span>
                                        @if(Auth::check() && ($comment->user->id == Auth::user()->id || $comment->image->user_id == Auth::user()->id))
                                            <a href="{{ route("comment.delete", ["id" => $comment->id]) }}" class="btn btn-sm btn-danger">
                                                Eliminar
                                            </a>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
