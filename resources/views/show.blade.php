@extends('layout')

@section('content')
    <a href="{{ $shop->address }}" style="font-size: 60px;">
        {{ $shop->name }}
    </a>
    <h2>{{ \DB::table('shops')->where('address', '=', $shop->address)->count() }} users</h2>
    <h3>コメント</h3>

    @foreach ($shops as $list)
        @if ($list->lists_id == $shop->lists_id)
        <div class="userlist">
            @if (isset($list->user->avatar))
                <img src="{{ asset('storage/profiles/'.$list->user->avatar) }}" alt="profile_image" class="d-block rounded-circle mb-3">
            @else
                <div class="space"></div>
            @endif
            <div class="profile">
            @if (isset($list->user->email))
                <h5>{{ $list->username}}</h5>
            @endif
            <p>{{ $list->message }}</p>
            @if (isset($list->user->email))
                <button id="bo" class="Item">☆</button>
            @endif
            </div>
        </div>
        @endif
    @endforeach
    
<script>
    document.getElementById('bo').addEventListener('click', function(){
        document.getElementById('bo').classList.toggle('active');
    });
</script>

<style>
    .space {
        display: block;
        width: 100px;
        height: 100px;
    }
    .Item {
        cursor: pointer;
        border: 1px solid #ccc;
        background-color: white;
        color: #000000;
    }

    .Item.active {
        background-color: skyblue;
        color: white;
    }

    #bo:hover {
        background: skyblue;
    }
    .userlist {
        display: flex;
        margin-bottom: 15px;
    }
    
    h2 {
        padding-bottom: 30px;
    }

    img {
        width: 100px;
        height: 100px;
    }
</style>
@endsection



