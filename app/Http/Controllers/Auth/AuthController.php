<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;


class AuthController extends Controller
{

    public function redirectToProvider($service)
    {
        return Socialite::driver($service)->redirect();
    }


    public function handleProviderCallback(Request $request, $service)
    {
//        $oauth_user = Socialite::driver($service)->stateless()->user();
        $oauth_user = Socialite::driver($service)->user();

        if (!$user = User::whereEmail($oauth_user->email)->first())
        {
            $name = explode(" ", $oauth_user->name);
            $first_name = $name[1];
            $last_name = $name[0];

//        dd($name[0]);

          return $this->create([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $oauth_user->email,
                'password' => Hash::make(rand(8,10)),
                'email_verified_at' => Carbon::now()
            ]);

            $this->loginUser($user);
        }

         $this->loginUser($user);
    }

    protected function loginUser($user)
    {
//        if($user->disabled){
//            return $this->isUserLocked($user);
//        }
        \Auth::login($user, true);

//        if(\Session::has('backUrl'))
//        {
//            return redirect(\Session::get('backUrl'));
//        }
        return redirect('/');

    }

}
