<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Client;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClientUnitTest extends TestCase
{
		public function testGetOneClient(){
        $client = factory(Client::class)->create();
				
        $this->json('GET', '/api/client/' . $client->id, [])
            ->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'first_name',
                'last_name',
                'email',
                'created_at',
                'updated_at',
            ])
            ->assertJson([
                'id'         => $client->id,
                'first_name' => $client->first_name,
                'last_name'  => $client->last_name,
                'email'      => $client->email,
            ]);
    }
	
    public function testGetAllClients(){
			
        $arrayClient = factory(Client::class, 2)->create();

        $this->json('GET', '/api/client', [])
            ->assertStatus(200)
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'first_name',
                    'last_name',
                    'email',
                    'created_at',
                    'updated_at',
                ],
            ]);
    }
		
		public function testCreateClient(){
        $client = [
            'first_name' => 'TestFirstName',
            'last_name' => 'TestLastName',
            'email' => 'Test@example.com',
            'password' => '12345678',
        ];

        $this->json('POST', '/api/client', $client)
            ->assertStatus(201)
            ->assertJson([
                'first_name' => 'TestFirstName',
                'last_name' => 'TestLastName',
                'email' => 'Test@example.com',
            ]);
    }
		 
		
		public function testDeleteClient(){
        $client = factory(Client::class)->create();
				
        $this->json('DELETE', '/api/client/' . $client->id, [])
            ->assertStatus(204);
    }
}
