<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $districts = [
            ['id' => 1, 'division_id' => 1, 'name' => 'Comilla', 'bn_name' => 'কুমিল্লা', 'url' => 'www.comilla.gov.bd'],
            ['id' => 2, 'division_id' => 1, 'name' => 'Feni', 'bn_name' => 'ফেনী', 'url' => 'www.feni.gov.bd'],
            ['id' => 3, 'division_id' => 1, 'name' => 'Brahmanbaria', 'bn_name' => 'ব্রাহ্মণবাড়িয়া', 'url' => 'www.brahmanbaria.gov.bd'],
            ['id' => 4, 'division_id' => 1, 'name' => 'Rangamati', 'bn_name' => 'রাঙ্গামাটি', 'url' => 'www.rangamati.gov.bd'],
            ['id' => 5, 'division_id' => 1, 'name' => 'Noakhali', 'bn_name' => 'নোয়াখালী', 'url' => 'www.noakhali.gov.bd'],
            ['id' => 6, 'division_id' => 1, 'name' => 'Chandpur', 'bn_name' => 'চাঁদপুর', 'url' => 'www.chandpur.gov.bd'],
            ['id' => 7, 'division_id' => 1, 'name' => 'Lakshmipur', 'bn_name' => 'লক্ষ্মীপুর', 'url' => 'www.lakshmipur.gov.bd'],
            ['id' => 8, 'division_id' => 1, 'name' => 'Chattogram', 'bn_name' => 'চট্টগ্রাম', 'url' => 'www.chittagong.gov.bd'],
            ['id' => 9, 'division_id' => 1, 'name' => 'Coxsbazar', 'bn_name' => 'কক্সবাজার', 'url' => 'www.coxsbazar.gov.bd'],
            ['id' => 10, 'division_id' => 1, 'name' => 'Khagrachhari', 'bn_name' => 'খাগড়াছড়ি', 'url' => 'www.khagrachhari.gov.bd'],
            ['id' => 11, 'division_id' => 1, 'name' => 'Bandarban', 'bn_name' => 'বান্দরবান', 'url' => 'www.bandarban.gov.bd'],
            ['id' => 12, 'division_id' => 2, 'name' => 'Sirajganj', 'bn_name' => 'সিরাজগঞ্জ', 'url' => 'www.sirajganj.gov.bd'],
            ['id' => 13, 'division_id' => 2, 'name' => 'Pabna', 'bn_name' => 'পাবনা', 'url' => 'www.pabna.gov.bd'],
            ['id' => 14, 'division_id' => 2, 'name' => 'Bogura', 'bn_name' => 'বগুড়া', 'url' => 'www.bogra.gov.bd'],
            ['id' => 15, 'division_id' => 2, 'name' => 'Rajshahi', 'bn_name' => 'রাজশাহী', 'url' => 'www.rajshahi.gov.bd'],
            ['id' => 16, 'division_id' => 2, 'name' => 'Natore', 'bn_name' => 'নাটোর', 'url' => 'www.natore.gov.bd'],
            ['id' => 17, 'division_id' => 2, 'name' => 'Joypurhat', 'bn_name' => 'জয়পুরহাট', 'url' => 'www.joypurhat.gov.bd'],
            ['id' => 18, 'division_id' => 2, 'name' => 'Chapainawabganj', 'bn_name' => 'চাঁপাইনবাবগঞ্জ', 'url' => 'www.chapainawabganj.gov.bd'],
            ['id' => 19, 'division_id' => 2, 'name' => 'Naogaon', 'bn_name' => 'নওগাঁ', 'url' => 'www.naogaon.gov.bd'],
            ['id' => 20, 'division_id' => 3, 'name' => 'Jashore', 'bn_name' => 'যশোর', 'url' => 'www.jessore.gov.bd'],
            ['id' => 21, 'division_id' => 3, 'name' => 'Satkhira', 'bn_name' => 'সাতক্ষীরা', 'url' => 'www.satkhira.gov.bd'],
            ['id' => 22, 'division_id' => 3, 'name' => 'Meherpur', 'bn_name' => 'মেহেরপুর', 'url' => 'www.meherpur.gov.bd'],
            ['id' => 23, 'division_id' => 3, 'name' => 'Narail', 'bn_name' => 'নড়াইল', 'url' => 'www.narail.gov.bd'],
            ['id' => 24, 'division_id' => 3, 'name' => 'Chuadanga', 'bn_name' => 'চুয়াডাঙ্গা', 'url' => 'www.chuadanga.gov.bd'],
            ['id' => 25, 'division_id' => 3, 'name' => 'Kushtia', 'bn_name' => 'কুষ্টিয়া', 'url' => 'www.kushtia.gov.bd'],
            ['id' => 26, 'division_id' => 3, 'name' => 'Magura', 'bn_name' => 'মাগুরা', 'url' => 'www.magura.gov.bd'],
            ['id' => 27, 'division_id' => 3, 'name' => 'Khulna', 'bn_name' => 'খুলনা', 'url' => 'www.khulna.gov.bd'],
            ['id' => 28, 'division_id' => 3, 'name' => 'Bagerhat', 'bn_name' => 'বাগেরহাট', 'url' => 'www.bagerhat.gov.bd'],
            ['id' => 29, 'division_id' => 3, 'name' => 'Jhenaidah', 'bn_name' => 'ঝিনাইদহ', 'url' => 'www.jhenaidah.gov.bd'],
            ['id' => 30, 'division_id' => 4, 'name' => 'Jhalakathi', 'bn_name' => 'ঝালকাঠি', 'url' => 'www.jhalakathi.gov.bd'],
            ['id' => 31, 'division_id' => 4, 'name' => 'Patuakhali', 'bn_name' => 'পটুয়াখালী', 'url' => 'www.patuakhali.gov.bd'],
            ['id' => 32, 'division_id' => 4, 'name' => 'Pirojpur', 'bn_name' => 'পিরোজপুর', 'url' => 'www.pirojpur.gov.bd'],
            ['id' => 33, 'division_id' => 4, 'name' => 'Barisal', 'bn_name' => 'বরিশাল', 'url' => 'www.barisal.gov.bd'],
            ['id' => 34, 'division_id' => 4, 'name' => 'Bhola', 'bn_name' => 'ভোলা', 'url' => 'www.bhola.gov.bd'],
            ['id' => 35, 'division_id' => 4, 'name' => 'Barguna', 'bn_name' => 'বরগুনা', 'url' => 'www.barguna.gov.bd'],
            ['id' => 36, 'division_id' => 5, 'name' => 'Sylhet', 'bn_name' => 'সিলেট', 'url' => 'www.sylhet.gov.bd'],
            ['id' => 37, 'division_id' => 5, 'name' => 'Moulvibazar', 'bn_name' => 'মৌলভীবাজার', 'url' => 'www.moulvibazar.gov.bd'],
            ['id' => 38, 'division_id' => 5, 'name' => 'Habiganj', 'bn_name' => 'হবিগঞ্জ', 'url' => 'www.habiganj.gov.bd'],
            ['id' => 39, 'division_id' => 5, 'name' => 'Sunamganj', 'bn_name' => 'সুনামগঞ্জ', 'url' => 'www.sunamganj.gov.bd'],
            ['id' => 40, 'division_id' => 6, 'name' => 'Narsingdi', 'bn_name' => 'নরসিংদী', 'url' => 'www.narsingdi.gov.bd'],
            ['id' => 41, 'division_id' => 6, 'name' => 'Gazipur', 'bn_name' => 'গাজীপুর', 'url' => 'www.gazipur.gov.bd'],
            ['id' => 42, 'division_id' => 6, 'name' => 'Shariatpur', 'bn_name' => 'শরীয়তপুর', 'url' => 'www.shariatpur.gov.bd'],
            ['id' => 43, 'division_id' => 6, 'name' => 'Narayanganj', 'bn_name' => 'নারায়ণগঞ্জ', 'url' => 'www.narayanganj.gov.bd'],
            ['id' => 44, 'division_id' => 6, 'name' => 'Tangail', 'bn_name' => 'টাঙ্গাইল', 'url' => 'www.tangail.gov.bd'],
            ['id' => 45, 'division_id' => 6, 'name' => 'Kishoreganj', 'bn_name' => 'কিশোরগঞ্জ', 'url' => 'www.kishoreganj.gov.bd'],
            ['id' => 46, 'division_id' => 6, 'name' => 'Manikganj', 'bn_name' => 'মানিকগঞ্জ', 'url' => 'www.manikganj.gov.bd'],
            ['id' => 47, 'division_id' => 6, 'name' => 'Dhaka', 'bn_name' => 'ঢাকা', 'url' => 'www.dhaka.gov.bd'],
            ['id' => 48, 'division_id' => 6, 'name' => 'Munshiganj', 'bn_name' => 'মুন্সিগঞ্জ', 'url' => 'www.munshiganj.gov.bd'],
            ['id' => 49, 'division_id' => 6, 'name' => 'Rajbari', 'bn_name' => 'রাজবাড়ী', 'url' => 'www.rajbari.gov.bd'],
            ['id' => 50, 'division_id' => 6, 'name' => 'Madaripur', 'bn_name' => 'মাদারীপুর', 'url' => 'www.madaripur.gov.bd'],
            ['id' => 51, 'division_id' => 6, 'name' => 'Gopalganj', 'bn_name' => 'গোপালগঞ্জ', 'url' => 'www.gopalganj.gov.bd'],
            ['id' => 52, 'division_id' => 6, 'name' => 'Faridpur', 'bn_name' => 'ফরিদপুর', 'url' => 'www.faridpur.gov.bd'],
            ['id' => 53, 'division_id' => 7, 'name' => 'Panchagarh', 'bn_name' => 'পঞ্চগড়', 'url' => 'www.panchagarh.gov.bd'],
            ['id' => 54, 'division_id' => 7, 'name' => 'Dinajpur', 'bn_name' => 'দিনাজপুর', 'url' => 'www.dinajpur.gov.bd'],
            ['id' => 55, 'division_id' => 7, 'name' => 'Lalmonirhat', 'bn_name' => 'লালমনিরহাট', 'url' => 'www.lalmonirhat.gov.bd'],
            ['id' => 56, 'division_id' => 7, 'name' => 'Nilphamari', 'bn_name' => 'নীলফামারী', 'url' => 'www.nilphamari.gov.bd'],
            ['id' => 57, 'division_id' => 7, 'name' => 'Gaibandha', 'bn_name' => 'গাইবান্ধা', 'url' => 'www.gaibandha.gov.bd'],
            ['id' => 58, 'division_id' => 7, 'name' => 'Thakurgaon', 'bn_name' => 'ঠাকুরগাঁও', 'url' => 'www.thakurgaon.gov.bd'],
            ['id' => 59, 'division_id' => 7, 'name' => 'Rangpur', 'bn_name' => 'রংপুর', 'url' => 'www.rangpur.gov.bd'],
            ['id' => 60, 'division_id' => 7, 'name' => 'Kurigram', 'bn_name' => 'কুড়িগ্রাম', 'url' => 'www.kurigram.gov.bd'],
            ['id' => 61, 'division_id' => 8, 'name' => 'Sherpur', 'bn_name' => 'শেরপুর', 'url' => 'www.sherpur.gov.bd'],
            ['id' => 62, 'division_id' => 8, 'name' => 'Mymensingh', 'bn_name' => 'ময়মনসিংহ', 'url' => 'www.mymensingh.gov.bd'],
            ['id' => 63, 'division_id' => 8, 'name' => 'Jamalpur', 'bn_name' => 'জামালপুর', 'url' => 'www.jamalpur.gov.bd'],
            ['id' => 64, 'division_id' => 8, 'name' => 'Netrokona', 'bn_name' => 'নেত্রকোণা', 'url' => 'www.netrokona.gov.bd'],
        ];

        foreach ($districts as $district) {
            DB::table('districts')->updateOrInsert(
                ['id' => $district['id']],
                [
                    'division_id' => $district['division_id'],
                    'name' => $district['name'],
                    'bn_name' => $district['bn_name'],
                    'url' => $district['url'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
