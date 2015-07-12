<?php 
 
use Illuminate\Database\Seeder;
use App\Post;

class PostsTableSeeder extends Seeder {
 
	public function run() 
	{
		// Create a Faker object
		$faker = Faker\Factory::create('en_US');
 		
	//	$categories = array("health", "relationships", "depression", "school", "light", "misc");
		

		// Create 5 sentences
		foreach( range(1, 50) as $item )
		{
		
			//	$rand_keys = array_rand($categories, 1); 
		        Post::create([
		        	// Date between now and two weeks later
			        'created_at' => $faker->dateTimeBetween($startDate = '-30 years', $endDate = 'now'),
			        
					// author
					'author' => $faker->firstName,
					
					// hearts
					'hearts' => $faker->numberBetween($min = 1, $max = 9000),
					
			        // body with 4 sentences
			        'body' => $faker->realText($maxNbChars = 550, $indexSize = 2),
			        
					 //coverpic
					 'coverpic' => $faker->imageUrl($width = 640, $height = 480),
					 
					 //category
				//	 'category' => $categories[array_rand($categories)],
					 
					 //user_id -- all refers to user with id 8
					 'user_id' => 1,
					 
					 // Title with 3 words
   			         'title' => $faker->realText($maxNbChars = 30, $indexSize = 2)
		        ]);
		}
	} 
}