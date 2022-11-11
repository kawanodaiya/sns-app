<form method="POST" action="{{ route('users.statuses.sort',['name' => $user->name]) }}">
    @csrf
    <div class="d-flex flex-row justify-content-center mt-1">
        <div class="col-10">
            <div class="search-form">
                <input type="text" name="search_text" class="form-control" 
                @if(Request::is('*/sort'))
                    value="{{ old('search_text',$search_text)}}"
                @endif
                >
            </div>
            <div class="form-group flex-fill">
                <select name="status_name" class="form-control">
                <option hidden></option>
                <option class="ml-1"
                    @if(Request::is('*/sort'))
                    @if($status_name == 'フォロー') selected @endif
                    @endif>フォロー</option>
                @auth
                @if ($user->status()->exists())
                    @foreach ($user->status as $status)
                    @if(Str::before($status->name, ':') != null)
                    <option class="ml-1"
                    @if(Request::is('*/sort'))
                    @if($status->name == $status_name) selected @endif
                    @endif>{{$status->name}}</option>
                    @endif
                    @endforeach
                @endif
                @endauth
                </select>
            </div>
        </div>
        <div class="">
            <button type="submit" class="btn btn-block rounded-circle bg-success text-white ">
            <i class="fab fa-sistrix"></i>
            </button>
        </div>
    </div>
</form>