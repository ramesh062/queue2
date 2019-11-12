<?php

namespace App\Http\Controllers;

use App\Jobs\OrderStatus;
use Illuminate\Http\Request;

class QueueController extends Controller
{
    public function simpleQueue()
    {
    	return view('simple-queue');
    }
    public function delayedDispatchingQueue()
    {
    	return view('delayed-dispatching');
    }
    public function synchronousDispatchingQueue()
    {
    	return view('synchronous-dispatching');
    }
    public function changeStatus(Request $request)
    {
    	if($request->status)
    	{
    		if($request->queue_type=='dispatching job')
    			OrderStatus::dispatch($request->status)->onConnection('database');
    		// ->onQueue('processing');
    		else if($request->queue_type=='delayed dispatching')
    			OrderStatus::dispatch($request->status)->delay(now()->addMinutes(5));
    		else if($request->queue_type=='synchronous dispatching')
    			OrderStatus::dispatchNow($request->status);
    	}
    	return response()->json(["code"=>200,"message"=>"Order status changed"],200);
    }
}
