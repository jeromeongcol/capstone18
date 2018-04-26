<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UsersRepositories;
use Vinkla\Hashids\Facades\Hashids;
use Auth;
use Validator;
use App\Event;
use Carbon\Carbon;
use App\Notifications\EventNotification;
use App\User;

class EventController extends Controller
{
    

    public function __construct()
    {
        $this->middleware('auth');
    } 


    public function eventsCalendar( Request $request  )
    {     

      $repositories = new UsersRepositories;
      $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );
      $this->EventsStatusManager( Event::all() );

      if( $request->ajax() ){

          $content = view('dashboard.events.partials.calendar')->with(compact('auth'))->render();
          return response()->json(['content'=> $content ]);
      }

      //dd( auth()->user()->unreadNotifications->toArray() );

      $content = view('dashboard.events.partials.calendar')->with(compact('auth'))->render();
      return view('dashboard.events.index', compact('auth' ,'content'));

    }




    public function events( Request $request  )
    {     

      $repositories = new UsersRepositories;
      $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );
      $events = Event::all();


      if( $request->ajax() ){

          $content = view('dashboard.events.partials.events')->with(compact('auth','events'))->render();
          return response()->json(['content'=> $content ]);
      }

      $content = view('dashboard.events.partials.events')->with(compact('auth','events'))->render();
      return view('dashboard.events.index', compact('auth' ,'content'));


    }





    public function getEvent( Request $request )
    {     

      $event = Event::where( 'id', $request->id )->first();

      return response()->json( $event );

    }




    public function refetchEventsToCalendar()
    {     

      return response()->json([ 'events'=> Event::select('id', 'title', 'start', 'end','description','backgroundColor')->get() ]);

    }
    

    public function EventsStatusManager( $events ){

      foreach ($events as $event) {
        $this->setEventStatus( $event );
      }
      

    }


    public function  setEventStatus( $event ){

      $start = new Carbon($event->start);
      $end = new Carbon($event->end);

      if( $start->gt( Carbon::now() ) && $end->gt( Carbon::now() ) ){

        $event->status = "upcoming";
        $event->update();

      }else if( $start->lt( Carbon::now() ) && $end->lt( Carbon::now() ) ){

        $event->status = "finished";
        $event->backgroundColor = "#d46c6c";
        $event->update();

      }else{

        $event->status = "ongoing";
        $event->backgroundColor = "#0c6c32";
        $event->update();
      }


    } 





    public function addEvent( Request $request ){


      $validator = Validator::make($request->all(), [

            'title' => 'required|string|max:100',
            'description' => 'nullable',
            'start' => 'required|date|before:end|after:today',
            'end' => 'required|date|after:start',
            'speaker' => 'required|string|regex:/^[(a-zA-Z\s)]+$/u',
            'venue' => 'required|string|max:150',

      ]);



      if ( $validator->passes() ) {

          $event = new Event();
          $event->title = $request->title;
          $event->description = $request->description;
          $event->start = Carbon::createFromFormat('m/d/Y H:i A', $request->start );
          $event->end =Carbon::createFromFormat('m/d/Y H:i A', $request->end );
          $event->date = Carbon::parse($request->start)->format('m/d/y').' - '.Carbon::parse($request->end)->format('m/d/y');
          $event->time = Carbon::parse($request->start)->format('g:i A').' - '.Carbon::parse($request->end)->format('g:i A');

          $event->speaker = $request->speaker;
          $event->venue = $request->venue;
          $event->added_by = Auth::user()->id;
          $event->save();


          $this->setEventStatus( $event );


          $events = Event::all();
          $success = "Successfully added new Event.";
          $content = view('dashboard.events.partials.calendar')->with(compact('auth','events'))->render();
          return response()->json(['content'=> $content, 'success' => $success ]);
   

      }else{

	        return response()->json(['error'=>$validator->getMessageBag()->toArray()]);


		 }

	}







    public function updateEvent( Request $request ){

      $validator = Validator::make($request->all(), [

            'title' => 'required|max:50',
            'description' => 'nullable',
            'start' => 'required|date|before:end',
            'end' => 'required|date|after:start',
            'speaker' => 'required|string|regex:/^[(a-zA-Z\s)]+$/u',
            'venue' => 'required|string|max:150',

      ]);



      if ( $validator->passes() ) {

          $event = Event::where( 'id', $request->id )->first();
          $event->title = $request->title;
          $event->description = $request->description;
          $event->start = Carbon::parse($request->start);
          $event->end = Carbon::parse($request->end);
          $event->date = Carbon::parse($request->start)->format('m/d/y').' - '.Carbon::parse($request->end)->format('m/d/y');
          $event->time = Carbon::parse($request->start)->format('g:i A').' - '.Carbon::parse($request->end)->format('g:i A');

          
          $event->speaker = $request->speaker;
          $event->venue = $request->venue;

          $event->added_by = Auth::user()->id;

          $event->update();



          $this->setEventStatus( $event );




          $events = Event::all();

          $success = "Successfully updated Event.";
          $content = view('dashboard.events.partials.calendar')->with(compact('auth','events'))->render();
          return response()->json(['content'=> $content, 'success' => $success ]);
   

      }else{

          return response()->json(['error'=>$validator->getMessageBag()->toArray()]);


     }

  }




   public function cancelEvent( Request $request ){



        $event = Event::where( 'id', $request->id  )->first();
        $event->status = 'cancelled';
        $event->backgroundColor = "#231c1c4d";
        $event->update();


        $events = Event::all();

        $success = "Successfully cancelled an Event.";
        $content = view('dashboard.events.partials.calendar')->with(compact('auth','events'))->render();
        return response()->json(['content'=> $content, 'success' => $success ]);



   }


   public function resumeEvent( Request $request ){



        $event = Event::where( 'id', $request->id  )->first();
        $event->status = 'upcoming';
        $event->backgroundColor = "#0fa5bb";
        $event->update();


        $events = Event::all();

        $success = "Event Successfully Resumed.";
        $content = view('dashboard.events.partials.calendar')->with(compact('auth','events'))->render();
        return response()->json(['content'=> $content, 'success' => $success ]);



   }







}
