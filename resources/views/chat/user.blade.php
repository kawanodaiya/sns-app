<div class="row mb-2">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="fas fa-user-circle fa-3x"></i>
                    <h2 class="h5 ml-2 mb-0 text-dark">
                        {{ $person->name }}
                    </h2>
                </div>
                <form method="POST" action="{{ route('chat.show') }}">
                    @csrf
                    <input name="user_id" type="hidden" value="{{$person->id}}">
                    <button type="submit" class="btn-sm shadow-none border border-success bg-success text-white p-1">
                        <i class="p-1 fa-lg far fa-comment"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>