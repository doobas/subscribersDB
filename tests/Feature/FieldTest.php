<?php

namespace Tests\Feature;

use App\Field;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FieldTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testFieldIndex()
    {
        factory(Field::class, 10)->create();

        $response = $this->getJson('/api/fields');

        $response
            ->assertStatus(200)
            ->assertJsonCount(10, 'data');
    }

    public function testFieldCreate()
    {
        $title = $this->faker->word;
        $type = $this->faker->randomElement(Field::TYPES);

        $response = $this->postJson('/api/fields', [
            Field::A_TITLE => $title,
            Field::A_TYPE => $type,
        ]);

        $response->assertCreated()
            ->assertJsonPath('data.'.Field::A_TITLE, $title)
            ->assertJsonPath('data.'.Field::A_TYPE, $type);
    }

    public function testFieldCreateValidation()
    {
        $response = $this->postJson('/api/fields');

        $response->assertJsonValidationErrors([Field::A_TITLE, Field::A_TYPE]);

        $response = $this->postJson('/api/fields', [
            Field::A_TITLE => $this->faker->word,
            Field::A_TYPE => 'type',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors([Field::A_TYPE]);
    }

    public function testFieldShow()
    {
        $field = factory(Field::class)->create();

        $response = $this->getJson("/api/fields/{$field->id}");

        $response->assertStatus(200)
            ->assertJsonPath('data', $field->toArray());
    }

    public function testFieldUpdate()
    {
        $field = factory(Field::class)->create();

        $title = $this->faker->word;

        $response = $this->putJson("/api/fields/{$field->id}", [
            Field::A_TITLE => $title,
            Field::A_TYPE => 'random_type'
        ]);

        $response->assertStatus(200)
            ->assertJsonPath('data.'.Field::A_TITLE, $title)
            ->assertJsonPath('data.'.Field::A_TYPE, $field->{Field::A_TYPE});
    }

    public function testFieldUpdateValidation()
    {
        $field = factory(Field::class)->create();

        $response = $this->putJson("/api/fields/{$field->id}");

        $response->assertStatus(422)
            ->assertJsonValidationErrors([Field::A_TITLE]);
    }

    public function testFindFieldById()
    {
        $field = factory(Field::class)->create();

        $foundField = Field::findByTitle($field->{Field::A_TITLE});

        $this->assertEquals($field->id, $foundField->id);
    }
}
