<?php

namespace App\Http\Controllers\Api\V1\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Http\Resources\Admin\BookingResource;
use App\Models\Booking;
use App\Models\Ride;
use Symfony\Component\HttpFoundation\Response;

class BookingApiController extends Controller
{
    public function index()
    {

        return  ok_response(new BookingResource(auth()->guard('api')->user()->load('bookings')  ))  ;
    }

    public function store(StoreBookingRequest $request)
    {


        $ride=  Ride::findorFail($request->ride_id);

        $places_available= $ride ->with('bus:id,places_available' );
        $confirmed=$ride->confirmedBookings()->count();
        if (  $places_available->first()->bus->places_available <=  $confirmed ) return unprocessable_response(["places_available"=>"no available place in this trip"]) ;



        $booking=$request->all();
       $booking["client_id"]= (int) auth()->guard('api')->user()->id;
        $booking = Booking::create($booking);

        return ok_response (new BookingResource($booking));

    }

    public function show(Booking $booking)
    {

        return new BookingResource($booking->load(['ride']));
    }



    public function destroy(Booking $booking)
    {

        $booking->delete();

        return ok_response([], 'ACCEPTED');
    }
}
