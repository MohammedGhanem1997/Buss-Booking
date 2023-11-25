<?php

namespace App\Http\Controllers\Api\V1\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\RideResource;
use App\Models\Ride;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TripsController extends Controller
{
    public function index( Request $request)
    {
        $ride=  Ride::with('bus');
        isset($request->arrival_place)?  $ride->where('arrival_place',$request->arrival_place):null;
        isset($request->departure_place)?  $ride->where('departure_place',$request->departure_place):null;
        isset($request->departure_time)?  $ride->where('departure_time','>=',$request->departure_time):null;
        isset($request->arrival_time)?  $ride->where('arrival_place' ,'<',$request->arrival_place):null;
//        $request->departure_place??$ride->where('departure_place',$request->departure_place);
//        $request->??$ride->where('arrival_place',$request->departure_time);
//        $request->arrival_time??$ride->where('arrival_time',$request->arrival_time);

        //departure_place=Lake Conrad&arrival_place&departure_time&arrival_time
        //
        return new RideResource($ride->get());
    }
}
