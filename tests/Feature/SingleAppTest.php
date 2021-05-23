<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\Response;


class SingleAppTest extends TestCase
{

    use WithFaker;

    public function test_can_login_api()
    {
        $payload = [
            'email' => 'admin@admin.com',
            'password' => 'password',
        ];
        $response = $this->json('post', 'http://localhost/api/login', $payload)
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    "access_token",
                    "token_type"
                ]
            );
        $GLOBALS['access_token'] = $response['access_token'];
        $GLOBALS['token_type'] = $response['token_type'];
    }

    public function test_can_add_student()
    {
        if (!isset($GLOBALS['access_token'])) {
            $this->assertTrue(false, 'Missing Access Token!');
            return;
        }
        $payload = [
            'email' => $this->faker->email(),
            'name' => $this->faker->name(),
            "school" => "Auckland Grammar"

        ];

        $headers = [
            'HTTP_AUTHORIZATION' => 'Bearer ' . $GLOBALS['access_token']
        ];
        $response = $this->json('post', 'http://localhost/api/student', $payload, $headers)
            ->assertStatus(Response::HTTP_CREATED);
        $GLOBALS['used_email'] =  $payload['email'];
    }


    public function test_can_not_add_student_missing_data()
    {

        if (!isset($GLOBALS['access_token'])) {
            $this->assertTrue(false, 'Missing Access Token!');
            return;
        }
        $payload = [
            'email' => $this->faker->email(),
            'name' => $this->faker->name(),
        ];
        $headers = [
            'HTTP_AUTHORIZATION' => 'Bearer ' . $GLOBALS['access_token']
        ];
        $response = $this->json('post', 'http://localhost/api/student', $payload, $headers)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_can_not_use_same_email_again()
    {

        if (!isset($GLOBALS['access_token'])) {
            $this->assertTrue(false, 'Missing Access Token!');
            return;
        }
        $payload = [
            'email' => $GLOBALS['used_email'],
            'name' => $this->faker->name(),
            "school" => "Auckland Grammar"

        ];
        $headers = [
            'HTTP_AUTHORIZATION' => 'Bearer ' . $GLOBALS['access_token']
        ];
        $response = $this->json('post', 'http://localhost/api/student', $payload, $headers)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
