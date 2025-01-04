<?php

use App\Domain\Segment\Models\Segment;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

describe('Edit segment test', function () {
    it('requires all the necessary fields', function () {
        $admin = \App\Models\User::factory()->admin()->create();

        $segment = Segment::factory()->create();

        actingAs($admin)
            ->put(route('segment.update', ['segment' => $segment]), [])
            ->assertSessionHasErrors(['name', 'description', 'is_active']);
    });

    it('updates the segment data', function () {
        $admin = \App\Models\User::factory()->admin()->create();

        $segment = Segment::factory()->create();

        $updatedData = [
            'name' => 'New name',
            'description' => 'New description',
            'is_active' => false,
        ];

        actingAs($admin)
            ->put(route('segment.update', ['segment' => $segment]), $updatedData)
            ->assertRedirectToRoute('segment.show', ['segment' => $segment]);

        $this->assertDatabaseHas('segments', $updatedData);
    });
});
