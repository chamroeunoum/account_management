<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;

class KuntiesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('kunties')->delete();
        
        \DB::table('kunties')->insert(array (
            0 => 
            array (
                'id' => 1,
                'number' => 'គន្ថីទី ១ ',
                'title' => 'បទប្បញ្ញត្ដិទូទៅ ',
                'regulator_id' => 1,
                'created_by' => 0,
                'updated_by' => 0,
                'created_at' => '2015-06-16 00:00:00',
                'updated_at' => '2015-06-16 00:00:00',
            ),
            1 => 
            array (
                'id' => 2,
                'number' => 'គន្ថីទី ២ ',
                'title' => 'បុគ្គល ',
                'regulator_id' => 1,
                'created_by' => 0,
                'updated_by' => 0,
                'created_at' => '2015-06-16 00:00:00',
                'updated_at' => '2015-06-16 00:00:00',
            ),
            2 => 
            array (
                'id' => 3,
                'number' => 'គន្ថីទី ៣ ',
                'title' => 'សិទ្ធិប្រត្យក្ស ',
                'regulator_id' => 1,
                'created_by' => 0,
                'updated_by' => 0,
                'created_at' => '2015-06-16 00:00:00',
                'updated_at' => '2015-06-16 00:00:00',
            ),
            3 => 
            array (
                'id' => 4,
                'number' => 'គន្ថីទី ៤ ',
                'title' => 'កាតព្វកិច្ច ',
                'regulator_id' => 1,
                'created_by' => 0,
                'updated_by' => 0,
                'created_at' => '2015-06-16 00:00:00',
                'updated_at' => '2015-06-16 00:00:00',
            ),
            4 => 
            array (
                'id' => 5,
                'number' => 'គន្ថីទី ៥ ',
                'title' => 'កិច្ចសន្យាសំខាន់ៗ និង អំពើអនីត្យានុកូល ',
                'regulator_id' => 1,
                'created_by' => 0,
                'updated_by' => 0,
                'created_at' => '2015-06-16 00:00:00',
                'updated_at' => '2015-06-16 00:00:00',
            ),
            5 => 
            array (
                'id' => 6,
                'number' => 'គន្ថីទី ៦ ',
                'title' => 'ការធានាកាតព្វកិច្ច ',
                'regulator_id' => 1,
                'created_by' => 0,
                'updated_by' => 0,
                'created_at' => '2015-06-16 00:00:00',
                'updated_at' => '2015-06-16 00:00:00',
            ),
            6 => 
            array (
                'id' => 7,
                'number' => 'គន្ថីទី ៧ ',
                'title' => 'ញាតិ ',
                'regulator_id' => 1,
                'created_by' => 0,
                'updated_by' => 0,
                'created_at' => '2015-06-16 00:00:00',
                'updated_at' => '2015-06-16 00:00:00',
            ),
            7 => 
            array (
                'id' => 8,
                'number' => 'គន្ថីទី ៨ ',
                'title' => 'សន្ដតិកម្ម ',
                'regulator_id' => 1,
                'created_by' => 0,
                'updated_by' => 0,
                'created_at' => '2015-06-16 00:00:00',
                'updated_at' => '2015-06-16 00:00:00',
            ),
            8 => 
            array (
                'id' => 9,
                'number' => 'គន្ថីទី ៩',
                'title' => 'អវសានប្បញ្ញត្តិ',
                'regulator_id' => 1,
                'created_by' => 0,
                'updated_by' => 0,
                'created_at' => '2015-06-16 00:00:00',
                'updated_at' => '2015-06-16 00:00:00',
            ),
            9 => 
            array (
                'id' => 10,
                'number' => 'គន្ថីទី ១ ',
                'title' => 'បទប្បញ្ញត្ដិទូទៅ ',
                'regulator_id' => 2,
                'created_by' => 0,
                'updated_by' => 0,
                'created_at' => '2015-06-16 00:00:00',
                'updated_at' => '2015-06-16 00:00:00',
            ),
            10 => 
            array (
                'id' => 11,
                'number' => 'គន្ថីទី ២ ',
                'title' => 'នីតិវិធីនៃការជម្រះក្ដីលើកទី ១ ',
                'regulator_id' => 2,
                'created_by' => 0,
                'updated_by' => 0,
                'created_at' => '2015-06-16 00:00:00',
                'updated_at' => '2015-06-16 00:00:00',
            ),
            11 => 
            array (
                'id' => 12,
                'number' => 'គន្ថីទី ៣ ',
                'title' => 'បណ្ដឹងឧបាស្រ័យទៅតុលាការជាន់ខ្ពស់ ',
                'regulator_id' => 2,
                'created_by' => 0,
                'updated_by' => 0,
                'created_at' => '2015-06-16 00:00:00',
                'updated_at' => '2015-06-16 00:00:00',
            ),
            12 => 
            array (
                'id' => 13,
                'number' => 'គន្ថីទី ៤ ',
                'title' => 'ការជំនុំជម្រះសាជាថ្មី ',
                'regulator_id' => 2,
                'created_by' => 0,
                'updated_by' => 0,
                'created_at' => '2015-06-16 00:00:00',
                'updated_at' => '2015-06-16 00:00:00',
            ),
            13 => 
            array (
                'id' => 14,
                'number' => 'គន្ថីទី ៥ ',
                'title' => 'នីតិវិធីដាស់តឿន ',
                'regulator_id' => 2,
                'created_by' => 0,
                'updated_by' => 0,
                'created_at' => '2015-06-16 00:00:00',
                'updated_at' => '2015-06-16 00:00:00',
            ),
            14 => 
            array (
                'id' => 15,
                'number' => 'គន្ថីទី ៦ ',
                'title' => 'ការអនុវត្ដដោយបង្ខំ ',
                'regulator_id' => 2,
                'created_by' => 0,
                'updated_by' => 0,
                'created_at' => '2015-06-16 00:00:00',
                'updated_at' => '2015-06-16 00:00:00',
            ),
            15 => 
            array (
                'id' => 16,
                'number' => 'គន្ថីទី ៧ ',
                'title' => 'ការចាត់ចែងរក្សាការពារ ',
                'regulator_id' => 2,
                'created_by' => 0,
                'updated_by' => 0,
                'created_at' => '2015-06-16 00:00:00',
                'updated_at' => '2015-06-16 00:00:00',
            ),
            16 => 
            array (
                'id' => 17,
                'number' => 'គន្ថីទី ៨ ',
                'title' => 'អន្ដរប្បញ្ញត្ដិ ',
                'regulator_id' => 2,
                'created_by' => 0,
                'updated_by' => 0,
                'created_at' => '2015-06-16 00:00:00',
                'updated_at' => '2015-06-16 00:00:00',
            ),
            17 => 
            array (
                'id' => 18,
                'number' => 'គន្ថីទី ៩',
                'title' => 'អវសានប្បញ្ញត្តិ',
                'regulator_id' => 2,
                'created_by' => 0,
                'updated_by' => 0,
                'created_at' => '2015-06-16 00:00:00',
                'updated_at' => '2015-06-16 00:00:00',
            ),
            18 => 
            array (
                'id' => 19,
                'number' => 'គន្ថីទី ១ ',
                'title' => 'បទប្បញ្ញត្ដិទូទៅ ',
                'regulator_id' => 3,
                'created_by' => 0,
                'updated_by' => 0,
                'created_at' => '2015-06-16 00:00:00',
                'updated_at' => '2015-06-16 00:00:00',
            ),
            19 => 
            array (
                'id' => 20,
                'number' => 'គន្ថីទី ២ ',
                'title' => 'បទល្មើសប្រឆាំងនឹងបុគ្គល ',
                'regulator_id' => 3,
                'created_by' => 0,
                'updated_by' => 0,
                'created_at' => '2015-06-16 00:00:00',
                'updated_at' => '2015-06-16 00:00:00',
            ),
            20 => 
            array (
                'id' => 21,
                'number' => 'គន្ថីទី ៣ ',
                'title' => 'បទល្មើសប្រឆាំងនឹងទ្រព្យសម្បត្ដិ ',
                'regulator_id' => 3,
                'created_by' => 0,
                'updated_by' => 0,
                'created_at' => '2015-06-16 00:00:00',
                'updated_at' => '2015-06-16 00:00:00',
            ),
            21 => 
            array (
                'id' => 22,
                'number' => 'គន្ថីទី ៤ ',
                'title' => 'បទល្មើសប្រឆាំងនឹងជាតិ ',
                'regulator_id' => 3,
                'created_by' => 0,
                'updated_by' => 0,
                'created_at' => '2015-06-16 00:00:00',
                'updated_at' => '2015-06-16 00:00:00',
            ),
            22 => 
            array (
                'id' => 23,
                'number' => 'គន្ថីទី ៥ ',
                'title' => 'អន្ដរប្បញ្ញត្ដិ ',
                'regulator_id' => 3,
                'created_by' => 0,
                'updated_by' => 0,
                'created_at' => '2015-06-16 00:00:00',
                'updated_at' => '2015-06-16 00:00:00',
            ),
            23 => 
            array (
                'id' => 24,
                'number' => 'គន្ថីទី ៦ ',
                'title' => 'អវសានប្បញ្ញត្ដិ ',
                'regulator_id' => 3,
                'created_by' => 0,
                'updated_by' => 0,
                'created_at' => '2015-06-16 00:00:00',
                'updated_at' => '2015-06-16 00:00:00',
            ),
            24 => 
            array (
                'id' => 25,
                'number' => 'គន្ថីទី ១ ',
                'title' => 'បណ្ដឹងអាជ្ញា និងបណ្ដឹងរដ្ឋប្បវេណី ',
                'regulator_id' => 4,
                'created_by' => 0,
                'updated_by' => 0,
                'created_at' => '2015-06-16 00:00:00',
                'updated_at' => '2015-06-16 00:00:00',
            ),
            25 => 
            array (
                'id' => 26,
                'number' => 'គន្ថីទី ២ ',
                'title' => 'អាជ្ញាធរទទួលបន្ទុកចោទប្រកាន់ ស៊ើបសួរ និងស៊ើបអង្កេត ',
                'regulator_id' => 4,
                'created_by' => 0,
                'updated_by' => 0,
                'created_at' => '2015-06-16 00:00:00',
                'updated_at' => '2015-06-16 00:00:00',
            ),
            26 => 
            array (
                'id' => 27,
                'number' => 'គន្ថីទី ៣ ',
                'title' => 'ការស៊ើបអង្កេត ',
                'regulator_id' => 4,
                'created_by' => 0,
                'updated_by' => 0,
                'created_at' => '2015-06-16 00:00:00',
                'updated_at' => '2015-06-16 00:00:00',
            ),
            27 => 
            array (
                'id' => 28,
                'number' => 'គន្ថីទី ៤ ',
                'title' => 'ការស៊ើបសួរ ',
                'regulator_id' => 4,
                'created_by' => 0,
                'updated_by' => 0,
                'created_at' => '2015-06-16 00:00:00',
                'updated_at' => '2015-06-16 00:00:00',
            ),
            28 => 
            array (
                'id' => 29,
                'number' => 'គន្ថីទី ៥ ',
                'title' => 'អំពីសាលក្រម ',
                'regulator_id' => 4,
                'created_by' => 0,
                'updated_by' => 0,
                'created_at' => '2015-06-16 00:00:00',
                'updated_at' => '2015-06-16 00:00:00',
            ),
            29 => 
            array (
                'id' => 30,
                'number' => 'គន្ថីទី ៧',
                'title' => 'គន្ថីទី ៧ នៃក្រមនេះ ។ លិខិតចម្លងនៃដីកាបញ្ជូនរបស់ចៅក្រមស៊ើបសួរ ឬនៃសាលដីកាបញ្ជូន របស់សភាស៊ើបសួរ ត្រូវភ្ជាប់ជាមួយនឹងដីកាកោះហៅនេះ ដើម្បីប្រគល់ឲ្យដល់ជនជាប់ចោទ ។ ',
                'regulator_id' => 4,
                'created_by' => 0,
                'updated_by' => 0,
                'created_at' => '2015-06-16 00:00:00',
                'updated_at' => '2015-06-16 00:00:00',
            ),
            30 => 
            array (
                'id' => 31,
                'number' => 'គន្ថីទី ៦ ',
                'title' => 'តុលាការកំពូល ',
                'regulator_id' => 4,
                'created_by' => 0,
                'updated_by' => 0,
                'created_at' => '2015-06-16 00:00:00',
                'updated_at' => '2015-06-16 00:00:00',
            ),
            31 => 
            array (
                'id' => 32,
                'number' => 'គន្ថីទី ៧ ',
                'title' => 'ដីកាកោះហៅបញ្ជូនទៅជំនុំជម្រះផ្ទាល់ ដីកាកោះហៅ និងដីកាជូនដំណឹង ',
                'regulator_id' => 4,
                'created_by' => 0,
                'updated_by' => 0,
                'created_at' => '2015-06-16 00:00:00',
                'updated_at' => '2015-06-16 00:00:00',
            ),
            32 => 
            array (
                'id' => 33,
                'number' => 'គន្ថីទី ៨ ',
                'title' => 'នីតិវិធីប្រតិបត្ដិ ',
                'regulator_id' => 4,
                'created_by' => 0,
                'updated_by' => 0,
                'created_at' => '2015-06-16 00:00:00',
                'updated_at' => '2015-06-16 00:00:00',
            ),
            33 => 
            array (
                'id' => 34,
                'number' => 'គន្ថីទី ៩ ',
                'title' => 'នីតិវិធីដោយឡែក ',
                'regulator_id' => 4,
                'created_by' => 0,
                'updated_by' => 0,
                'created_at' => '2015-06-16 00:00:00',
                'updated_at' => '2015-06-16 00:00:00',
            ),
            34 => 
            array (
                'id' => 35,
                'number' => 'គន្ថីទី ១០ ',
                'title' => 'អន្ដរប្បញ្ញត្ដិ ',
                'regulator_id' => 4,
                'created_by' => 0,
                'updated_by' => 0,
                'created_at' => '2015-06-16 00:00:00',
                'updated_at' => '2015-06-16 00:00:00',
            ),
            35 => 
            array (
                'id' => 36,
                'number' => 'គន្ថីទី ១១ ',
                'title' => 'អវសានប្បញ្ញត្ដិ ',
                'regulator_id' => 4,
                'created_by' => 0,
                'updated_by' => 0,
                'created_at' => '2015-06-16 00:00:00',
                'updated_at' => '2015-06-16 00:00:00',
            ),
        ));
        
        
    }
}