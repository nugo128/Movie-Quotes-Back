<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		DB::table('categories')->insert([
			[
				'category' => json_encode(['en' => 'Action', 'ka' => 'მძაფრ სიუჟეტიანი']),
			],
			[
				'category' => json_encode(['en' => 'Fantasy', 'ka' => 'ფენტეზი']),
			],
			[
				'category' => json_encode(['en' => 'Comedy', 'ka' => 'კომედია']),
			],
			[
				'category' => json_encode(['en' => 'Horror', 'ka' => 'საშინელებათა ფილმი']),
			],
			[
				'category' => json_encode(['en' => 'Drama', 'ka' => 'დრამა']),
			],
			[
				'category' => json_encode(['en' => 'Mystery', 'ka' => 'მისტიკა']),
			],
			[
				'category' => json_encode(['en' => 'Documentary', 'ka' => 'დოკუმენტური']),
			],
			[
				'category' => json_encode(['en' => 'Thriller', 'ka' => 'თრილერი']),
			],
			[
				'category' => json_encode(['en' => 'Western', 'ka' => 'ვესტერნი']),
			],
			[
				'category' => json_encode(['en' => 'Musical', 'ka' => 'მიუზიკლი']),
			],
		]);
	}
}
