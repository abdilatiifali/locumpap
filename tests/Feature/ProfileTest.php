<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Profile;
use App\Models\User;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    
    /**
    *  @test 
    * @group skip
     * */
    public function an_authenticated_doctor_can_update_profile()
    {
        $this->loginAsDoctor();

        $profile = create(Profile::class, [
            'user_id' => auth()->id(),
            'about' => null,
            'gender' => null,
            'qualification' => null,
            'nationalId' => null,
            'cv' => null,
            'recommendation_letter' => null,
            'indemnity_cover' => null,
        ]);

        Storage::fake('application');

        $avatar = UploadedFile::fake()->image('avatar.jpg');

        $nationalId = UploadedFile::fake()->create('nationalId.pdf');
        $cv = UploadedFile::fake()->create('cv.pdf');
        $recommendation_letter = UploadedFile::fake()->create('recommendation_letter.pdf');
        $indemnity_cover = UploadedFile::fake()->create('indemnity_cover.pdf');

        $this->put('/profile', [
            'about' => 'my name is abdi',
            'avatar' => $avatar,
            'gender' => 'male',
            'level' => '1 year',
            'qualification' => 'phd',
            'nationalId' => $nationalId,
            'cv' => $cv,
            'recommendation_letter' => $recommendation_letter,
            'indemnity_cover' => $indemnity_cover,
            'available' => '2022-04-20 to 2022-04-29',
        ]);

        $profile = Profile::first();

        $this->assertEquals('my name is abdi', $profile->about);
        $this->assertEquals('male', $profile->gender);
        $this->assertEquals('phd', $profile->qualification);
        $this->assertEquals('2022-04-20', $profile->from);
        $this->assertEquals('2022-04-29', $profile->to);
        $this->assertEquals("avatars/{$avatar->hashName()}", auth()->user()->fresh()->profile_photo_path);
        $this->assertEquals("application/{$nationalId->hashName()}", $profile->nationalId);
        $this->assertEquals("application/{$cv->hashName()}", $profile->cv);
        $this->assertEquals("application/{$recommendation_letter->hashName()}", $profile->recommendation_letter);
        $this->assertEquals("application/{$cv->hashName()}", $profile->cv);
        $this->assertEquals("application/{$indemnity_cover->hashName()}", $profile->indemnity_cover);

    }

    /** @test */
    public function a_guest_can_not_visit_profile()
    {
        $this->get("/profile")
            ->assertRedirect('/login');
    }

    /** @test */
    public function a_guest_can_not_update_profile()
    {
        $this->put('/profile')
            ->assertRedirect('/login');
    }

    /** @test */
    public function an_admin_can_not_view_profile()
    {
        $this->loginAsAdmin();

        $this->get("/profile")
            ->assertForbidden();
    }

    /** @test */
    public function an_organization_can_not_view_profile()
    {
        $this->loginAsOrganization();

        $this->get("/profile")
            ->assertForbidden();
    }

}
