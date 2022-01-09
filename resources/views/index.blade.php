@extends('layout')

@section('content')
    <div class="bl_flexContainer">
            @foreach ($shops->unique('address') as $shop)
                <div class="el_flexItem" style="padding: 10px; margin: 10px; border: 1px solid #333333;">
                 <a href="{{ route('shop.detail', ['lists_id' =>  $shop->lists_id]) }}">
                    <h6>{{ \DB::table('shops')->where('address', '=', $shop->address)->count() }} users</h6>
                        </a>
                    
                        <a href="{{ $shop->address }}">
                            {{ $shop->name }}
                        </a>
            
                        <p style="font-size: 12px;">{{ $shop->created_at}}</p>
            </div>
            @endforeach
    </div>

<style>
    .bl_flexContainer {
        display: flex;
        flex-wrap: wrap;
        padding-top: 10px;
        justify-content: space-between;
    }

    .el_flexItem {
        width: calc(33% - 28px);
        height: 110px;
        margin-right: 7px;
        margin-bottom: 30px;
    }
</style>
@endsection
