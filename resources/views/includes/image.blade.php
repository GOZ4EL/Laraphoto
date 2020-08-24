<div class="card pub_image">
    <div class="card-header">
        @if ($image->user->image)
            <div class="container-avatar">
                <img src="{{ route("user.avatar", ["filename" => $image->user->image]) }}" alt="User Avatar">
            </div>
        @endif
        <div class="data-user">
            <a href="{{ route("user.profile", ["id" => $image->user_idi]) }}">
                {{ $image->user->name." ".$image->user->surname." | " }}
                <span class="nickname">{{ "@".$image->user->nick }}</span>
            </a>
        </div>
    </div>

    <div class="card-body">
            <div class="image-container">
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

            {{ count($image->likes) }}
        </div>
        <div class="comments">
            <a href="{{ route("image.detail", ["id" => $image->id]) }}" class="btn btn-sm btn-warning btn-comments">
                Comentarios ({{ count($image->comments) }})
            </a>
        </div>
    </div>
</div>
