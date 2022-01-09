@extends('layout')

@section('content')

<div class="container">
    <div class="imgedit">
        <img src="{{ asset('storage/profiles/'.$user->avatar) }}" alt="profile_image" class="d-block rounded-circle mb-3">
        <p class="username">name: {{ $username }}</p>

        <div class="buttons">
            <p class="open-btn1">編集</p>
            <p class="open-btn2">退会</p>
        </div>
    </div>

    
    <div id="search-wrap">
        <div class="close_modal">
            <a href="">×</a>
        </div>           
        <h2>プロファイル編集</h2>    
        <form method="POST" action="{{ route('name.update', $user->id) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            
            
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">New name</label>
    
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" value="{{ $username }}" required>
                    
                    @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            
            <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                <label for="avatar" class="col-md-4 control-label">New avatar</label>
                
                <div class="col-md-6">
                    <input id="avatar" type="file" class="form-control" name="avatar" accept="image/png, image/jpeg" required>
                    
                    @if ($errors->has('avatar'))
                    <span class="help-block">
                        <strong>{{ $errors->first('avatar') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            
            
            <div class="buttons">
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <input type="submit" class="btn btn-primary" value="更新">
                        
                        
                    </div>
                </div>
                
                <a href="{{ route('profile') }}">キャンセル</a>
            </div>
        </form>
        
    </div>
    
    <div id="search-wrap2">
        <h3>退会しますか？</h3>
        <p>退会するには現在のパスワードを入力して「退会する」ボタンをクリックしてください。この処理は元に戻すことはできません。</p>
                    <form method="POST">
              {{ csrf_field() }}
    
            <input type="hidden" name="id" value="{{ $user->id }}" required>
    
                <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
                        <label for="current_password" class="col-md-4 control-label">Current Password</label>
    
                    <div class="col-md-6">
                        <input id="current_password" type="password" class="form-control" name="current_password" required>
    
                        @if ($errors->has('current_password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('current_password') }}</strong>
                            </span>
                        @endif
                    </div>
    
                <div class="buttons">
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <!-- <input type="submit" class="btn btn-primary" id="deletebtn" value="退会">   -->
                                <input type="submit" id="button" value="tai" class="btn btn-primary">
                            </div>
                        </div>
                        <a href="{{ route('profile') }}">キャンセル</a>
                    </div>       
                    <div id="display"></div>
            </form>
        </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="  crossorigin="anonymous"></script>
    <script src="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/7-2-3/js/7-2-3.js"></script>

    <?php 
    $pass = filter_input(INPUT_POST, "current_password");
    
    use Illuminate\Support\Facades\Hash; 
        if (Hash::check($pass, $user->password)) {
            header('Location: ./delete');
            exit();
        } 
    ?>
</div> 

   <div class="bl_flexContainer">
        @foreach ($shops as $list)
            @if ($list->user_id == $user->id)
                    <div class="el_flexItem" style="padding: 10px; border: 1px solid #333333;">
                    <a href="{{ $list->address }}">
                        <h6>{{ $list->name }}</h6>
                            </a>
                        
                            <p>{{ $list->message }}</p>

                            <p style="font-size: 12px;">{{ $list->created_at}}</p>
                </div>
                <?php $list->username = $username;
                    $list->save();
                 ?>
            @endif
        @endforeach
    </div>

<style>
    .container {
        display: flex;
        justify-content: space-between;
    }
    .bl_flexContainer {
        flex-grow: 7;
    }
    .imgedit {
        flex-grow: 1;
    }

    .el_flexItem {
        height: 110px;
    }

    img {
        width: 200px;
        height: 200px;
    }

    .buttons {
        display: flex;
        margin-top: 20px;
    }

    .update {
        margin-right: 10px;
    }



    body{
  background:#f3f3f3;
}


/*========= 検索窓を開くためのボタン設定 ===========*/

.open-btn1, .open-btn2{
  color: green;
  border: 1px solid green;
  cursor: pointer;
  margin-right: 20px;
  padding: 10px 20px;
}
.open-btn2 {
    color: red;
    border: 1px solid red;
}


/*クリック後、JSでボタンに btnactive クラスが付与された後の見た目*/
.open-btn1.btnactive{

}

/*========= 検索窓の設定 ===============*/

/*==検索窓背景のエリア*/

#search-wrap, #search-wrap2{
  position:absolute;/*絶対配置にして*/
  top:10%;
  left:20%;
  z-index: -1;/*最背面に設定*/
  opacity: 0;/*透過を0に*/
  width:70%;
  height: 40%;
  transition: all 0.1s;/*transitionを使ってスムースに現れる*/
  border-radius: 5px;
}

#search-wrap2 p {
    color: white;
    background: red;
    padding: 10px;
}

/*ボタンクリック後、JSで#search-wrapに panelactive クラスが付与された後の見た目*/
#search-wrap.panelactive, #search-wrap2.panelactive{
  opacity: 1;/*不透明に変更*/
  z-index: 3;/*全面に出現*/
  width:70%;
  padding:20px;
  top:20%;
  background:#fff;
}



/*==検索窓*/
#search-wrap #searchform {
  display: none;/*検索窓は、はじめ非表示*/
}
#search-wrap2 #searchform {
  display: none;/*検索窓は、はじめ非表示*/
}

/*ボタンクリック後、JSで#search-wrapに panelactive クラスが付与された後*/
#search-wrap.panelactive #searchform{
  display: block;/*検索窓を表示*/
}

#search-wrap2.panelactive #searchform{
  display: block;/*検索窓を表示*/
}



/*テキスト入力input設定*/
 #search-wrap input[type="text"] {
  width: 100%;
  border:2px solid #ccc;
  transition: all 0.5s;
  letter-spacing: 0.05em;
  height:46px;
  padding: 10px;
}
#search-wrap2 input[type="text"] {
  width: 100%;
  border:2px solid #ccc;
  transition: all 0.5s;
  letter-spacing: 0.05em;
  height:46px;
  padding: 10px;
}

/*テキスト入力inputにフォーカスされたら*/
 #search-wrap input[type="text"]:focus {
  background:#eee;/*背景色を付ける*/
}
#search-wrap2 input[type="text"]:focus {
  background:#eee;/*背景色を付ける*/
}


</style>

<script>
    //開閉ボタンを押した時には
$(".open-btn1").click(function () {
    $(this).toggleClass('btnactive');//.open-btnは、クリックごとにbtnactiveクラスを付与＆除去。1回目のクリック時は付与
    $("#search-wrap").toggleClass('panelactive');//#search-wrapへpanelactiveクラスを付与
  $('#search-text').focus();//テキスト入力のinputにフォーカス
});

$(".open-btn2").click(function () {
    $(this).toggleClass('btnactive');//.open-btnは、クリックごとにbtnactiveクラスを付与＆除去。1回目のクリック時は付与
    $("#search-wrap2").toggleClass('panelactive');//#search-wrapへpanelactiveクラスを付与
  $('#search-text').focus();//テキスト入力のinputにフォーカス
});


</script>

@endsection
