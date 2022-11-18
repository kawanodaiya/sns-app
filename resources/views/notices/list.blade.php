@if($notice->serve_user_id === Auth::user()->id)
<div class="card mt-3 d-flex flex-row justify-content-between">
    <div class="notice">
        <div class="card-body">
            <div class="font-weight-lighter">
                {{ $notice->created_at->format('Y/m/d H:i') }}
            </div>
        </div>
        <div class="card-body pt-0">
            <p class="font-weight-lighter fs-4">
                {{ $notice->message }}
            </p>
        </div>
    </div>
    @method('DELETE')
    <div class="delete-notice">
        <form action="{{ route('notices.destroy', ['id'=>$notice->id]) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-link"><i class="fas fa-times text-success"></i></button>
        </form>
    </div>
</div>
@endif