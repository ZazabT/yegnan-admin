<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Addis Ababa Region
Location::create(['city' => 'Bole', 'region' => 'Addis Ababa', 'country' => 'Ethiopia']);
Location::create(['city' => 'Arada', 'region' => 'Addis Ababa', 'country' => 'Ethiopia']);
Location::create(['city' => 'Lideta', 'region' => 'Addis Ababa', 'country' => 'Ethiopia']);
Location::create(['city' => 'Kirkos', 'region' => 'Addis Ababa', 'country' => 'Ethiopia']);
Location::create(['city' => 'Kolfe Keranio', 'region' => 'Addis Ababa', 'country' => 'Ethiopia']);
Location::create(['city' => 'Gulele', 'region' => 'Addis Ababa', 'country' => 'Ethiopia']);
Location::create(['city' => 'Yeka', 'region' => 'Addis Ababa', 'country' => 'Ethiopia']);
Location::create(['city' => 'Addis Ketema', 'region' => 'Addis Ababa', 'country' => 'Ethiopia']);
Location::create(['city' => 'Akaky Kaliti', 'region' => 'Addis Ababa', 'country' => 'Ethiopia']);
Location::create(['city' => 'Nifas Silk-Lafto', 'region' => 'Addis Ababa', 'country' => 'Ethiopia']);
Location::create(['city' => 'Piyassa', 'region' => 'Addis Ababa', 'country' => 'Ethiopia']);
Location::create(['city' => 'Jemo', 'region' => 'Addis Ababa', 'country' => 'Ethiopia']);
Location::create(['city' => 'Bole Medhane Alem', 'region' => 'Addis Ababa', 'country' => 'Ethiopia']);
Location::create(['city' => 'Kera', 'region' => 'Addis Ababa', 'country' => 'Ethiopia']);
Location::create(['city' => 'Senga Tera', 'region' => 'Addis Ababa', 'country' => 'Ethiopia']);
Location::create(['city' => 'Megenagna', 'region' => 'Addis Ababa', 'country' => 'Ethiopia']);
Location::create(['city' => 'Mexico', 'region' => 'Addis Ababa', 'country' => 'Ethiopia']);
Location::create(['city' => 'Gergi', 'region' => 'Addis Ababa', 'country' => 'Ethiopia']);
Location::create(['city' => 'Kebena', 'region' => 'Addis Ababa', 'country' => 'Ethiopia']);
Location::create(['city' => 'Bole Arabsa', 'region' => 'Addis Ababa', 'country' => 'Ethiopia']);



// Oromia Region

