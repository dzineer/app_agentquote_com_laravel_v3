<?php

namespace Tests\Feature;

use App\Models\Administrator;
use App\Models\Affiliate;
use App\Models\Agent;
use App\Models\Manager;
use App\Models\SuperUser;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrationTest extends TestCase
{
	// use RefreshDatabase;
	/** @test */
    public function a_affiliate_can_register() {
    	$this->withoutExceptionHandling();

	    $response = $this->json('POST', '/register', [
	    	'name' => 'John Doe',
	    	'first_name' => 'John',
	    	'last_name' => 'Doe',
	    	'password' => 'abcd1234',
	    	'password_confirmation' => 'abcd1234',
	    	'email' => 'jdoe_affiliate@example.com',
		    'type' => 'affiliate',
		    'name' => 'AgentQuote',
		    'coupon' => 'COUPON_CODE'
	    ]);

	   //  dd($response->decodeResponseJson());
		$response->assertStatus(302);
		$response->assertRedirect('/home');

		$user = User::first();
		$affiliate = Affiliate::first();

	    $this->assertNotNull($user);
	    $this->assertNotNull($affiliate);

	   // $this->assertEquals('COUPON_CODE', $affiliate->coupon );
	   // $this->assertEquals('COUPON_CODE', $user->coupon );
    }

	/** @test */
	public function a_agent_can_register() {
		$this->withoutExceptionHandling();

		$response = $this->json('POST', '/register', [
			'name' => 'John Doe',
			'first_name' => 'John',
			'last_name' => 'Doe',
			'password' => 'abcd1234',
			'password_confirmation' => 'abcd1234',
			'email' => 'jdoe_agent@example.com',
			'type' => 'agent',
			'contact_email' => 'jdoe_agent@example.com',
			'contact_addr1' => '3434 Gold St.',
			'contact_city' => 'Fullerton',
			'contact_state' => 'California',
			'contact_zip' => '90631'
		]);

		//  dd($response->decodeResponseJson());
		$response->assertStatus(302);
		$response->assertRedirect('/home');

		$user = User::first();
		$agent = Agent::first();

		$this->assertNotNull($user);
		$this->assertNotNull($agent);

		//$this->assertEquals('jdoe_agent@example.com', $agent->contact_email );
		//$this->assertEquals('jdoe_agent@example.com', $user->contact_email );
	}

	/** @test */
	public function a_superuser_can_register() {
		$this->withoutExceptionHandling();

		$response = $this->json('POST', '/register', [
			'name' => 'Super Doe',
			'first_name' => 'Super',
			'last_name' => 'Doe',
			'password' => 'abcd1234',
			'password_confirmation' => 'abcd1234',
			'email' => 'jdoe_superuser@example.com',
			'type' => 'SuperUser',
			'active' => 1,
		]);

		//  dd($response->decodeResponseJson());
		$response->assertStatus(302);
		$response->assertRedirect('/home');

		$user = User::first();
		$super_user = SuperUser::first();

		$this->assertNotNull($user);
		$this->assertNotNull($super_user);

		$this->assertEquals('1', $super_user->active );
		$this->assertEquals('1', $super_user->active );
	}

	/** @test */
	public function a_administrator_can_register() {
		$this->withoutExceptionHandling();

		$response = $this->json('POST', '/register', [
			'name' => 'Admin Doe',
			'first_name' => 'Admin',
			'last_name' => 'Doe',
			'password' => 'abcd1234',
			'password_confirmation' => 'abcd1234',
			'email' => 'jdoe_admin@example.com',
			'type' => 'Administrator',
			'group' => 'Administrator@jdoe_aff',
			'active' => 1,
		]);

		//  dd($response->decodeResponseJson());
		$response->assertStatus(302);
		$response->assertRedirect('/home');

		$user = User::first();
		$admin = Administrator::first();

		$this->assertNotNull($user);
		$this->assertNotNull($admin);

		$this->assertEquals('Administrator@jdoe_aff', $admin->group );
		$this->assertEquals('Administrator@jdoe_aff', $admin->group );
	}

	/** @test */
	public function a_manager_can_register() {
		$this->withoutExceptionHandling();

		$response = $this->json('POST', '/register', [
			'name' => 'Manager Doe',
			'first_name' => 'Manager',
			'last_name' => 'Doe',
			'password' => 'abcd1234',
			'password_confirmation' => 'abcd1234',
			'email' => 'jdoe_manager@example.com',
			'type' => 'Manager',
			'group' => 'Manager@jdoe_aff',
			'active' => 1,
		]);

		//  dd($response->decodeResponseJson());
		$response->assertStatus(302);
		$response->assertRedirect('/home');

		$user = User::first();
		$manager = Manager::first();
		$this->assertNotNull($user);
		$this->assertNotNull($manager);

		$this->assertEquals('Manager@jdoe_aff', $manager->group );
		$this->assertEquals('Manager@jdoe_aff', $manager->group );
	}

}
