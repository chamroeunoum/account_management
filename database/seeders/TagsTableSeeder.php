<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tags')->delete();
        
        \DB::table('tags')->insert(array (
            0 => 
            array (
                'id' => 2,
                'name' => 'ទីស្តីការគណៈរដ្ឋមន្ត្រី',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 3,
                'name' => 'ក្រសួង មហាផ្ទៃ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 4,
                'name' => 'ក្រសួង គមនាគមន៏',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 5,
                'name' => 'ក្រសួង ពាណិជ្ជកម្ម',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 6,
                'name' => 'ក្រសួង​ កសិកម្ម​ ​​រុក្ខាប្រមាញ់​និងនេសាទ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 7,
                'name' => 'ក្រសួង ព័ត៌មាន',
                'created_at' => NULL,
                'updated_at' => '2018-04-04 15:37:20',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 8,
                'name' => 'ក្រសួង អភិវឌ្ឍន៏ជនបទ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 9,
                'name' => 'ក្រសួង ទេសចរណ៍',
                'created_at' => NULL,
                'updated_at' => '2018-06-15 15:21:02',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 10,
                'name' => 'ក្រសួង ការពារជាតិ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 11,
                'name' => 'ក្រសួង បរិស្ថាន',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 12,
                'name' => 'ក្រសួង អប់រំយុវជន​និងកីឡា',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 13,
                'name' => 'ក្រសួង ការបរទេស និងសហប្រតិបត្តិការអន្តរជាតិ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 15,
                'name' => 'រដ្ឋលេខាធិការដ្ឋានអាកាសចរណ៏ស៊ីវីល',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 16,
                'name' => 'សមាគម កាកបាទក្រហមកម្ពុជា',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 17,
                'name' => 'ក្រុមហ៊ុន អគ្គីសនីកម្ពុជា',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            15 => 
            array (
                'id' => 18,
                'name' => 'គ្រប់​ បណ្តា អង្គការ-សមាគម ស្រុក និងក្រៅប្រទេស',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            16 => 
            array (
                'id' => 19,
                'name' => 'អាជ្ញាធរជាតិ ទទួលបន្ទុកកិច្ចការ ICT',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            17 => 
            array (
                'id' => 20,
                'name' => 'អាជ្ញាធរ អប្សារា',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            18 => 
            array (
                'id' => 21,
                'name' => 'អាជ្ញាធរ មីន',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            19 => 
            array (
                'id' => 22,
                'name' => 'អាជ្ញាធរ ទេសចរណ៍',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            20 => 
            array (
                'id' => 23,
                'name' => 'អាជ្ញាធរ សវនកម្មជាតិ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            21 => 
            array (
                'id' => 24,
                'name' => 'អាជ្ញាធរជាតិប្រយុទ្ធនឹងជំងឺអេដស៍',
                'created_at' => NULL,
                'updated_at' => '2018-04-25 09:34:09',
                'deleted_at' => NULL,
            ),
            22 => 
            array (
                'id' => 25,
                'name' => 'អាជ្ញាធរ ព្រំដែន',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            23 => 
            array (
                'id' => 26,
                'name' => 'អាជ្ញាធរ ប្រឆាំងគ្រឿងញៀន',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            24 => 
            array (
                'id' => 27,
                'name' => 'ធនាគារជាតិ កម្ពុជា',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            25 => 
            array (
                'id' => 28,
                'name' => 'ធនាគារ អភិវឌ្ឍន៍ជនបទ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            26 => 
            array (
                'id' => 29,
                'name' => 'រដ្ឋលេខាធិការ មុខងារសាធារណៈ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            27 => 
            array (
                'id' => 30,
                'name' => 'រាជបណ្ឌិតសភា កម្ពុជា',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            28 => 
            array (
                'id' => 31,
                'name' => 'សាលា ភូមិន្ទរដ្ឋបាល',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            29 => 
            array (
                'id' => 32,
                'name' => 'ស្ថានទូត',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            30 => 
            array (
                'id' => 33,
                'name' => 'គ្រប់បណ្តា ខេត្ត-ក្រុង នៅទូទាំងប្រទេស',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            31 => 
            array (
                'id' => 34,
                'name' => 'ក្រសួង សេដ្ឋកិច្ច និងហិរញ្ញវត្ថុ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            32 => 
            array (
                'id' => 35,
                'name' => 'ក្រសួង​ វប្បធម៌ និងវិចិត្រសិល្បៈ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            33 => 
            array (
                'id' => 36,
                'name' => 'ក្រសួង សុខាភិបាល',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            34 => 
            array (
                'id' => 37,
                'name' => 'ក្រសួង ឧស្សាហកម្ម រ៉ែ និងថាមពល',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            35 => 
            array (
                'id' => 38,
                'name' => 'ក្រសួង​ យុត្តិធម៌',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            36 => 
            array (
                'id' => 39,
                'name' => 'ក្រសួង ការងារ និងបណ្តុះបណ្តាលវិជ្ជាជីវៈ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            37 => 
            array (
                'id' => 40,
                'name' => 'ក្រសួង រៀបចំដែនដី នគរូបនីយកម្ម និងសំណង់',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            38 => 
            array (
                'id' => 41,
                'name' => 'ក្រសួង ទំនាក់ទំនងសភា ព្រឹទ្ធសភា និងអធិការកិច្ច',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            39 => 
            array (
                'id' => 42,
                'name' => 'ក្រសួង ផែនការ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            40 => 
            array (
                'id' => 43,
                'name' => 'ក្រសួង ប្រៃណីយ៍ និងទូរគមនាគមន៍',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            41 => 
            array (
                'id' => 44,
                'name' => 'ក្រសួង សាធារណៈការ និងដឹកជញ្ជូន',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            42 => 
            array (
                'id' => 45,
                'name' => 'ក្រសួង ធម្មការ និងកិច្ចការសាសនា',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            43 => 
            array (
                'id' => 46,
                'name' => 'ក្រសួង សង្គមកិច្ច អតីតយុទ្ធជន និងយុវនីតិសម្បទា',
                'created_at' => NULL,
                'updated_at' => '2018-08-20 14:29:07',
                'deleted_at' => NULL,
            ),
            44 => 
            array (
                'id' => 47,
                'name' => 'ក្រសួង ធនធានទឹក និងឧតុនិយម',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            45 => 
            array (
                'id' => 48,
                'name' => 'ក្រសួង កិច្ចការនារី',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            46 => 
            array (
                'id' => 49,
                'name' => 'ក្រសួង ព្រះបរមរាជវាំង',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            47 => 
            array (
                'id' => 50,
                'name' => 'គ្រប់បណ្តា ក្រសួង-ស្ថាបន័ ពាក់ព័ន្ធ',
                'created_at' => NULL,
                'updated_at' => '2018-04-09 09:47:44',
                'deleted_at' => NULL,
            ),
            48 => 
            array (
                'id' => 51,
                'name' => 'ក្រុមប្រឹក្សាជាតិ ដើម្បីកុមារ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            49 => 
            array (
                'id' => 52,
                'name' => 'ក្រុមប្រឹក្សា អភិវឌ្ឍន៍កម្ពុជា',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            50 => 
            array (
                'id' => 53,
                'name' => 'ក្រុមប្រឹក្សាកំណែរទម្រង់រដ្ឋបាល',
                'created_at' => NULL,
                'updated_at' => '2019-03-25 11:54:09',
                'deleted_at' => NULL,
            ),
            51 => 
            array (
                'id' => 54,
                'name' => 'ក្រុមប្រឹក្សា អ្នកច្បាប់',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            52 => 
            array (
                'id' => 55,
                'name' => 'ក្រុមប្រឹក្សា ស្តារ អភិវឌ្ឍន៍វិស័យកសិកម្ម និងជនបទ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            53 => 
            array (
                'id' => 56,
                'name' => 'ក្រុមប្រឹក្សា ធម្មនុញ្ញ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            54 => 
            array (
                'id' => 57,
                'name' => 'ក្រុមប្រឹក្សា កំណែទម្រង់ច្បាប់ និងប្រពន័្ធយុត្តិធម៌',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            55 => 
            array (
                'id' => 58,
                'name' => 'គណៈកម្មការជាតិ គ្រប់គ្រង គ្រោះមហន្តរាយ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            56 => 
            array (
                'id' => 59,
                'name' => 'គណៈកម្មការជាតិ ទន្លេមេគង្គ កម្ពុជា',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            57 => 
            array (
                'id' => 60,
                'name' => 'គណៈកម្មការជាតិ យូណេស្កូ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            58 => 
            array (
                'id' => 61,
                'name' => 'គណៈកម្មការ​ រៀបចំបុណ្យជាតិ-អន្តរជាតិ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            59 => 
            array (
                'id' => 62,
                'name' => 'គណៈកម្មការ​ សិទ្ធិមនុស្ស កម្ពុជា',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            60 => 
            array (
                'id' => 63,
                'name' => 'ព្រឹទ្ធសភា',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            61 => 
            array (
                'id' => 64,
                'name' => 'រដ្ឋសភា​​​​​​​​​​​​ជាតិ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            62 => 
            array (
                'id' => 65,
                'name' => 'អជ្ញាធរជាតិ រមណីយដ្ឋាន វប្បធម៌ធម្មជាតិ ប្រាសាទព្រះវិហារ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            63 => 
            array (
                'id' => 66,
                'name' => 'គណៈកម្មការ POW  /  MIA កម្ពុជា',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            64 => 
            array (
                'id' => 67,
                'name' => 'គណៈកម្មការជាតិ រៀបចំការបោះឆ្នោត',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            65 => 
            array (
                'id' => 68,
                'name' => 'អាជ្ញាធរ អគ្គីសនី',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            66 => 
            array (
                'id' => 69,
                'name' => 'អាជ្ញាធរ ប្រេងកាតជាតិកម្ពុជា',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            67 => 
            array (
                'id' => 70,
                'name' => 'គណៈកម្មាធិការជាតិ អូឡាំពិកកម្ពុជា',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            68 => 
            array (
                'id' => 71,
                'name' => 'មជ្ឍមណ្ឌលសកម្មភាពកំចាត់មីនកម្ពុជា',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            69 => 
            array (
                'id' => 72,
                'name' => 'អាជ្ញាធរជាតិដោះស្រាយទំនាស់ដីធ្លី',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            70 => 
            array (
                'id' => 73,
                'name' => 'ក្រុមប្រឹក្សាសេដ្ឋកិច្ចជាតិ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            71 => 
            array (
                'id' => 74,
                'name' => 'គណៈកម្មាធិការជាតិអវិនិយោគរបស់រដ្ឋលើសហគ្រាស និងក្រុមហ៊ុន',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            72 => 
            array (
                'id' => 75,
                'name' => 'គណៈកម្មាធិការជាតិសំរបសំរួលកិច្ចការបញ្ជូនកងកំលាំងចូលរួមថែរក្សាសន្តិភាព អ.ស.ប',
                'created_at' => NULL,
                'updated_at' => '2018-04-04 10:43:00',
                'deleted_at' => NULL,
            ),
            73 => 
            array (
                'id' => 76,
                'name' => 'កំពង់ផែស្វយ័តភ្នំពេញ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            74 => 
            array (
                'id' => 77,
                'name' => 'គណៈកម្មាធិការជាតិប្រឆាំងអំពើភេរកម្ម',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            75 => 
            array (
                'id' => 78,
                'name' => 'គ្រប់បណ្ដាក្រុមហ៊ុនក្នុង និងក្រៅ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            76 => 
            array (
                'id' => 100,
                'name' => 'ប្រតិភូរាជរដ្ឋាភិបាល',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            77 => 
            array (
                'id' => 102,
                'name' => 'គណៈកម្មាធិការទទួលស្គាល់គុណភាពអប់រំនៃកម្ពុជា',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            78 => 
            array (
                'id' => 103,
                'name' => 'រាជរដ្ឋាភិបាល',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            79 => 
            array (
                'id' => 104,
                'name' => 'ទីប្រឹក្សាសម្ដេចអគ្គមហាសេនាបតីតេជោ ហ៊ុន សែន',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            80 => 
            array (
                'id' => 106,
                'name' => 'គ្រប់បណ្ដាសកលវិទ្យាល័យ វិទ្យាស្ថាន សាលារៀន',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            81 => 
            array (
                'id' => 107,
                'name' => 'គណៈកម្មាធិការសិក្សា និងរៀបចំសាងសង់អគារទីស្ដីការនាយករដ្ឋមន្រ្តី',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            82 => 
            array (
                'id' => 108,
                'name' => 'សមាគមយុវជនកម្ពុជា-អាស៊ាន',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            83 => 
            array (
                'id' => 110,
                'name' => 'អង្គភាពប្រឆាំងអំពើពុករលួយ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            84 => 
            array (
                'id' => 111,
                'name' => 'ក្រុមប្រឹក្សាជាតិកម្ពុជាដើម្បីស្រ្តី',
                'created_at' => NULL,
                'updated_at' => '2018-04-03 15:09:24',
                'deleted_at' => NULL,
            ),
            85 => 
            array (
                'id' => 112,
                'name' => 'គណៈមេធាវីនៃព្រះរាជាណាចក្រកម្ពុជា',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            86 => 
            array (
                'id' => 113,
                'name' => 'គណៈកម្មការរៀបចំ និងដំណើរការលំហាត់ហ្វឹកហ្វឺនយោធា',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            87 => 
            array (
                'id' => 114,
                'name' => 'គណៈកម្មការអភិរក្ស និងអភិវឌ្ឍន៍តំបន់ទេសចរណ៍សត្វផ្សោតទន្លេមេគង្គ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            88 => 
            array (
                'id' => 115,
                'name' => 'អាជ្ញាធរ អាងទន្លេសាប',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            89 => 
            array (
                'id' => 116,
                'name' => 'គណៈកម្មការអន្តរក្រសួងបង្រ្កាបបទល្មើសភាពយន្ត-វីដេអូ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            90 => 
            array (
                'id' => 117,
                'name' => 'គណៈកម្មការជាតិបេតិកភណ្ឌពិភពលោក',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            91 => 
            array (
                'id' => 118,
                'name' => 'តុលាការកំពូល',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            92 => 
            array (
                'id' => 119,
                'name' => 'គណៈកម្មាធិការ Codex ជាតិ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            93 => 
            array (
                'id' => 120,
                'name' => 'សាលា រាជធានីភ្នំពេញ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            94 => 
            array (
                'id' => 121,
                'name' => 'គណៈកម្មការប្រលងថ្នាក់ជាតិ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            95 => 
            array (
                'id' => 122,
                'name' => 'មជ្ឈមណ្ឌលឯកសារកម្ពុជា',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            96 => 
            array (
                'id' => 123,
                'name' => 'សាលាដំបូងរាជធានីភ្នំពេញ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            97 => 
            array (
                'id' => 124,
                'name' => 'ក្រុមប្រឹក្សាគោលនយោបាយដីធ្លី',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            98 => 
            array (
                'id' => 125,
                'name' => 'ក្រុមប្រឹក្សាជាន់ខ្ពស់ផ្នែកវប្បធម៌ជាតិ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            99 => 
            array (
                'id' => 126,
                'name' => 'គណៈកម្មការជាតិប្រជាជន និងការអភិវឌ្ឍន៍',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            100 => 
            array (
                'id' => 127,
                'name' => 'ឧបនាយករដ្ឋមន្ត្រីប្រចាំការ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            101 => 
            array (
                'id' => 128,
                'name' => 'គណៈកម្មាធិការជាតិសម្រាប់ការអភិវឌ្ឍតាមបែបប្រជាធិបតេយ្យនៅថ្នាក់ក្រោមជាតិ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            102 => 
            array (
                'id' => 129,
                'name' => 'គណៈគ្រប់គ្រងវិទ្យាស្ថានទំនាក់ទំនងអន្តរជាតិកម្ពុជា',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            103 => 
            array (
                'id' => 130,
                'name' => 'សាធារណជន',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            104 => 
            array (
                'id' => 131,
                'name' => 'ក្រសួង រ៉ែ និងថាមពល',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            105 => 
            array (
                'id' => 132,
                'name' => 'ក្រសួង មុខងារសាធារណៈ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            106 => 
            array (
                'id' => 133,
                'name' => 'ក្រសួង ឧស្សាហកម្ម និង សិប្បកម្ម',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            107 => 
            array (
                'id' => 134,
                'name' => 'គណៈកម្មាធិការជាតិប្រយុទ្ធប្រឆាំងអំពើជួញដូរមនុស្ស',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            108 => 
            array (
                'id' => 159,
                'name' => 'អគ្គលេខាធិការដ្ឋានក្រុមប្រឹក្សាធម្មនុញ្ញ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            109 => 
            array (
                'id' => 160,
                'name' => 'អគ្គលេខាធិការដ្ឋានព្រឹទ្ធសភា',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            110 => 
            array (
                'id' => 161,
                'name' => 'អគ្គលេខាធិការដ្ឋានរដ្ឋសភា',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            111 => 
            array (
                'id' => 162,
                'name' => 'អគ្គលេខាធិការរាជរដ្ឋាភិបាល',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            112 => 
            array (
                'id' => 163,
                'name' => 'ខុទ្ទកាល័យសម្តេចនាយករដ្ឋមន្រ្តី',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            113 => 
            array (
                'id' => 164,
                'name' => 'ខុទ្ទកាល័យសម្តេច ឯកឧត្តម លោកជំទាវឧបនាយករដ្ឋមន្ត្រី',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            114 => 
            array (
                'id' => 165,
                'name' => 'រាជកិច្ច',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            115 => 
            array (
                'id' => 166,
                'name' => 'ក្រសួង ឧស្សាហកម្ម ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            116 => 
            array (
                'id' => 167,
                'name' => 'ខុទ្ទកាល័យ ឯ.ឧ គាត ឈន់ ឧបនាយករដ្ឋមន្រ្តីប្រចាំការ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            117 => 
            array (
                'id' => 168,
                'name' => 'ខុទ្ទកាល័យ ឯ.ឧឧបនាយករដ្ឋមន្រ្តី ស ខេង ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            118 => 
            array (
                'id' => 169,
                'name' => 'សភាពាណិជ្ជកម្មកម្ពុជា',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            119 => 
            array (
                'id' => 170,
                'name' => 'អគ្គលេខាធិការដ្ឋាន គ.ស.ស.ជ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            120 => 
            array (
                'id' => 171,
                'name' => 'អគ្គលេខាធិការដ្ឋានក្រុមប្រឹក្សាអភិវឌ្ឍន៍កម្ពុជា',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            121 => 
            array (
                'id' => 172,
                'name' => 'អគ្គលេខាធិការដ្ឋានអាជ្ញាធរជាតិដោះស្រាយវិវាទដីធ្លី',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            122 => 
            array (
                'id' => 173,
                'name' => 'គណៈកម្មាធិការគោលនយោបាយសេដ្ឋកិច្ច និងហិរញ្ញវត្ថុ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            123 => 
            array (
                'id' => 174,
                'name' => 'ខុទ្ទកាល័យឯកឧត្តមកិត្តិសេដ្ឋាបណ្ឌិត ឧបនាយករដ្ឋមន្រ្តីប្រចាំការ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            124 => 
            array (
                'id' => 175,
                'name' => 'គណៈកម្មការអន្តរក្រសួងដើម្បីគ្រប់គ្រង និងអភិវឌ្ឍនតំបន់ប្រវត្តិសាស្រ្តអន្លង់វែង',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            125 => 
            array (
                'id' => 176,
                'name' => 'សមាជិកគណៈកម្មការអន្តរក្រសួងដើម្បីពិនិត្យ វាស់វែង និងវាយតម្លៃសម្បទានដីសេដ្ឋកិច្ច',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            126 => 
            array (
                'id' => 177,
                'name' => 'គណៈបញ្ជាការឯកភាពរាជធានី-ខេត្ត',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            127 => 
            array (
                'id' => 178,
                'name' => 'គណៈកម្មាធិការគោលនយោបាយសេដ្ឋកិច្ច និងហិរញ្ញវត្ថុ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            128 => 
            array (
                'id' => 179,
                'name' => 'ក្រុមស្រាវជ្រាវ និងវិភាគព័ត៌មាន',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            129 => 
            array (
                'id' => 180,
                'name' => 'រដ្ឋបាលថ្នាក់ក្រោមជាតិ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            130 => 
            array (
                'id' => 181,
                'name' => 'អគ្គលេខាធិការដ្ឋានឧត្តមក្រុមប្រឹក្សានៃអង្គចៅក្រម',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            131 => 
            array (
                'id' => 182,
                'name' => 'អគ្គលេខាធិការដ្ឋានក្រសួងមហាផ្ទៃ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            132 => 
            array (
                'id' => 184,
                'name' => 'សាលាខេត្តបាត់ដំបង',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            133 => 
            array (
                'id' => 185,
                'name' => 'សាលាខេត្តសៀមរាប',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            134 => 
            array (
                'id' => 186,
                'name' => 'ខុទ្ទកាល័យឯកឧត្តមឧបនាយករដ្ឋមន្រ្តី សុខ អាន',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            135 => 
            array (
                'id' => 187,
                'name' => 'អគ្គស្នងការដ្ឋាននគរបាលជាតិ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            136 => 
            array (
                'id' => 188,
                'name' => 'ស្នងការដ្ឋាននគរបាលខេត្តឧត្តរមានជ័យ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            137 => 
            array (
                'id' => 189,
                'name' => 'សាមីខ្លួន',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            138 => 
            array (
                'id' => 190,
                'name' => 'អគ្គលេខាធិការដ្ឋានក្រុមប្រឹក្សាអ្នកច្បាប់',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            139 => 
            array (
                'id' => 191,
                'name' => 'ខុទ្ទកាល័យឯកឧត្តម យឹម ឆៃលី ឧបនាយករដ្ឋមន្រ្តី',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            140 => 
            array (
                'id' => 192,
                'name' => 'អគ្គនាយកដ្ឋានអាជ្ញាធរអប្សរា',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            141 => 
            array (
                'id' => 193,
                'name' => 'នាយកដ្ឋានទំនាក់ទំនងអន្តរជាតិ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            142 => 
            array (
                'id' => 194,
                'name' => 'នាយកដ្ឋានផ្គត់ផ្គង់ និងហិរញ្ញកិច្ច',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            143 => 
            array (
                'id' => 195,
                'name' => 'នាយកដ្ឋានឧស្សាហកម្ម និងសំណង់',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            144 => 
            array (
                'id' => 196,
                'name' => 'នាយកដ្ឋានពាណិជ្ជកម្ម ហិរញ្ញវត្ថុ និងធនាគារ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            145 => 
            array (
                'id' => 197,
                'name' => 'សមាគមមិត្តភាពកម្ពុជា-វៀតណាម',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            146 => 
            array (
                'id' => 198,
                'name' => 'ខុទ្ទកាល័យលោកជំទាវឧបនាយករដ្ឋមន្រ្តី ម៉ែន សំអន',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            147 => 
            array (
                'id' => 199,
                'name' => 'ខុទ្ទកាល័យឯកឧត្តមឧបនាយករដ្ឋមន្រ្តីប្រចាំការ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            148 => 
            array (
                'id' => 200,
                'name' => 'នាយកដ្ឋានបុគ្គលិក',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            149 => 
            array (
                'id' => 201,
                'name' => 'អភិបាល នៃគណៈអភិបាលខេត្តស្ទឹងត្រែង',
                'created_at' => NULL,
                'updated_at' => '2018-04-26 09:24:28',
                'deleted_at' => NULL,
            ),
            150 => 
            array (
                'id' => 202,
                'name' => 'សាលាខេត្តឧត្តរមានជ័យ ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            151 => 
            array (
                'id' => 203,
                'name' => 'សាលាខេត្តព្រះវិហារ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            152 => 
            array (
                'id' => 204,
                'name' => 'អគ្គនាយកដ្ឋានគយ​ និងរដ្ឋាករកម្ពុជា',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            153 => 
            array (
                'id' => 205,
                'name' => 'កំពង់ផែអន្តរជាតិ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            154 => 
            array (
                'id' => 206,
                'name' => 'រដ្ឋបាលព្រៃឈើ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            155 => 
            array (
                'id' => 207,
                'name' => 'អភិបាល នៃគណៈអភិបាលខេត្តព្រះសីហនុ',
                'created_at' => NULL,
                'updated_at' => '2018-04-26 09:24:07',
                'deleted_at' => NULL,
            ),
            156 => 
            array (
                'id' => 208,
                'name' => 'អភិបាល នៃគណៈអភិបាលខេត្តតាកែវ',
                'created_at' => NULL,
                'updated_at' => '2018-04-26 09:23:37',
                'deleted_at' => NULL,
            ),
            157 => 
            array (
                'id' => 209,
                'name' => 'សាលាខេត្តកោះកុង',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            158 => 
            array (
                'id' => 210,
                'name' => 'សាលាខេត្តស្ទឹងត្រែង ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            159 => 
            array (
                'id' => 211,
                'name' => 'សាលាខេត្តមណ្ឌលគីរី',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            160 => 
            array (
                'id' => 212,
                'name' => 'សាលាខេត្តរតនៈគីរី',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            161 => 
            array (
                'id' => 213,
                'name' => 'សាលាខេត្តកំពង់ឆ្នាំង',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            162 => 
            array (
                'id' => 214,
                'name' => 'សមាគមិត្តភាពកម្ពុជា-ចិន',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            163 => 
            array (
                'id' => 215,
                'name' => 'គណៈកម្មាធិការជាតិសន្តិសុខ ព្រលានយន្តហោះអន្តរជាតិ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            164 => 
            array (
                'id' => 216,
                'name' => 'អភិបាល នៃគណៈអភិបាលខេត្តកំពត',
                'created_at' => NULL,
                'updated_at' => '2018-04-26 09:23:15',
                'deleted_at' => NULL,
            ),
            165 => 
            array (
                'id' => 217,
                'name' => 'អគ្គលេខាធិការដ្ឋានគណៈវិស្វករកម្ពុជា',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            166 => 
            array (
                'id' => 218,
                'name' => 'នាយកដ្ឋានពិធីការ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            167 => 
            array (
                'id' => 219,
                'name' => 'សាលាខេត្តព្រះសីហនុ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            168 => 
            array (
                'id' => 220,
                'name' => 'សាលាខេត្តតាកែវ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            169 => 
            array (
                'id' => 221,
                'name' => 'ខុទ្ទកាល័យសម្តេចក្រឡាហោម ឧបនាយករដ្ឋមន្រ្តី រដ្ឋមន្រ្តីក្រសួងមហាផ្ទែ',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            170 => 
            array (
                'id' => 222,
                'name' => 'គណៈកម្មាធិការជាតិកម្ពុជាដើម្បីមនុស្សចាស់',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            171 => 
            array (
                'id' => 223,
                'name' => 'វិទ្យាស្ថានបណ្តុះបណ្តាល និង ស្រាវជ្រាវដើម្បីអភិវឌ្ឍន៍កម្ពុជា',
                'created_at' => '2018-01-29 13:44:56',
                'updated_at' => '2018-01-29 13:44:56',
                'deleted_at' => NULL,
            ),
            172 => 
            array (
                'id' => 224,
                'name' => 'គណៈកម្មាធិការជាតិគាំពារនិងអភិវឌ្ឍកុមារតូច',
                'created_at' => '2018-02-08 11:01:09',
                'updated_at' => '2018-02-08 11:01:09',
                'deleted_at' => NULL,
            ),
            173 => 
            array (
                'id' => 225,
                'name' => 'គណៈកម្មាធិការរៀបចំដែនដីនិងនគរូបនីយកម្មថ្នាក់ជាតិ',
                'created_at' => '2018-02-08 11:03:02',
                'updated_at' => '2018-02-08 11:03:02',
                'deleted_at' => NULL,
            ),
            174 => 
            array (
                'id' => 226,
                'name' => 'ក្រុមប្រឹក្សាជាតិកម្ពុជាដើម្បីអភិវឌ្ឍយុវជន',
                'created_at' => '2018-02-08 11:03:58',
                'updated_at' => '2018-02-08 11:03:58',
                'deleted_at' => NULL,
            ),
            175 => 
            array (
                'id' => 227,
                'name' => 'គណៈស្ថាបត្យករកម្ពុជា',
                'created_at' => '2018-02-08 11:05:15',
                'updated_at' => '2018-02-08 11:05:15',
                'deleted_at' => NULL,
            ),
            176 => 
            array (
                'id' => 228,
                'name' => 'គណៈកម្មាធិការជាតិជីវសុវត្ថិភាព',
                'created_at' => '2018-02-08 11:06:00',
                'updated_at' => '2018-02-08 11:06:00',
                'deleted_at' => NULL,
            ),
            177 => 
            array (
                'id' => 229,
                'name' => 'ធនាគារជាតិនៃកម្ពុជា',
                'created_at' => '2018-02-08 11:12:45',
                'updated_at' => '2018-02-08 11:12:45',
                'deleted_at' => NULL,
            ),
            178 => 
            array (
                'id' => 230,
                'name' => 'គណៈកម្មាធិការរជាតិសម្រួលការដឹកជញ្ជូនឆ្លងកាត់ព្រំដែន',
                'created_at' => '2018-02-08 13:54:37',
                'updated_at' => '2018-02-08 13:54:37',
                'deleted_at' => NULL,
            ),
            179 => 
            array (
                'id' => 231,
                'name' => 'គណៈកម្មការតាមដានការអនុវត្តកិច្ចសន្យាសម្បទានព្រលានយន្តយហោះភ្នំពេញ និង សៀមរាប',
                'created_at' => '2018-02-08 13:56:45',
                'updated_at' => '2018-02-08 13:56:45',
                'deleted_at' => NULL,
            ),
            180 => 
            array (
                'id' => 232,
                'name' => 'គណៈកម្មការបណ្ឌិតសភា',
                'created_at' => '2018-02-08 13:57:47',
                'updated_at' => '2018-02-08 13:57:47',
                'deleted_at' => NULL,
            ),
            181 => 
            array (
                'id' => 233,
                'name' => 'គណៈកម្មការត្រួតពិនិត្យយានយន្តដឹកជញ្ជូនលើសទម្ងន់កម្រិតអតិបរមា',
                'created_at' => '2018-02-08 13:59:15',
                'updated_at' => '2018-02-08 13:59:15',
                'deleted_at' => NULL,
            ),
            182 => 
            array (
                'id' => 234,
                'name' => 'គណៈកម្មការសហប្រតិបត្តិការអភិវឌ្ឍន៍តំបន់ ត្រីកោណ កម្ពុជា-វៀតណាម-ឡាវ និងកម្ពុជា-ឡាវ-ថៃ',
                'created_at' => '2018-02-08 14:02:14',
                'updated_at' => '2018-02-08 14:02:14',
                'deleted_at' => NULL,
            ),
            183 => 
            array (
                'id' => 235,
                'name' => 'គណៈកម្មការពិនិត្យលក្ខណសម្បត្តិ វរជន ដែលត្រូវជូនគ្រឿងឥស្សរិយយស',
                'created_at' => '2018-02-08 14:02:49',
                'updated_at' => '2018-02-08 14:02:49',
                'deleted_at' => NULL,
            ),
            184 => 
            array (
                'id' => 236,
                'name' => 'គណៈកម្មការសមារណកម្មមន្រ្តីរាជការស៊ីវិល នៅក្នុងក្របខ័ណ្ឌថ្មី',
                'created_at' => '2018-02-08 14:03:30',
                'updated_at' => '2018-02-08 14:03:30',
                'deleted_at' => NULL,
            ),
            185 => 
            array (
                'id' => 237,
                'name' => 'គណៈកម្មការជាតិសម្របសម្រួលសាកលវិទ្យាល័យ និងគ្រឹះស្ថានឧត្ដមសិក្សា',
                'created_at' => '2018-02-08 14:04:20',
                'updated_at' => '2018-02-08 14:04:20',
                'deleted_at' => NULL,
            ),
            186 => 
            array (
                'id' => 238,
                'name' => 'គណៈកម្មាធិការរជាតិរៀបចំកម្មវិធីជាតិនៃសកម្មភាពអភិវឌ្ឍន៍កម្ពុជា',
                'created_at' => '2018-02-08 14:04:58',
                'updated_at' => '2018-02-08 14:04:58',
                'deleted_at' => NULL,
            ),
            187 => 
            array (
                'id' => 239,
                'name' => 'គណៈកម្មការអតីតយុទ្ធជនខេត្ត',
                'created_at' => '2018-02-08 14:07:02',
                'updated_at' => '2018-02-08 14:07:02',
                'deleted_at' => NULL,
            ),
            188 => 
            array (
                'id' => 240,
                'name' => 'គណៈកម្មាធិការជាតិគ្រប់គ្រងការប្រែប្រួលអាកាសធាតុ',
                'created_at' => '2018-02-08 14:08:02',
                'updated_at' => '2018-02-08 14:08:02',
                'deleted_at' => NULL,
            ),
            189 => 
            array (
                'id' => 241,
                'name' => 'គណៈកម្មាធិការរគ្រប់គ្រងប្រសិទ្ធិភាពការងារ និងគណនេយ្យភាព',
                'created_at' => '2018-02-08 14:10:20',
                'updated_at' => '2018-02-08 14:10:20',
                'deleted_at' => NULL,
            ),
            190 => 
            array (
                'id' => 242,
                'name' => 'គណៈកម្មាធិការ ពានរង្វាន់យុវជនដែលមានភាពជាអ្នកដឹកនាំប្រចាំឆ្នាំ',
                'created_at' => '2018-02-08 14:10:53',
                'updated_at' => '2018-02-08 14:10:53',
                'deleted_at' => NULL,
            ),
            191 => 
            array (
                'id' => 243,
                'name' => 'គណៈកម្មាធិការជាតិ គ្រប់គ្រងកម្មសិទ្ធិបញ្ញា',
                'created_at' => '2018-02-08 14:12:30',
                'updated_at' => '2018-02-08 14:12:30',
                'deleted_at' => NULL,
            ),
            192 => 
            array (
                'id' => 244,
                'name' => 'គណៈកម្មការអចិន្រ្តៃយ៍គ្រប់គ្រងសារមន្ទីរខេត្តសៀមរាប',
                'created_at' => '2018-02-08 14:13:33',
                'updated_at' => '2018-02-08 14:13:33',
                'deleted_at' => NULL,
            ),
            193 => 
            array (
                'id' => 245,
                'name' => 'គណៈកម្មាធិការរកំណត់ផ្ទៃទីតាំងបឹងបួ ក្នុងព្រះរាជាណាចក្រកម្ពុជា',
                'created_at' => '2018-02-08 14:14:08',
                'updated_at' => '2018-02-08 14:14:08',
                'deleted_at' => NULL,
            ),
            194 => 
            array (
                'id' => 246,
                'name' => 'គណៈកម្មាធិការគ្រប់គ្រងធនធានខ្សាច់',
                'created_at' => '2018-02-08 14:15:07',
                'updated_at' => '2018-02-08 14:15:07',
                'deleted_at' => NULL,
            ),
            195 => 
            array (
                'id' => 247,
                'name' => 'គណៈកម្មាធិការរជាតិភាសាខ្មែរ',
                'created_at' => '2018-02-08 14:17:46',
                'updated_at' => '2018-02-08 14:17:46',
                'deleted_at' => NULL,
            ),
            196 => 
            array (
                'id' => 248,
                'name' => 'គណៈកម្មាធិការរទំនាក់ទំនងព្រំដែន កម្ពុជា-ថៃ',
                'created_at' => '2018-02-08 14:18:11',
                'updated_at' => '2018-02-08 14:18:11',
                'deleted_at' => NULL,
            ),
            197 => 
            array (
                'id' => 249,
                'name' => 'គណៈកម្មាធិការគ្រប់គ្រងគ្រោះមហន្តរាយ ឃុំ សង្កាត់ ទូទាំងព្រះរាជាណាចក្រកម្ពុជា',
                'created_at' => '2018-02-08 14:19:21',
                'updated_at' => '2018-02-08 14:19:21',
                'deleted_at' => NULL,
            ),
            198 => 
            array (
                'id' => 250,
                'name' => 'គណៈកម្មាការអភិរក្ស និងអភិវឌ្ឍន៍តំបន់ទេសចរណ៍សត្វផ្សោតទន្លេមេគង្គ',
                'created_at' => '2018-02-08 14:20:49',
                'updated_at' => '2018-02-08 14:20:49',
                'deleted_at' => NULL,
            ),
            199 => 
            array (
                'id' => 251,
                'name' => 'គណៈកម្មាធិការរជាតិដោះស្រាយបញ្ហាជនអនាថា',
                'created_at' => '2018-02-08 14:21:19',
                'updated_at' => '2018-02-08 14:21:19',
                'deleted_at' => NULL,
            ),
            200 => 
            array (
                'id' => 252,
                'name' => 'គណៈកម្មាធិការរជាតិសុវត្ថិភាពចរាចរផ្លូវគោក',
                'created_at' => '2018-02-08 14:21:45',
                'updated_at' => '2018-02-08 14:21:45',
                'deleted_at' => NULL,
            ),
            201 => 
            array (
                'id' => 253,
                'name' => 'គណៈកម្មាធិការជាតិបណ្តុះបណ្តាល',
                'created_at' => '2018-02-08 14:22:08',
                'updated_at' => '2018-02-08 14:22:08',
                'deleted_at' => NULL,
            ),
            202 => 
            array (
                'id' => 254,
                'name' => 'គណៈកម្មាធិការគោលនយោបាយ និងយុទ្ធសាស្រ្ត',
                'created_at' => '2018-02-08 14:23:04',
                'updated_at' => '2018-02-08 14:23:04',
                'deleted_at' => NULL,
            ),
            203 => 
            array (
                'id' => 255,
                'name' => 'គណៈកម្មាធិការសម្របសម្រួលស្ថិតិ',
                'created_at' => '2018-02-08 14:24:06',
                'updated_at' => '2018-02-08 14:24:06',
                'deleted_at' => NULL,
            ),
            204 => 
            array (
                'id' => 256,
                'name' => 'ក្រុមប្រឹក្សាជាតិវិទ្យាសាស្ត្រ និងបច្ចេកវិទ្យា',
                'created_at' => '2018-02-08 14:27:56',
                'updated_at' => '2018-04-03 15:07:31',
                'deleted_at' => NULL,
            ),
            205 => 
            array (
                'id' => 257,
                'name' => 'ក្រុមប្រឹក្សាស្ដារអភិវឌ្ឍន៍វិស័យកសិកម្ម និងជនបទ',
                'created_at' => '2018-02-08 14:29:38',
                'updated_at' => '2018-02-08 14:29:38',
                'deleted_at' => NULL,
            ),
            206 => 
            array (
                'id' => 258,
                'name' => 'ក្រុមប្រឹក្សាជាតិកម្ពុជាដើម្បីកុមារ',
                'created_at' => '2018-02-08 14:30:14',
                'updated_at' => '2018-02-08 14:30:14',
                'deleted_at' => NULL,
            ),
            207 => 
            array (
                'id' => 259,
                'name' => 'ក្រុមប្រឹក្សាជាតិភាសាខ្មែរ',
                'created_at' => '2018-02-08 14:30:49',
                'updated_at' => '2018-02-08 14:30:49',
                'deleted_at' => NULL,
            ),
            208 => 
            array (
                'id' => 260,
                'name' => 'ក្រុមប្រឹក្សាសេដ្ឋកិច្ច សង្គមកិច្ច និងវប្បធម៌',
                'created_at' => '2018-02-08 14:31:16',
                'updated_at' => '2018-02-08 14:31:16',
                'deleted_at' => NULL,
            ),
            209 => 
            array (
                'id' => 261,
                'name' => 'ក្រុមប្រឹក្សាបច្ចេកទេសរបបសន្តិសុខសង្គម',
                'created_at' => '2018-02-08 14:33:03',
                'updated_at' => '2018-02-08 14:33:03',
                'deleted_at' => NULL,
            ),
            210 => 
            array (
                'id' => 262,
                'name' => 'ក្រុមប្រឹក្សាអភិវឌ្ឍន៍សង្គមកិច្ច',
                'created_at' => '2018-02-08 14:33:40',
                'updated_at' => '2018-02-08 14:33:40',
                'deleted_at' => NULL,
            ),
            211 => 
            array (
                'id' => 263,
                'name' => 'ក្រុមប្រឹក្សាគោលនយោបាយដីធ្លី',
                'created_at' => '2018-02-08 14:34:50',
                'updated_at' => '2018-02-08 14:34:50',
                'deleted_at' => NULL,
            ),
            212 => 
            array (
                'id' => 264,
                'name' => 'ក្រុមប្រឹក្សានីតិកម្ម នៃក្រសួងមហាផ្ទៃ',
                'created_at' => '2018-02-08 14:35:30',
                'updated_at' => '2018-02-08 14:35:30',
                'deleted_at' => NULL,
            ),
            213 => 
            array (
                'id' => 265,
                'name' => 'ក្រុមប្រឹក្សាកំណែទម្រង់កងយោធពលខេមរភូមិន្ទ',
                'created_at' => '2018-02-08 14:36:11',
                'updated_at' => '2018-02-08 14:36:11',
                'deleted_at' => NULL,
            ),
            214 => 
            array (
                'id' => 266,
                'name' => 'ក្រុមប្រឹក្សាភិបាលបណ្តុះបណ្តាល និងបញ្ជូនពលករទៅបរទេស',
                'created_at' => '2018-02-08 14:36:43',
                'updated_at' => '2018-02-08 14:36:43',
                'deleted_at' => NULL,
            ),
            215 => 
            array (
                'id' => 267,
                'name' => 'ក្រុមប្រឹក្សានីតិកម្ម និងនាយកដ្ឋានទំនាក់ទំនងអន្តរជាតិចំណុះក្រសួងមហាផ្ទៃ',
                'created_at' => '2018-02-08 14:37:32',
                'updated_at' => '2018-02-08 14:37:32',
                'deleted_at' => NULL,
            ),
            216 => 
            array (
                'id' => 268,
                'name' => 'ក្រុមប្រឹក្សាអ្នកច្បាប់',
                'created_at' => '2018-02-08 14:38:11',
                'updated_at' => '2018-02-08 14:38:11',
                'deleted_at' => NULL,
            ),
            217 => 
            array (
                'id' => 269,
                'name' => 'ក្រសួងស្ថាប័នពាក់ព័ន្ធ',
                'created_at' => '2018-03-23 10:35:06',
                'updated_at' => '2018-03-23 10:35:06',
                'deleted_at' => NULL,
            ),
            218 => 
            array (
                'id' => 270,
                'name' => 'ខុទ្ទកាល័យឧបនាយករដ្ឋមន្រ្តី',
                'created_at' => '2018-03-26 09:54:56',
                'updated_at' => '2018-03-26 09:54:56',
                'deleted_at' => NULL,
            ),
            219 => 
            array (
                'id' => 271,
                'name' => 'ក្រុមប្រឹក្សាជាតិគាំពារសង្គម',
                'created_at' => '2018-03-26 10:51:23',
                'updated_at' => '2018-03-26 10:51:23',
                'deleted_at' => NULL,
            ),
            220 => 
            array (
                'id' => 274,
                'name' => 'សម្ដេចក្រឡាហោម ឧបនាយករដ្ឋមន្ត្រី រដ្ឋមន្ត្រីក្រសួងមហាផ្ទៃ',
                'created_at' => '2018-03-30 09:56:54',
                'updated_at' => '2018-03-30 09:56:54',
                'deleted_at' => NULL,
            ),
            221 => 
            array (
                'id' => 275,
                'name' => 'គ្រប់សមាជិកគណៈកម្មាធិសម្បទានដីសង្គមកិច្ចថ្នាក់ជាតិ',
                'created_at' => '2018-03-30 11:45:02',
                'updated_at' => '2018-03-30 11:45:02',
                'deleted_at' => NULL,
            ),
            222 => 
            array (
                'id' => 276,
                'name' => 'អភិបាល នៃគណៈអភិបាលខេត្តស្វាយរៀង',
                'created_at' => '2018-04-03 10:06:09',
                'updated_at' => '2018-04-26 09:22:36',
                'deleted_at' => NULL,
            ),
            223 => 
            array (
                'id' => 277,
                'name' => 'រដ្ឋបាលខេត្តសៀមរាប',
                'created_at' => '2018-04-03 10:30:17',
                'updated_at' => '2018-04-03 10:30:17',
                'deleted_at' => NULL,
            ),
            224 => 
            array (
                'id' => 278,
                'name' => 'សាលាខេត្តកំពង់ស្ពឺ',
                'created_at' => '2018-04-04 09:21:21',
                'updated_at' => '2018-04-04 09:21:21',
                'deleted_at' => NULL,
            ),
            225 => 
            array (
                'id' => 279,
                'name' => 'មជ្ឈមណ្ឌលជាតិ គ្រប់គ្រងកងកំលាំងរក្សាសន្តិភាពបោសសំអាតមីន និងកាកសំណល់សង្គ្រាម',
                'created_at' => '2018-04-04 10:35:48',
                'updated_at' => '2018-04-04 10:35:48',
                'deleted_at' => NULL,
            ),
            226 => 
            array (
                'id' => 280,
                'name' => 'សាលាខេត្តត្បូងឃ្មុំ',
                'created_at' => '2018-04-04 15:12:27',
                'updated_at' => '2018-04-04 15:12:27',
                'deleted_at' => NULL,
            ),
            227 => 
            array (
                'id' => 281,
                'name' => 'និយ័តករទូរគមនាគមន៍កម្ពុជា',
                'created_at' => '2018-04-04 15:35:19',
                'updated_at' => '2018-04-04 15:35:19',
                'deleted_at' => NULL,
            ),
            228 => 
            array (
                'id' => 282,
                'name' => 'អភិបាល នៃគណៈអភិបាលខេត្តមណ្ឌលគិរី',
                'created_at' => '2018-04-05 09:40:52',
                'updated_at' => '2018-04-26 09:22:16',
                'deleted_at' => NULL,
            ),
            229 => 
            array (
                'id' => 283,
                'name' => 'សាលាឧទ្ធរណ៍',
                'created_at' => '2018-04-05 09:49:20',
                'updated_at' => '2018-04-05 09:49:20',
                'deleted_at' => NULL,
            ),
            230 => 
            array (
                'id' => 284,
                'name' => 'សាលាខេត្តកណ្ដាល',
                'created_at' => '2018-04-05 10:14:41',
                'updated_at' => '2018-04-05 10:14:41',
                'deleted_at' => NULL,
            ),
            231 => 
            array (
                'id' => 285,
                'name' => 'គណៈសង្ឃនាយក នៃព្រះរាជាណាចក្រកម្ពុជា',
                'created_at' => '2018-04-05 15:48:04',
                'updated_at' => '2018-04-05 15:48:04',
                'deleted_at' => NULL,
            ),
            232 => 
            array (
                'id' => 286,
                'name' => 'សម្តេចព្រះអគ្គមហាសង្ឃរាជ ទេព វង្ស',
                'created_at' => '2018-04-05 15:49:06',
                'updated_at' => '2018-04-05 15:49:06',
                'deleted_at' => NULL,
            ),
            233 => 
            array (
                'id' => 287,
                'name' => 'ឧត្តមក្រុមប្រឹក្សានៃអង្គចៅក្រម',
                'created_at' => '2018-04-06 09:57:09',
                'updated_at' => '2018-04-06 09:57:09',
                'deleted_at' => NULL,
            ),
            234 => 
            array (
                'id' => 288,
                'name' => 'ឧត្តមក្រុមប្រឹក្សាកំណែទម្រង់រដ្ឋ',
                'created_at' => '2018-04-20 10:28:30',
                'updated_at' => '2019-03-25 11:53:41',
                'deleted_at' => NULL,
            ),
            235 => 
            array (
                'id' => 289,
                'name' => 'ស្ដីពីការបង្កើតក្រុមប្រឹក្សាគោលនយោបាយដីធ្លី',
                'created_at' => '2018-04-20 10:49:02',
                'updated_at' => '2018-04-20 10:49:02',
                'deleted_at' => NULL,
            ),
            236 => 
            array (
                'id' => 290,
                'name' => 'ស្ដីពីការបង្កើតក្រុមប្រឹក្សានីតិកម្ម នៃក្រសួងមហាផ្ទៃ',
                'created_at' => '2018-04-20 10:50:08',
                'updated_at' => '2018-04-20 10:50:08',
                'deleted_at' => NULL,
            ),
            237 => 
            array (
                'id' => 291,
                'name' => 'វិទ្យាស្ថានបច្ចេកវិទ្យាកម្ពុជា',
                'created_at' => '2018-04-20 10:59:39',
                'updated_at' => '2018-04-20 10:59:39',
                'deleted_at' => NULL,
            ),
            238 => 
            array (
                'id' => 292,
                'name' => 'អភិបាល នៃគណៈអភិបាលខេត្តកែប',
                'created_at' => '2018-04-26 09:15:23',
                'updated_at' => '2018-04-26 09:15:23',
                'deleted_at' => NULL,
            ),
            239 => 
            array (
                'id' => 293,
                'name' => 'តុលាការខេត្ត-ក្រុង',
                'created_at' => '2018-04-26 09:43:34',
                'updated_at' => '2018-04-26 09:43:34',
                'deleted_at' => NULL,
            ),
            240 => 
            array (
                'id' => 294,
            'name' => 'គណៈបញ្ជាការសន្តិសុខអចិន្រ្តៃយ៍ (គ.ស.អ)',
                'created_at' => '2018-04-27 16:31:54',
                'updated_at' => '2018-04-27 16:31:54',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}