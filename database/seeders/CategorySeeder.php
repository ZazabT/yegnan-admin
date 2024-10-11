<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Category Seeder
        $categories = [
            [
                'name' => 'Traditional home',
                'icon' => 'fas fa-home', // Font Awesome home icon class
                'description' => 'Stay in a traditional Ethiopian Tukul hut, offering an authentic cultural experience.'
            ],
            [
                'name' => 'Guest Houses',
                'icon' => 'fas fa-hotel', // Font Awesome hotel icon class
                'description' => 'Comfortable guest houses providing homely accommodations for travelers.'
            ],
            [
                'name' => 'Luxury Hotels',
                'icon' => 'fas fa-bed', // Font Awesome bed icon class
                'description' => 'Top-tier luxury hotels offering the finest amenities and services.'
            ],
            [
                'name' => 'Boutique Hotels',
                'icon' => 'fas fa-business-time', // Font Awesome boutique icon class
                'description' => 'Charming boutique hotels with personalized service and unique designs.'
            ],
            [
                'name' => 'Eco Lodges',
                'icon' => 'fas fa-leaf', // Font Awesome eco icon class
                'description' => 'Eco-friendly lodges that offer sustainable stays in beautiful locations.'
            ],
            [
                'name' => 'Homestays',
                'icon' => 'fas fa-house-user', // Font Awesome house user icon class
                'description' => 'Experience the local culture with homestay accommodations.'
            ],
            [
                'name' => 'Serviced Apartments',
                'icon' => 'fas fa-building', // Font Awesome building icon class
                'description' => 'Fully serviced apartments for long or short stays, ideal for families and groups.'
            ],
            [
                'name' => 'Farm Stays',
                'icon' => 'fas fa-tractor', // Font Awesome tractor icon class
                'description' => 'Stay on a working farm and enjoy rural Ethiopian life firsthand.'
            ],
            [
                'name' => 'Treehouses',
                'icon' => 'fas fa-tree', // Font Awesome tree icon class
                'description' => 'Unique treehouse accommodations surrounded by nature.'
            ],
            [
                'name' => 'Safari Tents',
                'icon' => 'fas fa-campground', // Font Awesome campground icon class
                'description' => 'Stay in luxury safari tents, perfect for a wilderness adventure.'
            ],
            [
                'name' => 'Villas',
                'icon' => 'fas fa-villa', // Font Awesome villa icon class (may need a specific class)
                'description' => 'Luxurious private villas for a truly relaxing stay.'
            ],
            [
                'name' => 'Historic Mansions',
                'icon' => 'fas fa-monument', // Font Awesome monument icon class
                'description' => 'Stay in elegant mansions that are steeped in history and culture.'
            ],
            [
                'name' => 'Camping Sites',
                'icon' => 'fas fa-fire', // Font Awesome fire icon class
                'description' => 'Enjoy a night under the stars at one of Ethiopia’s many scenic campsites.'
            ],
            [
                'name' => 'Mountain Cabins',
                'icon' => 'fas fa-mountain', // Font Awesome mountain icon class
                'description' => 'Rustic mountain cabins providing a peaceful retreat in the highlands.'
            ],
            [
                'name' => 'Coffee Farms',
                'icon' => 'fas fa-coffee', // Font Awesome coffee icon class
                'description' => 'Stay on a coffee farm and learn about the rich heritage of Ethiopian coffee.'
            ],
            [
                'name' => 'Cultural Stays',
                'icon' => 'fas fa-users', // Font Awesome users icon class
                'description' => 'Immersive cultural stays where you can engage with local traditions and people.'
            ],
            [
                'name' => 'Historic Homes',
                'icon' => 'fas fa-history', // Font Awesome history icon class
                'description' => 'Stay in historically significant homes that showcase Ethiopian heritage.'
            ],
            [
                'name' => 'Wildlife Lodges',
                'icon' => 'fas fa-paw', // Font Awesome paw icon class
                'description' => 'Lodges near wildlife reserves, ideal for nature lovers and explorers.'
            ],
            [
                'name' => 'Luxury Desert Camps',
                'icon' => 'fas fa-sun', // Font Awesome sun icon class
                'description' => 'Luxury camps set in Ethiopia’s stunning desert landscapes.'
            ],
            [
                'name' => 'Urban Apartments',
                'icon' => 'fas fa-city', // Font Awesome city icon class
                'description' => 'Modern urban apartments in the heart of Ethiopia’s bustling cities.'
            ],
            [
                'name' => 'Remote Villages',
                'icon' => 'fas fa-map-marker-alt', // Font Awesome map marker icon class
                'description' => 'Experience the quiet beauty of remote Ethiopian villages.'
            ],
            [
                'name' => 'Riverfront Properties',
                'icon' => 'fas fa-water', // Font Awesome water icon class
                'description' => 'Properties with beautiful views of Ethiopia’s rivers and waterways.'
            ],
            [
                'name' => 'Lakeview Retreats',
                'icon' => 'fas fa-water', // Font Awesome water icon class
                'description' => 'Relax in peaceful retreats with stunning views of Ethiopia’s lakes.'
            ],
            [
                'name' => 'Mountain View Houses',
                'icon' => 'fas fa-mountain', // Font Awesome mountain icon class
                'description' => 'Accommodations offering breathtaking views of the Ethiopian highlands.'
            ],
            [
                'name' => 'Historical Monasteries',
                'icon' => 'fas fa-church', // Font Awesome church icon class
                'description' => 'Stay near or within Ethiopia’s ancient monasteries, rich in history and spirituality.'
            ],
            [
                'name' => 'Adventure & Hiking',
                'icon' => 'fas fa-hiking', // Font Awesome hiking icon class
                'description' => 'Accommodations perfect for adventure seekers and hiking enthusiasts.'
            ],
            [
                'name' => 'Cultural Heritage',
                'icon' => 'fas fa-landmark', // Font Awesome landmark icon class
                'description' => 'Stay near Ethiopia’s cultural heritage sites and museums.'
            ],
            [
                'name' => 'Luxury Escapes',
                'icon' => 'fas fa-spa', // Font Awesome spa icon class
                'description' => 'Luxury accommodations for a relaxing and indulgent experience.'
            ],
            [
                'name' => 'Wildlife Exploration',
                'icon' => 'fas fa-paw', // Font Awesome paw icon class
                'description' => 'Stay in lodges that offer opportunities for wildlife exploration and safaris.'
            ],
            [
                'name' => 'Religious Pilgrimage',
                'icon' => 'fas fa-church', // Font Awesome church icon class
                'description' => 'Accommodations near Ethiopia’s important religious pilgrimage sites.'
            ],
            [
                'name' => 'Family Getaways',
                'icon' => 'fas fa-users', // Font Awesome users icon class
                'description' => 'Family-friendly accommodations perfect for a relaxing family vacation.'
            ],
            [
                'name' => 'Romantic Retreats',
                'icon' => 'fas fa-heart', // Font Awesome heart icon class
                'description' => 'Romantic accommodations designed for couples seeking a getaway.'
            ],
            [
                'name' => 'Budget Stays',
                'icon' => 'fas fa-money-bill-alt', // Font Awesome money bill icon class
                'description' => 'Affordable accommodations for budget-conscious travelers.'
            ],
            [
                'name' => 'Volunteer Accommodations',
                'icon' => 'fas fa-hands-helping', // Font Awesome helping hands icon class
                'description' => 'Accommodations near volunteer opportunities for travelers wanting to give back.'
            ],
            [
                'name' => 'Industrial Stays',
                'icon' => 'fas fa-industry', // Font Awesome industry icon class
                'description' => 'Unique stays in industrial areas or old factories converted into living spaces.'
            ],
            [
                'name' => 'Scenic Views',
                'icon' => 'fas fa-eye', // Font Awesome eye icon class
                'description' => 'Properties boasting scenic views of Ethiopia’s beautiful landscapes.'
            ],
            [
                'name' => 'Wellness Retreats',
                'icon' => 'fas fa-leaf', // Font Awesome leaf icon class
                'description' => 'Accommodations focused on health and wellness, offering spa services and yoga.'
            ],
            [
                'name' => 'Heritage Experiences',
                'icon' => 'fas fa-flag', // Font Awesome flag icon class
                'description' => 'Unique stays that highlight the rich heritage of Ethiopian culture.'
            ],
            [
                'name' => 'Artistic Residencies',
                'icon' => 'fas fa-palette', // Font Awesome palette icon class
                'description' => 'Accommodations that provide an artistic and creative atmosphere.'
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