Location::create(['city' => 'Adama (Nazret)', 'region' => 'Oromia', 'country' => 'Ethiopia']);
Location::create(['city' => 'Bishoftu (Debre Zeit)', 'region' => 'Oromia', 'country' => 'Ethiopia']);
Location::create(['city' => 'Jimma', 'region' => 'Oromia', 'country' => 'Ethiopia']);
Location::create(['city' => 'Dilla', 'region' => 'Oromia', 'country' => 'Ethiopia']);
Location::create(['city' => 'Bale Robe', 'region' => 'Oromia', 'country' => 'Ethiopia']);
// Location::create(['city' => 'Shashamene', 'region' => 'Oromia', 'country' => 'Ethiopia']);
Location::create(['city' => 'Ambo', 'region' => 'Oromia', 'country' => 'Ethiopia']);
Location::create(['city' => 'Gimbi', 'region' => 'Oromia', 'country' => 'Ethiopia']);
Location::create(['city' => 'Mettu', 'region' => 'Oromia', 'country' => 'Ethiopia']);
Location::create(['city' => 'Nekemte', 'region' => 'Oromia', 'country' => 'Ethiopia']);
Location::create(['city' => 'Bako', 'region' => 'Oromia', 'country' => 'Ethiopia']);
Location::create(['city' => 'Burayu', 'region' => 'Oromia', 'country' => 'Ethiopia']);
Location::create(['city' => 'Jijiga', 'region' => 'Oromia', 'country' => 'Ethiopia']);
Location::create(['city' => 'Woliso', 'region' => 'Oromia', 'country' => 'Ethiopia']);
Location::create(['city' => 'Chiro (Shewa)', 'region' => 'Oromia', 'country' => 'Ethiopia']);
Location::create(['city' => 'Kofele', 'region' => 'Oromia', 'country' => 'Ethiopia']);
Location::create(['city' => 'Robee', 'region' => 'Oromia', 'country' => 'Ethiopia']);
Location::create(['city' => 'Bishoftu', 'region' => 'Oromia', 'country' => 'Ethiopia']);
Location::create(['city' => 'Dembi Dolo', 'region' => 'Oromia', 'country' => 'Ethiopia']);
Location::create(['city' => 'Galo (Bale Zone)', 'region' => 'Oromia', 'country' => 'Ethiopia']);

        
// Amhara Region
Location::create(['city' => 'Bahir Dar', 'region' => 'Amhara', 'country' => 'Ethiopia']);
Location::create(['city' => 'Gondar', 'region' => 'Amhara', 'country' => 'Ethiopia']);
Location::create(['city' => 'Debre Markos', 'region' => 'Amhara', 'country' => 'Ethiopia']);
Location::create(['city' => 'Debre Birhan', 'region' => 'Amhara', 'country' => 'Ethiopia']);
Location::create(['city' => 'Woldiya', 'region' => 'Amhara', 'country' => 'Ethiopia']);
Location::create(['city' => 'Desse', 'region' => 'Amhara', 'country' => 'Ethiopia']);
Location::create(['city' => 'Gashena', 'region' => 'Amhara', 'country' => 'Ethiopia']);
Location::create(['city' => 'Mekele', 'region' => 'Amhara', 'country' => 'Ethiopia']);
Location::create(['city' => 'Fendika', 'region' => 'Amhara', 'country' => 'Ethiopia']);
Location::create(['city' => 'Dessie', 'region' => 'Amhara', 'country' => 'Ethiopia']);
Location::create(['city' => 'Lalibela', 'region' => 'Amhara', 'country' => 'Ethiopia']);
Location::create(['city' => 'Wag Himra', 'region' => 'Amhara', 'country' => 'Ethiopia']);
Location::create(['city' => 'Gondar Zuria', 'region' => 'Amhara', 'country' => 'Ethiopia']);
Location::create(['city' => 'Quara', 'region' => 'Amhara', 'country' => 'Ethiopia']);
Location::create(['city' => 'Addis Zemen', 'region' => 'Amhara', 'country' => 'Ethiopia']);
Location::create(['city' => 'Ebnat', 'region' => 'Amhara', 'country' => 'Ethiopia']);
Location::create(['city' => 'Kombolcha', 'region' => 'Amhara', 'country' => 'Ethiopia']);
Location::create(['city' => 'Bati', 'region' => 'Amhara', 'country' => 'Ethiopia']);
Location::create(['city' => 'Lasta', 'region' => 'Amhara', 'country' => 'Ethiopia']);
Location::create(['city' => 'Kalu', 'region' => 'Amhara', 'country' => 'Ethiopia']);
Location::create(['city' => 'Basona Worena', 'region' => 'Amhara', 'country' => 'Ethiopia']);
Location::create(['city' => 'Tach Gayint', 'region' => 'Amhara', 'country' => 'Ethiopia']);




