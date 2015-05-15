<?php 
 
use Illuminate\Database\Seeder;
use App\Post;

class PostsTableSeeder extends Seeder {
 
	public function run() 
	{
		// Create a Faker object
		$faker = Faker\Factory::create();
 
		$categories = array("health", "relationships", "depression", "school", "light", "misc");
		

		// Create 5 sentences
		foreach( range(1, 50) as $item )
		{
		
				$rand_keys = array_rand($categories, 1); 
		        Post::create(array(
			        // Title with 3 words
   			        'title' => $faker->sentence(3),
			        // body with 4 sentences
			        'body' => $faker->paragraph(6),
			        // Date between now and two weeks earlier
			        'created_at' => $faker->dateTimeBetween('now', '+14 days'),
					// author
					'author' => $faker->name,
					// hearts
					'hearts' => $faker->numberBetween($min = 0, $max = 9000),
					 //coverpic
					 'coverpic' => $faker->imageUrl($width = 640, $height = 480),
					 //category
					 'category' => $categories[array_rand($categories)],
					 //user_id -- all refers to user with id 1
					 'user_id' => 8
					
		        ));
		}
	} 
}