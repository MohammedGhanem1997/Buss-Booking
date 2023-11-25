<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testRequiredFieldsForRegistration()
    {
        $this->json('POST', 'api-client/v1/register', ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "message"=> "The name field is required. (and 2 more errors)",
    "errors"=> [
        "name"=> [
            "The name field is required."
        ],
        "email"=> [
            "The email field is required."
        ],
        "password"=> [
            "The password field is required."
        ]
    ]
            ]);
    }

    public function testRepeatPassword()
    {
        $userData = [
            "name" => "Mohamed Ghanem",
            "email" => "Mghanem@gmail.com".time(),
            "password" => "demo12345"
        ];

        $this->json('POST', 'api-client/v1/register', $userData, ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "message" => "The password field confirmation does not match.",
                "errors" => [
                    "password"=> ["The password field confirmation does not match." ]

                ]
            ]);
    }

    public function testSuccessfulRegistration()
    {
        $userData = [
            "name" => "Mohamed Ghanem",
            "email" => "Mghanem@gmail.com".time(),
            "password" => "demo12345",
            "password_confirmation" => "demo12345"
        ];

        $this->json('POST', 'api-client/v1/register', $userData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "status_code",
    "message",
    "data"=> [
        "user"=> [
            "id",
            "name",
            "email",
            "email_verified_at",
            "created_at",
            "updated_at",
            "deleted_at"
        ],
        "token",
        ]
            ]);
    }

    public function testMustEnterEmailAndPassword()
    {
        $this->json('POST', 'api-client/v1/signin')
            ->assertStatus(422)
            ->assertJson([
                "message" =>'The email field is required. (and 1 more error)',
                "errors" => [
                    'email' => ["The email field is required."],
                    'password' => ["The password field is required."],
                ]
            ]);
    }

    public function testSuccessfulLogin()
    {
        $loginData = ['email' => 'sample@test.com'.time(),"name"=>"ghanem".time(), 'password' => 'sample123'];

        $user = User::create($loginData);

        $this->json('POST', 'api-client/v1/signin', $loginData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "status_code",
                "message",
                "data"=> [
                    "user"=> [
                        "id",
                        "name",
                        "email",
                        "email_verified_at",
                        "created_at",
                        "updated_at",
                        "deleted_at"
                    ],
                    "token",
                ]
            ]);

        $this->assertAuthenticated();
    }
}
