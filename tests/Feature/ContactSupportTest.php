<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Mail;
use App\Mail\SupportHasBeenContacted;

class ContactSupportTest extends TestCase
{
    use RefreshDatabase;
   /** @test */
   public function any_one_can_contact_support_locum_pap_tem()
   {
        Mail::fake();

        Mail::assertNothingOutgoing();

        $this->post("/support", [
            'name' => 'abdi ali',
            'email' => 'abdi@gmail.com',
            'phone' => 1349929,
            'message' => 'testing email message must be 16 times character long.',
        ]);

        Mail::assertQueued(SupportHasBeenContacted::class);

        Mail::assertQueued(function (SupportHasBeenContacted $mail) {
            return $mail->hasTo('info@locumpap.com');
        });

   }

   /** @test */
   public function name_is_required_to_contact_support()
   {
        $this->post("/support", [
            'name' => null,
            'email' => 'abdi@gmail.com',
            'phone' => 1349929,
            'message' => 'testing email message must be 16 times character long.',
        ])
        ->assertStatus(302)
        ->assertSessionHasErrors('name');

    }

   /** @test */
   public function email_is_required_to_contact_support()
   {
        $this->post("/support", [
            'name' => 'abdi ali',
            'email' => null,
            'phone' => 1349929,
            'message' => 'testing email message must be 16 times character long.',
        ])
        ->assertStatus(302)
        ->assertSessionHasErrors('email');

    }

     /** @test */
   public function email_must_be_a_valid_email_address()
   {
        $this->post("/support", [
            'name' => 'abdi ali',
            'email' => 'abdi ali',
            'phone' => 1349929,
            'message' => 'testing email message must be 16 times character long.',
        ])
        ->assertStatus(302)
        ->assertSessionHasErrors('email');

    }

     /** @test */
    public function phone_is_required_to_contact_support()
    {
        $this->post("/support", [
            'name' => 'abdi ali',
            'email' => 'latiif@gmail.com',
            'phone' => null,
            'message' => 'testing email message must be 16 times character long.',
        ])
        ->assertStatus(302)
        ->assertSessionHasErrors('phone');

    }

    public function message_is_required_to_contact_support()
    {
        $this->post("/support", [
            'name' => 'abdi ali',
            'email' => 'latiif@gmail.com',
            'phone' => '0745793438',
            'message' => '',
        ])
        ->assertStatus(302)
        ->assertSessionHasErrors('message');

    }




}
