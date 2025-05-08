<?php

namespace Tests\Feature\Videos;

use App\Models\User;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VideosTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        create_permissions();
    }

    /**
     * Comprova que els usuaris poden veure els vídeos existents.
     *
     * @return void
     */
    public function test_users_can_view_videos()
    {
        $user = User::factory()->create();
        $video = Video::create([
            'title' => 'Video de prueba',
            'description' => 'Descripción del video',
            'url' => 'https://www.youtube.com/watch?v=C9GPngZ1eVE',
            'published_at' => Carbon::now(),
            'user_id' => $user->id,
        ]);

        $response = $this->get(route('videos.show', $video->id));
        $response->assertStatus(200);
        $response->assertSee($video->title);
    }

    /**
     * Comprova que els usuaris no poden veure vídeos inexistents.
     *
     * @return void
     */
    public function test_users_cannot_view_not_existing_videos()
    {
        $response = $this->get('/video/999');

        $response->assertStatus(404);
    }
}
