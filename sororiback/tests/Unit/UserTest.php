<?php
use App\Models\User;
use App\Models\Location;
use App\Models\Region;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_user_with_location()
    {
        $user = User::factory()->create();
        $location = Location::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(Location::class, $user->location);
        $this->assertEquals($user->id, $location->user_id);
    }

    public function test_create_unverified_user()
    {
        $user = User::factory()->unverified()->create();

        $this->assertNull($user->email_verified_at);
    }

    public function test_create_user_with_alert_password()
    {
        $user = User::factory()->create();

        $this->assertNotNull($user->alert_password);
    }

    public function test_create_user_with_region()
    {
        $user = User::factory()->create();

        $this->assertInstanceOf(Region::class, $user->town);
    }

    public function test_create_user_with_gender()
    {
        $user = User::factory()->create();

        $this->assertContains($user->gender, ['female', 'male', 'nonbinary']);
    }
}

# Todo el código de backend (excepto la base de laravel, filament y otros paquetes) hecho por: Mark López Morales