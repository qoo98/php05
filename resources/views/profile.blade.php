@extends('layout')

@section('content')
    <div class="content-section">
      <div class="media">
        <div class="col-2">
          <img src="{{ asset('storage/images/'.$user->avatar) }}" alt="profile_image" class="d-block rounded-circle mb-3">
            <p class="account-heading">name: {{ $username }}</p>
            <div class="buttons">
                <button type="button" class="btn btn-primary mb-12" data-toggle="modal" data-target="#testModal">編集</button>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">退会</button>
          </div>
        </div>
      </div>
    


      <div class="modal fade" id="testModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">プロフィール編集</h4>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                     <!-- FORM HERE -->
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


                        <div class="form-group">
                            <button class="btn btn-outline-info" type="submit">Update</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>


 
        
            
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">退会しますか？</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p class="comment">退会するには現在のパスワードを入力して「退会する」ボタンをクリックしてください。この処理は元に戻すことはできません。</p>
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
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
          <div class="form-group">
            <button class="btn btn-danger" type="submit">退会する</button>
        </div>
        </form>    
        </div>
      </div>
    </div>
  </div>



    <?php 
    $pass = filter_input(INPUT_POST, "current_password");
    
    use Illuminate\Support\Facades\Hash; 
        if (Hash::check($pass, $user->password)) {
            header('Location: ./delete');
            exit();
        } 
    ?>

   <div class="listitem">
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
</div>
<style>
      .comment {
        background-color: orchid;
          }

          .buttons {
            display: flex;
          }

          .content-section {
            display: flex;
            justify-content: space-between;
          }

          .media {
            flex-grow: 1;
          }

          .listitem {
            flex-grow: 7;
          }
          
          img {
            width: 100px;
            height: 100px;
          }
</style>


@endsection
