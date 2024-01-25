<?php

namespace Tests\Feature\Http\Models;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Member;
use Tests\TestCase;

class MemberTest extends TestCase
{
     /**
     * A basic test example.
     */
    public function test_create_member(): void
    {
        $member = Member::factory()->create();
        $this->assertModelExists($member);
    }
}