@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include("includes.message")

            @foreach($images as $image)
                @include("includes.image", ["image" => $image])
            @endforeach

            <div class="clearfix"></div>
            <div class="offset-md-5">{{ $images->links() }}</div>
        </div>
    </div>
</div>
@endsection
