<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Project;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectUnitTest extends TestCase
{
 	public function testGetOneProject(){
		
    $project = factory(Project::class)->create();
		
      $this->json('GET', '/api/project/'.$project->id, [])
        ->assertStatus(200)
        ->assertJsonStructure([
          'id',
          'name',
          'description',
          'status',
          'created_at',
          'updated_at',
        ])
        ->assertJson([
					'id' 					=> $project->id,
          'name' 				=> $project->name,
          'description' => $project->description,
          'status' 			=> $project->status,
        ]);
  }
	
	public function testGetAllProjects(){
		
    factory(Project::class,2)->create();

    $this->json('GET', '/api/project', [])
      ->assertStatus(200)
      ->assertJsonStructure([
        '*' => [
          'id',
          'name',
          'description',
          'status',
          'created_at',
          'updated_at',
        ],
      ]);
  }
	
	public function testCreateProject(){
		
		$project = [
			'name' 				=> 'TestProject',
			'description' => 'TestProjectDescription',
			'status' 			=> 'running',
		];
		
    $this->json('POST', '/api/project', $project)
      ->assertStatus(201)
      ->assertJson([
        'name'        => $project['name'],
        'description' => $project['description'],
        'status'      => $project['status'],
      ]);
  }
	
	public function testUpdateProject(){
		
    $project = factory(Project::class)->create();
		
    $data = [
      'name'        => 'TestProject',
      'description' => 'TestProjectDescription',
      'status'      => 'on hold',
    ];
		
    $this->json('PUT', '/api/project/' . $project->id, $data)
      ->assertStatus(200)
      ->assertJson([
        'id'          => $project->id,
        'name'        => $data['name'],
        'description' => $data['description'],
        'status'      => $data['status'],
      ]);
  }
	
	public function testDeleteProject(){
		
    $project = factory(Project::class)->create();
		
    $this->json('DELETE', '/api/project/' . $project->id, [])
        ->assertStatus(204);
  }
}
