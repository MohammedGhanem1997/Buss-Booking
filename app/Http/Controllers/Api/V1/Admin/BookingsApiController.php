<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Http\Resources\Admin\BookingResource;
use App\Models\Booking;
use App\Models\Ride;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BookingsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('booking_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return  ok_response(new BookingResource(Booking::with(['ride'])->get()))  ;
    }

    public function store(StoreBookingRequest $request)
    {

        $ride=  Ride::findorFail($request->ride_id);

        $places_available= $ride ->with('bus:id,places_available' );
        $confirmed=$ride->confirmedBookings()->count();
        if (  $places_available->first()->bus->places_available <=  $confirmed ) return unprocessable_response(["places_available"=>"no available place in this trip"]) ;

        $booking = Booking::create($request->all());

        return ok_response (new BookingResource($booking));

    }
//Confirmed
    public function show(Booking $booking)
    {
        abort_if(Gate::denies('booking_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BookingResource($booking->load(['ride','client']));
    }

    public function update(UpdateBookingRequest $request, Booking $booking)
    {

        $booking->update($request->all());

        return (new BookingResource($booking))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Booking $booking)
    {
        abort_if(Gate::denies('booking_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $booking->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
