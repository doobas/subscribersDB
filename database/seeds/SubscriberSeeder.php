<?php

use Illuminate\Database\Seeder;

class SubscriberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Subscriber::class, 100)->create()->each(function(\App\Subscriber $subscriber) {
            $faker = Faker\Factory::create();
            $fields = \App\Field::inRandomOrder()->take(random_int(0,10))->get();
            foreach ($fields as $field) {
                switch ($field->{\App\Field::A_TYPE}) {
                    case \App\Field::TYPE_STRING:
                        $value = $faker->word();
                        break;
                    case \App\Field::TYPE_BOOLEAN:
                        $value = $faker->boolean;
                        break;
                    case \App\Field::TYPE_NUMBER:
                        $value = $faker->numberBetween();
                        break;
                    case \App\Field::TYPE_DATE:
                        $value = $faker->date();
                        break;
                    default:
                        $value = $faker->word();
                }
                $subscriber->fields()->attach($field, ['value' => $value]);
            }

        });
    }
}
