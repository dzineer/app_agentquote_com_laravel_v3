<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return response()->json([
            "success" => true,
            "message" => "All notifications marked as read."
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notification = \DB::table('notifications')->where('id', '=', $id);
        if ($notification) {
            $notification->delete();
            return response()->json([
                "success" => true,
                "message" => "Notification deleted successfully."
            ]);
        }
        return response()->json([
           "success" => false,
           "message" => "Notification not deleted."
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy_all()
    {
        $notifications = \DB::table('notifications')->where('notifiable_id', '=', auth()->user()->id);
        if ($notifications) {
            $notifications->delete();
            return response()->json([
                "success" => true,
                "message" => "All Notification deleted successfully."
            ]);
        }
        return response()->json([
            "success" => false,
            "message" => "Notification not deleted."
        ]);
    }

}