// Tigray Region
Location::create(['city' => 'Mekele', 'region' => 'Tigray', 'country' => 'Ethiopia']);
Location::create(['city' => 'Adigrat', 'region' => 'Tigray', 'country' => 'Ethiopia']);
Location::create(['city' => 'Axum', 'region' => 'Tigray', 'country' => 'Ethiopia']);
Location::create(['city' => 'Shire', 'region' => 'Tigray', 'country' => 'Ethiopia']);
Location::create(['city' => 'Hawzen', 'region' => 'Tigray', 'country' => 'Ethiopia']);
Location::create(['city' => 'Alamata', 'region' => 'Tigray', 'country' => 'Ethiopia']);
Location::create(['city' => 'Adwa', 'region' => 'Tigray', 'country' => 'Ethiopia']);
Location::create(['city' => 'Tigray', 'region' => 'Tigray', 'country' => 'Ethiopia']);
Location::create(['city' => 'Enderta', 'region' => 'Tigray', 'country' => 'Ethiopia']);
Location::create(['city' => 'Dekele', 'region' => 'Tigray', 'country' => 'Ethiopia']);
Location::create(['city' => 'Kola Tembien', 'region' => 'Tigray', 'country' => 'Ethiopia']);
Location::create(['city' => 'Raya Azebo', 'region' => 'Tigray', 'country' => 'Ethiopia']);
Location::create(['city' => 'Ganta Afeshum', 'region' => 'Tigray', 'country' => 'Ethiopia']);
Location::create(['city' => 'Saho', 'region' => 'Tigray', 'country' => 'Ethiopia']);
Location::create(['city' => 'Gerhalo', 'region' => 'Tigray', 'country' => 'Ethiopia']);
Location::create(['city' => 'Irob', 'region' => 'Tigray', 'country' => 'Ethiopia']);

        
// SNNPR Region
Location::create(['city' => 'Hawassa', 'region' => 'SNNPR', 'country' => 'Ethiopia']);
Location::create(['city' => 'Arba Minch', 'region' => 'SNNPR', 'country' => 'Ethiopia']);
Location::create(['city' => 'Dilla', 'region' => 'SNNPR', 'country' => 'Ethiopia']);
Location::create(['city' => 'Wakiso', 'region' => 'SNNPR', 'country' => 'Ethiopia']);
Location::create(['city' => 'Jinka', 'region' => 'SNNPR', 'country' => 'Ethiopia']);
Location::create(['city' => 'Bonga', 'region' => 'SNNPR', 'country' => 'Ethiopia']);
Location::create(['city' => 'Jimma', 'region' => 'SNNPR', 'country' => 'Ethiopia']);
Location::create(['city' => 'Yirgalem', 'region' => 'SNNPR', 'country' => 'Ethiopia']);
Location::create(['city' => 'Wolaita Sodo', 'region' => 'SNNPR', 'country' => 'Ethiopia']);
Location::create(['city' => 'Mizan Teferi', 'region' => 'SNNPR', 'country' => 'Ethiopia']);
Location::create(['city' => 'Kembata Tembaro', 'region' => 'SNNPR', 'country' => 'Ethiopia']);
Location::create(['city' => 'Boditi', 'region' => 'SNNPR', 'country' => 'Ethiopia']);
Location::create(['city' => 'Sodo', 'region' => 'SNNPR', 'country' => 'Ethiopia']);
Location::create(['city' => 'Lega Tafo', 'region' => 'SNNPR', 'country' => 'Ethiopia']);
Location::create(['city' => 'Dawro', 'region' => 'SNNPR', 'country' => 'Ethiopia']);
Location::create(['city' => 'Benchi Maji', 'region' => 'SNNPR', 'country' => 'Ethiopia']);
Location::create(['city' => 'Sheka', 'region' => 'SNNPR', 'country' => 'Ethiopia']);
Location::create(['city' => 'Gamo Gofa', 'region' => 'SNNPR', 'country' => 'Ethiopia']);
Location::create(['city' => 'Sidama', 'region' => 'SNNPR', 'country' => 'Ethiopia']);
Location::create(['city' => 'Gedeo', 'region' => 'SNNPR', 'country' => 'Ethiopia']);

        
        // Gambela Region
Location::create(['city' => 'Gambela', 'region' => 'Gambela', 'country' => 'Ethiopia']);
Location::create(['city' => 'Abobo', 'region' => 'Gambela', 'country' => 'Ethiopia']);
Location::create(['city' => 'Gambela Town', 'region' => 'Gambela', 'country' => 'Ethiopia']);
Location::create(['city' => 'Itang', 'region' => 'Gambela', 'country' => 'Ethiopia']);
Location::create(['city' => 'Nuer', 'region' => 'Gambela', 'country' => 'Ethiopia']);
        
        // Benishangul-Gumuz Region
Location::create(['city' => 'Assosa', 'region' => 'Benishangul-Gumuz', 'country' => 'Ethiopia']);
Location::create(['city' => 'Mankush', 'region' => 'Benishangul-Gumuz', 'country' => 'Ethiopia']);
        
        // Dire Dawa Region
Location::create(['city' => 'Dire Dawa', 'region' => 'Dire Dawa', 'country' => 'Ethiopia']);
        
        // Harari Region
Location::create(['city' => 'Harar', 'region' => 'Harari', 'country' => 'Ethiopia']);
    }
}
