<?php

namespace App\Http\Controllers\Member\Activity;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityMemberController extends Controller
{
    public function activity()
    {
        $activities = Activity::paginate(8); // 8 items per page, sesuaikan jika perlu
        return view('member.Activity.activity', compact('activities'));
    }

    public function show(Activity $activity)
    {
        return view('member.Activity.detail-act', compact('activity'));
    }


}
