<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UsersRepositories;
use Vinkla\Hashids\Facades\Hashids;
use Auth;
use App\Event;
use DB;
use Carbon\Carbon;
use App\Notifications;

class NotificationController extends Controller
{
    



    public function notifications( Request $request  )
    {     

      $repositories = new UsersRepositories;
      $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );
      $notifications_ = auth()->user()->unreadNotifications->toArray();


      if( $request->ajax() ){

          $content = view('dashboard.notifications.partials.notifications')->with( compact('notifications_'))->render();
          return response()->json(['content'=> $content ]);
      }


      $content = view('dashboard.notifications.partials.notifications')->with( compact('notifications_'))->render();
      return view('dashboard.notifications.index', compact('auth' ,'content'));


    }


    public function notification( Request $request  )
    {     


      if( $request->type == "EventNotification" ){

      	$notification_details = Event::where('id', Hashids::decode( $request->id ) )->first();

      	$content = view('dashboard.notifications.partials.event.content')->with( compact('notification_details'))->render();
        return response()->json(['content'=> $content ]);

      }


    }




}
