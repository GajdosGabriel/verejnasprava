<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Http\Requests;

class AdminController extends Controller
{
    public function indexUser() {
        $posts = Post::where('date_in', '>=', Carbon::now()->startOfMonth())->orderBy('date_in', 'DESC')->get();
//        $posts = Post::where('created_at', '>=', Carbon::now()->subYear())->get();

//        $data = Post::orderBy('created_at', 'Desc')->get()->groupBy('date_in');

//        $data = $skupina->groupBy('created_at');

//        dd(new Carbon('first day of last month'));

        $sendemails = User::whereHas('posts', function($q){
            $start = new Carbon('first day of last month');
            $end = new Carbon('last day of last month');
            $q->where([['date_in', '>', $start], ['date_in', '<', $end]]);
        })->get();


        $users = User::orderBy('id', 'DESC')->get();
        return view('admin.users')
            ->with('users' , $users)
            ->with('posts', $posts)
            ->with('sendemails', $sendemails)
            ;
    }



    public function sendReportToUsers(Request $request) {

        $id = $request->input('userid');



        $start = new Carbon('first day of last month');
        $end = new Carbon('last day of last month');

//Loop by mal poslať všetkým userom
//        $users = User::count();
//for ($x =1; $x <= $users; $x++) {
//}

//Mesačný výpis konkrétnemu užívateľovi mne
   $user  = User::find($id);
   $posts = $user->posts()->where([['date_in', '>', $start], ['date_in', '<', $end]])->get();

//
//                  \Mail::send('email.montusersreport',
//            $data = array(
//                'user' => $user,
//                'posts' => $posts,
//                'email' => $user->email
//            ), function($message) use ($data)
//            {
//                $message->from('admin@verejnyportal.eu', 'Zverejňovanie faktúr');
//                $message->to($data['email'], 'Verejný Portál')->bcc('gajdosgabo@gmail.com')
//                    ->subject('Mesačný výpis pridaných faktúr Január/2017 -- Verejný Portál.eu');
//            });



        return view('email.montusersreport')
            ->with('user' , $user)
            ->with('posts', $posts);


    }






}
