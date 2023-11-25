<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BokkingTest extends TestCase
{
    /**
     * A basic feature test example.
     */


    public function testBookingCreatedSuccessfully()
    {
        $loginData = ['email' => 'ghanem@test.com' . time(), "name" => "ghanem" . time(), 'password' => 'sample123'];

        $user = User::create($loginData);
        $this->actingAs($user, 'api');

        $bookingData = [
            "ride_id" => 50,
            "name" => "ghanem",
            "client_id"=>$user->id,
            "phone" => "01093072634",
            "email" => "ghanem@gmail.com",
            "status" => "Confirmed"

        ];

        $this->json('POST', 'api-client/v1/bookings', $bookingData, ['Accept' => 'application/json'])
            ->assertStatus(200);
    }


    public function testBookingUpdateSuccessfully()
    {
        $loginData = ['email' => 'ghanem@testbooking.com' . time(), "name" => "ghanem" . time(), 'password' => 'sample123'];

        $user = User::create($loginData);
        $this->actingAs($user, 'api');

        $bookingData = [
            "ride_id" => 50,
            "name" => "ghanem",
            "client_id"=>$user->id,
            "phone" => "01093072634",
            "email" => "ghanem@gmail.com",
            "status" => "Confirmed"

        ];
        $boiking=Booking::create($bookingData);

        $this->json('delete', 'api-client/v1/bookings/'.$boiking->id, $bookingData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([

    "status_code"=> 200,
    "message"=> "ACCEPTED",
    "data"=>[]

            ]);
    }

    public function testBookingShowSuccessfully()
    {
        $loginData = ['email' => 'ghanem@showbooking.com' . time(), "name" => "ghanem" . time(), 'password' => 'sample123'];

        $user = User::create($loginData);
        $this->actingAs($user, 'api');

        $bookingData = [
            "ride_id" => 50,
            "name" => "ghanem",
            "client_id"=>$user->id,
            "phone" => "01093072634",
            "email" => "ghanem@gmail.com",
            "status" => "Confirmed"

        ];
        $boiking=Booking::create($bookingData);

        $this->json('get', 'api-client/v1/bookings/'.$boiking->id, $bookingData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([


            ]);
    }


public function testBookingViewSuccessfully()
{
    $loginData = ['email' => 'ghanem@viewbooking.com' . time(), "name" => "ghanem" . time(), 'password' => 'sample123'];

    $user = User::create($loginData);
    $this->actingAs($user, 'api');

    $bookingData = [
        "ride_id" => 50,
        "name" => "ghanem",
        "client_id"=>$user->id,
        "phone" => "01093072634",
        "email" => "ghanem@gmail.com",
        "status" => "Confirmed"

    ];
    $boiking=Booking::create($bookingData);

    $this->json('get', 'api-client/v1/bookings/', $bookingData, ['Accept' => 'application/json'])
        ->assertStatus(200)
        ->assertJson([


        ]);
}
}
