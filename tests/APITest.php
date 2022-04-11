<?php

namespace AbediMostafa\ToDo\tests;

use AbediMostafa\ToDo\http\Models\Label;
use AbediMostafa\ToDo\http\Models\Task;
use AbediMostafa\ToDo\http\Resources\LabelAPIResource;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Tests\TestCase;

class APITest extends TestCase
{
    use RefreshDatabase;

    /**
     * Sets up the tests
     */
    public function setUp(): void
    {
        parent::setUp();

        Artisan::call('migrate');
    }

    /**
     * Test label store route
     *
     * @return void
     */
    public function testLabelsStore()
    {
        $user = factory(User::class)->create();
        $data = ['label' => Str::random(10)];

        $response = $this->actingAs($user)->post(
            '/api/labels',
            $data,
            ['Authorization' => 'Bearer ' . $user->api_token]);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 1,
                'msg' => 'Label Created successfully'
            ]);

        $this->assertDatabaseHas('labels', $data);
    }

    /**
     * Test label index route
     */
    public function testLabelIndex()
    {
        $user = factory(User::class)->create();

        $task = Task::create([
            'title' => Str::random(10),
            'description' => Str::random(40),
            'status' => 'open',
            'user_id' => $user->id,
        ]);

        factory(Label::class, 2)->create()
            ->each(function ($label) use ($task) {
                $label->tasks()->save(
                    $task
                );
            });

        $response = $this->actingAs($user)->get(
            '/api/labels',
            ['Authorization' => 'Bearer ' . $user->api_token]
        );

        $result = [
            'data' => [
                '*' => [
                    'id',
                    'label',
                    'tasks' => [
                        '*' => [
                            'id',
                            'title',
                            'description',
                            'status',
                            'pivot' => [
                                'label_id',
                                'task_id'
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $response->assertStatus(200)
            ->assertJsonStructure($result);
    }

    /**
     * Test Task store route
     */
    public function testTaskStore()
    {
        $user = factory(User::class)->create();
        $data = [
            'title' => Str::random(10),
            'description' => Str::random(50),
            'status' => false,
            'user_id' => $user->id
        ];

        $response = $this->actingAs($user)->post(
            '/api/tasks',
            $data,
            ['Authorization' => 'Bearer ' . $user->api_token]);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 1,
                'msg' => 'Task Created successfully'
            ]);
    }

    /**
     * Test Task index route
     */
    public function testTaskIndex()
    {
        $user = factory(User::class)->create();

        $task = Task::create([
            'title' => Str::random(10),
            'description' => Str::random(50),
            'status' => false,
            'user_id' => $user->id
        ]);

        $label = factory(Label::class)->create();

        $label->each(function ($label) use ($task) {
            $label->tasks()->attach(
                $task->id
            );
        });

        $anotherTask = Task::create([
            'title' => Str::random(10),
            'description' => Str::random(50),
            'status' => false,
            'user_id' => $user->id
        ])->labels()->attach(
            $label->id
        );

        $response = $this->actingAs($user)->get(
            '/api/tasks',
            ['Authorization' => 'Bearer ' . $user->api_token]
        );

        $result = [
            'data' => [
                '*' => [
                    'id',
                    'title',
                    'description',
                    'status',
                    'labels' => [
                        '*' => [
                            'id',
                            'label',
                            'tasks' => [
                                '*' => [
                                    'id',
                                    'title',
                                    'description',
                                    'status',
                                    'pivot' => [
                                        'label_id',
                                        'task_id',
                                    ],
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $response->assertStatus(200)
            ->assertJsonStructure($result);



    }

    /**
     * Test changing task status
     */
    public function testTaskChangeStatus()
    {
        $user = factory(User::class)->create();
        $task = Task::create([
            'title' => Str::random(10),
            'description' => Str::random(50),
            'status' => false,
            'user_id' => $user->id
        ]);

        $data = [
            'id' => $task->id,
            'status' => true,
        ];

        $response = $this->actingAs($user)->post(
            '/api/tasks/change-status',
            $data,
            ['Authorization' => 'Bearer ' . $user->api_token]);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 1,
                'msg' => 'status changed successfully'
            ]);
    }

    /**
     * Test for updating a task
     */
    public function testUpdateTask()
    {
        $user = factory(User::class)->create();
        $labelIds = factory(Label::class, 3)
            ->create()
            ->pluck('id')
            ->toArray();

        $task = Task::create([
            'title' => Str::random(10),
            'description' => Str::random(50),
            'status' => false,
            'user_id' => $user->id
        ]);

        $data = [
            'labels'=>$labelIds,
            'task'=>[
                'description' => "some",
                'id' => 11,
                'status' => true,
                'title' => "desc",
            ]
        ];

        $response = $this->actingAs($user)->put(
            '/api/tasks/'.$task->id,
            $data,
            ['Authorization' => 'Bearer ' . $user->api_token]);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 1,
                'msg' => 'Task updated successfully'
            ]);
    }

    /**
     * Test for showing a task
     */
    public function testShowTask()
    {
        $user = factory(User::class)->create();
        $label = factory(Label::class)
            ->create();

        $task = Task::create([
            'title' => Str::random(10),
            'description' => Str::random(50),
            'status' => false,
            'user_id' => $user->id
        ]);

        $task->labels()->sync($label->id);

        $response = $this->actingAs($user)->get(
            '/api/tasks/' . $task->id,
            ['Authorization' => 'Bearer ' . $user->api_token]);

        $response->assertStatus(200)
            ->assertJson([
                'id' => $task->id,
                'title' => $task->title,
                'description' => $task->description,
                'status' => $task->status,
                'labels' => [
                    [
                        'id' => $label->id,
                        'label' => $label->label,
                        'pivot' => [
                            'task_id' => $task->id,
                            'label_id' => $label->id,
                        ]
                    ]
                ]
            ]);
    }
}
