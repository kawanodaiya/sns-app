<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function show()
    {
        $notices = Notice::all()->sortByDesc('created_at');

        return view('notices.show',compact('notices'));
    }

    public function destroy(Request $request)
    {
        $notice = Notice::find($request->id);
        $notice->delete();

        return redirect()->route('notices.show');
    }
}
