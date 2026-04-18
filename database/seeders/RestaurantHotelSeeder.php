<?php

namespace Database\Seeders;

use App\Models\Place;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantHotelSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET NAMES utf8mb4');
        DB::statement('SET CHARACTER SET utf8mb4');

        $places = [

            // ══════════════════════════════════════════
            // 🍽️ RESTAURANTS - أشهر 7 مطاعم في القاهرة
            // ══════════════════════════════════════════

            // ── Restaurant 1: Koshary El Tahrir ───────
            [
                'name_ar'          => 'كشري التحرير',
                'name_en'          => 'Koshary El Tahrir',
                'description_ar'   => 'أشهر مطعم كشري في القاهرة، يقدم الكشري المصري الأصيل بأسعار في متناول الجميع منذ عام ١٩٥٠',
                'description_en'   => 'The most famous koshary restaurant in Cairo, serving authentic Egyptian koshary at affordable prices since 1950',
                'image_url'        => 'places/koshary_tahrir.jpg',
                'is_free'          => false,
                'price_ar'         => '٤٠ - ٣٠٠ جنيه',
                'price_en'         => '40 - 300 EGP',
                'price_number'     => 170.00,
                'working_hours_ar' => '٨:٠٠ صباحاً - ١٢:٠٠ صباحاً',
                'working_hours_en' => '8:00 AM - 12:00 AM',
                'location_ar'      => 'وسط البلد',
                'location_en'      => 'Downtown Cairo',
                'latitude'         => 30.0444,
                'longitude'        => 31.2357,
                'rating_avg'       => 0,
                'total_bookings'   => 0,
                'activities_ar'    => [
                    'تذوق الكشري المصري الأصيل',
                    'الاستمتاع بالأجواء الشعبية',
                    'تجربة مطعم تاريخي عمره أكثر من ٧٠ سنة',
                ],
                'activities_en'    => [
                    'Taste authentic Egyptian Koshary',
                    'Enjoy the popular local atmosphere',
                    'Experience a historic restaurant over 70 years old',
                ],
                'is_active'        => true,
                'category'         => 'restaurant',
            ],

            // ── Restaurant 2: Felfela ──────────────────
            [
                'name_ar'          => 'مطعم فلفلة',
                'name_en'          => 'Felfela Restaurant',
                'description_ar'   => 'من أعرق مطاعم وسط البلد، يقدم أشهى الأكلات المصرية الشعبية في أجواء تراثية أصيلة',
                'description_en'   => 'One of the oldest restaurants in downtown Cairo, serving delicious Egyptian cuisine in an authentic heritage atmosphere',
                'image_url'        => 'places/felfela.jpg',
                'is_free'          => false,
                'price_ar'         => '٩٠٠ - ١٥٠ جنيه',
                'price_en'         => '220 - 900 EGP',
                'price_number'     => 550.00,
                'working_hours_ar' => '٩:٠٠ صباحاً - ١١:٠٠ مساءً',
                'working_hours_en' => '9:00 AM - 11:00 PM',
                'location_ar'      => 'وسط البلد',
                'location_en'      => 'Downtown Cairo',
                'latitude'         => 30.0451,
                'longitude'        => 31.2366,
                'rating_avg'       => 0,
                'total_bookings'   => 0,
                'activities_ar'    => [
                    'تذوق الأكلات المصرية التقليدية',
                    'الاستمتاع بالديكور التراثي',
                    'تجربة الفول والطعمية المصرية',
                ],
                'activities_en'    => [
                    'Taste traditional Egyptian dishes',
                    'Enjoy the heritage decor',
                    'Try Egyptian foul and falafel',
                ],
                'is_active'        => true,
                'category'         => 'restaurant',
            ],

            // ── Restaurant 3: Sequoia ──────────────────
            [
                'name_ar'          => 'مطعم سيكويا',
                'name_en'          => 'Sequoia Restaurant',
                'description_ar'   => 'مطعم راقٍ على ضفاف النيل في الزمالك يقدم المأكولات المتوسطية والمصرية مع إطلالة خلابة على النيل',
                'description_en'   => 'Upscale restaurant on the Nile banks in Zamalek offering Mediterranean and Egyptian cuisine with a stunning Nile view',
                'image_url'        => 'places/sequoia.jpg',
                'is_free'          => false,
                'price_ar'         => '٦٥٠ - ١٠٠٠ جنيه',
                'price_en'         => '650 - 1000 EGP',
                'price_number'     => 800.00,
                'working_hours_ar' => '١٢:٠٠ ظهراً - ١:٠٠ صباحاً',
                'working_hours_en' => '12:00 PM - 1:00 AM',
                'location_ar'      => 'الزمالك',
                'location_en'      => 'Zamalek',
                'latitude'         => 30.0631,
                'longitude'        => 31.2197,
                'rating_avg'       => 0,
                'total_bookings'   => 0,
                'activities_ar'    => [
                    'الاستمتاع بالإطلالة على النيل',
                    'تذوق المأكولات المتوسطية',
                    'تناول العشاء في أجواء رومانسية',
                ],
                'activities_en'    => [
                    'Enjoy the Nile view',
                    'Taste Mediterranean cuisine',
                    'Dine in a romantic atmosphere',
                ],
                'is_active'        => true,
                'category'         => 'restaurant',
            ],

            // ── Restaurant 4: Abou El Sid ──────────────
            [
                'name_ar'          => 'مطعم أبو السيد',
                'name_en'          => 'Abou El Sid Restaurant',
                'description_ar'   => 'مطعم مصري راقٍ يقدم أشهى الأكلات المصرية التقليدية في ديكور يجمع بين الأصالة والرقي',
                'description_en'   => 'Upscale Egyptian restaurant serving the finest traditional Egyptian dishes in a decor combining authenticity and elegance',
                'image_url'        => 'places/abou_el_sid.jpg',
                'is_free'          => false,
                'price_ar'         => '٣٥٠ - ١٤٠٠ جنيه',
                'price_en'         => '350 - 1400 EGP',
                'price_number'     => 850.00,
                'working_hours_ar' => '١٢:٠٠ ظهراً - ٢:٠٠ صباحاً',
                'working_hours_en' => '12:00 PM - 2:00 AM',
                'location_ar'      => 'الزمالك',
                'location_en'      => 'Zamalek',
                'latitude'         => 30.0601,
                'longitude'        => 31.2202,
                'rating_avg'       => 0,
                'total_bookings'   => 0,
                'activities_ar'    => [
                    'تذوق الكبة والمحاشي المصرية',
                    'الاستمتاع بالديكور الكلاسيكي المصري',
                    'تجربة المطبخ المصري الأصيل',
                ],
                'activities_en'    => [
                    'Taste Egyptian kibbeh and stuffed vegetables',
                    'Enjoy the classic Egyptian decor',
                    'Experience authentic Egyptian cuisine',
                ],
                'is_active'        => true,
                'category'         => 'restaurant',
            ],

            // ── Restaurant 5: Naguib Mahfouz Cafe ─────
            [
                'name_ar'          => 'مقهى نجيب محفوظ',
                'name_en'          => 'Naguib Mahfouz Cafe',
                'description_ar'   => 'مطعم وكافيه شهير في قلب خان الخليلي، سُمي باسم الروائي المصري العالمي نجيب محفوظ ويقدم المأكولات المصرية التقليدية',
                'description_en'   => 'Famous restaurant and cafe in the heart of Khan El-Khalili, named after Nobel laureate Naguib Mahfouz, serving traditional Egyptian food',
                'image_url'        => 'places/naguib_mahfouz.jpg',
                'is_free'          => false,
                'price_ar'         => '٨٠٠ - ٢٣٠٠ جنيه',
                'price_en'         => '800 - 2300 EGP',
                'price_number'     => 1500.00,
                'working_hours_ar' => '١٠:٠٠ صباحاً - ١٢:٠٠ صباحاً',
                'working_hours_en' => '10:00 AM - 12:00 AM',
                'location_ar'      => 'القاهرة القديمة',
                'location_en'      => 'Old Cairo',
                'latitude'         => 30.0468,
                'longitude'        => 31.2614,
                'rating_avg'       => 0,
                'total_bookings'   => 0,
                'activities_ar'    => [
                    'تناول الغداء بجوار خان الخليلي',
                    'الاستمتاع بأجواء القاهرة القديمة',
                    'تذوق الحلوى المصرية التقليدية',
                ],
                'activities_en'    => [
                    'Dine next to Khan El-Khalili',
                    'Enjoy Old Cairo atmosphere',
                    'Taste traditional Egyptian desserts',
                ],
                'is_active'        => true,
                'category'         => 'restaurant',
            ],

            // ── Restaurant 6: Andrea ──────────────────
            [
                'name_ar'          => 'مطعم أندريا',
                'name_en'          => 'Andrea Restaurant',
                'description_ar'   => 'مطعم شهير متخصص في الدجاج المشوي على الفحم في أجواء ريفية جميلة على ضفاف النيل في المعادي',
                'description_en'   => 'Famous restaurant specializing in charcoal grilled chicken in a beautiful countryside atmosphere on the Nile banks in Maadi',
                'image_url'        => 'places/andrea.jpg',
                'is_free'          => false,
                'price_ar'         => '٢٥٠ - ٨٠٠ جنيه',
                'price_en'         => '250 - 800 EGP',
                'price_number'     => 500.00,
                'working_hours_ar' => '١١:٠٠ صباحاً - ١١:٠٠ مساءً',
                'working_hours_en' => '11:00 AM - 11:00 PM',
                'location_ar'      => 'المعادي',
                'location_en'      => 'Maadi',
                'latitude'         => 29.9626,
                'longitude'        => 31.2497,
                'rating_avg'       => 0,
                'total_bookings'   => 0,
                'activities_ar'    => [
                    'تناول الدجاج المشوي الشهير',
                    'الاستمتاع بالأجواء الريفية',
                    'الإطلالة على النيل أثناء تناول الطعام',
                ],
                'activities_en'    => [
                    'Enjoy the famous grilled chicken',
                    'Experience the countryside atmosphere',
                    'Overlook the Nile while dining',
                ],
                'is_active'        => true,
                'category'         => 'restaurant',
            ],

            // ── Restaurant 7: Bab El Sharq ────────────
            [
                'name_ar'          => 'مطعم باب الشرق',
                'name_en'          => 'Bab El Sharq Restaurant',
                'description_ar'   => 'مطعم مصري أصيل يقدم أشهى أطباق المطبخ الشرقي والمصري في أجواء تراثية دافئة بالقاهرة الإسلامية',
                'description_en'   => 'Authentic Egyptian restaurant serving the finest oriental and Egyptian cuisine in a warm heritage atmosphere in Islamic Cairo',
                'image_url'        => 'places/bab_el_sharq.jpg',
                'is_free'          => false,
                'price_ar'         => '٨٠٠ - ١٥٠٠ جنيه',
                'price_en'         => '800 - 1500 EGP',
                'price_number'     => 1150.00,
                'working_hours_ar' => '١٢:٠٠ ظهراً - ١١:٠٠ مساءً',
                'working_hours_en' => '12:00 PM - 11:00 PM',
                'location_ar'      => 'القاهرة الإسلامية',
                'location_en'      => 'Islamic Cairo',
                'latitude'         => 30.0490,
                'longitude'        => 31.2640,
                'rating_avg'       => 0,
                'total_bookings'   => 0,
                'activities_ar'    => [
                    'تذوق الأطباق الشرقية الأصيلة',
                    'الاستمتاع بالديكور الإسلامي',
                    'تجربة الشاي والحلويات الشرقية',
                ],
                'activities_en'    => [
                    'Taste authentic oriental dishes',
                    'Enjoy the Islamic decor',
                    'Try oriental tea and sweets',
                ],
                'is_active'        => true,
                'category'         => 'restaurant',
            ],

            // ══════════════════════════════════════════
            // 🏨 HOTELS - أشهر 7 فنادق في القاهرة
            // ══════════════════════════════════════════

            // ── Hotel 1: Four Seasons Nile Plaza ──────
            [
                'name_ar'          => 'فور سيزونز نايل بلازا',
                'name_en'          => 'Four Seasons Hotel Cairo at Nile Plaza',
                'description_ar'   => 'أحد أفخم الفنادق في القاهرة يطل على النيل مباشرة في قلب جاردن سيتي، يوفر خدمات عالمية المستوى وإطلالات خلابة',
                'description_en'   => 'One of Cairo\'s most luxurious hotels overlooking the Nile in the heart of Garden City, offering world-class services and stunning views',
                'image_url'        => 'places/four_seasons.jpg',
                'is_free'          => false,
                'price_ar'         => '١٧٠٠٠ - ٤٥٠٠٠ جنيه / ليلة',
                'price_en'         => '17000 - 45000 EGP / night',
                'price_number'     => 31000.00,
                'working_hours_ar' => 'مفتوح ٢٤ ساعة',
                'working_hours_en' => 'Open 24 hours',
                'location_ar'      => 'جاردن سيتي',
                'location_en'      => 'Garden City',
                'latitude'         => 30.0380,
                'longitude'        => 31.2310,
                'rating_avg'       => 0,
                'total_bookings'   => 0,
                'activities_ar'    => [
                    'الاسترخاء في حمام السباحة المطل على النيل',
                    'الاستمتاع بخدمات السبا الفاخرة',
                    'تناول الطعام في المطاعم العالمية',
                ],
                'activities_en'    => [
                    'Relax in the Nile-view swimming pool',
                    'Enjoy luxury spa services',
                    'Dine at international restaurants',
                ],
                'is_active'        => true,
                'category'         => 'hotel',
            ],

            // ── Hotel 2: Marriott Mena House ──────────
            [
                'name_ar'          => 'ماريوت مينا هاوس',
                'name_en'          => 'Marriott Mena House Hotel',
                'description_ar'   => 'فندق تاريخي أسطوري يقع على بُعد خطوات من أهرامات الجيزة، بُني عام ١٨٦٩ وأستضاف ملوكاً ورؤساء من حول العالم',
                'description_en'   => 'A legendary historic hotel steps away from the Giza Pyramids, built in 1869 and hosted kings and presidents from around the world',
                'image_url'        => 'places/mena_house.jpg',
                'is_free'          => false,
                'price_ar'         => '١١٠٠٠ - ٢٨٠٠٠ جنيه / ليلة',
                'price_en'         => '11000 - 28000 EGP / night',
                'price_number'     => 20000.00,
                'working_hours_ar' => 'مفتوح ٢٤ ساعة',
                'working_hours_en' => 'Open 24 hours',
                'location_ar'      => 'الجيزة',
                'location_en'      => 'Giza',
                'latitude'         => 29.9875,
                'longitude'        => 31.1340,
                'rating_avg'       => 0,
                'total_bookings'   => 0,
                'activities_ar'    => [
                    'مشاهدة الأهرامات من غرفتك مباشرة',
                    'السباحة في حمام السباحة التاريخي',
                    'الاستمتاع بالحدائق الملكية الواسعة',
                ],
                'activities_en'    => [
                    'View the Pyramids directly from your room',
                    'Swim in the historic swimming pool',
                    'Enjoy the vast royal gardens',
                ],
                'is_active'        => true,
                'category'         => 'hotel',
            ],

            // ── Hotel 3: Cairo Marriott Hotel ─────────
            [
                'name_ar'          => 'فندق ماريوت القاهرة',
                'name_en'          => 'Cairo Marriott Hotel & Omar Khayyam Casino',
                'description_ar'   => 'قصر تاريخي في الزمالك بُني لاستقبال الإمبراطورة أوجيني عام ١٨٦٩، يمزج بين الرقي التاريخي والخدمات الحديثة',
                'description_en'   => 'Historic palace in Zamalek built to receive Empress Eugenie in 1869, blending historic elegance with modern services',
                'image_url'        => 'places/cairo_marriott.jpg',
                'is_free'          => false,
                'price_ar'         => '٦٥٠٠ - ١٤٠٠٠ جنيه / ليلة',
                'price_en'         => '6500 - 14000 EGP / night',
                'price_number'     => 10000.00,
                'working_hours_ar' => 'مفتوح ٢٤ ساعة',
                'working_hours_en' => 'Open 24 hours',
                'location_ar'      => 'الزمالك',
                'location_en'      => 'Zamalek',
                'latitude'         => 30.0589,
                'longitude'        => 31.2218,
                'rating_avg'       => 0,
                'total_bookings'   => 0,
                'activities_ar'    => [
                    'الإقامة في قصر تاريخي عمره ١٥٠ سنة',
                    'الاستمتاع بحدائق القصر الشهيرة',
                    'تناول الطعام في مطعم عمر الخيام',
                ],
                'activities_en'    => [
                    'Stay in a 150-year-old historic palace',
                    'Enjoy the famous palace gardens',
                    'Dine at Omar Khayyam restaurant',
                ],
                'is_active'        => true,
                'category'         => 'hotel',
            ],

            // ── Hotel 4: Sofitel Cairo Nile El Gezirah
            [
                'name_ar'          => 'سوفيتيل القاهرة نايل الجزيرة',
                'name_en'          => 'Sofitel Cairo Nile El Gezirah',
                'description_ar'   => 'فندق فاخر على جزيرة الزمالك يوفر إطلالات ٣٦٠ درجة على النيل والقاهرة، يجمع الأناقة الفرنسية بالضيافة المصرية',
                'description_en'   => 'Luxury hotel on Zamalek island offering 360-degree views of the Nile and Cairo, combining French elegance with Egyptian hospitality',
                'image_url'        => 'places/sofitel.jpg',
                'is_free'          => false,
                'price_ar'         => '٨٥٠٠ - ١٨٠٠٠ جنيه / ليلة',
                'price_en'         => '8500 - 18000 EGP / night',
                'price_number'     => 13000.00,
                'working_hours_ar' => 'مفتوح ٢٤ ساعة',
                'working_hours_en' => 'Open 24 hours',
                'location_ar'      => 'الزمالك',
                'location_en'      => 'Zamalek',
                'latitude'         => 30.0547,
                'longitude'        => 31.2228,
                'rating_avg'       => 0,
                'total_bookings'   => 0,
                'activities_ar'    => [
                    'الاستمتاع بإطلالة ٣٦٠ درجة على القاهرة',
                    'الاسترخاء في السبا الفرنسي',
                    'السباحة في حمام السباحة المميز',
                ],
                'activities_en'    => [
                    'Enjoy 360-degree views of Cairo',
                    'Relax in the French spa',
                    'Swim in the distinctive pool',
                ],
                'is_active'        => true,
                'category'         => 'hotel',
            ],

            // ── Hotel 5: Conrad Cairo ──────────────────
            [
                'name_ar'          => 'فندق كونراد القاهرة',
                'name_en'          => 'Conrad Cairo Hotel',
                'description_ar'   => 'فندق فاخر في قلب القاهرة يطل على النيل مباشرة، يقدم غرفاً فاخرة وخدمات عالمية المستوى للأعمال والسياحة',
                'description_en'   => 'Luxury hotel in the heart of Cairo overlooking the Nile, offering luxurious rooms and world-class services for business and tourism',
                'image_url'        => 'places/conrad.jpg',
                'is_free'          => false,
                'price_ar'         => '٧٠٠٠ - ١٤٥٠٠ جنيه / ليلة',
                'price_en'         => '7000 - 14500 EGP / night',
                'price_number'     => 10000.00,
                'working_hours_ar' => 'مفتوح ٢٤ ساعة',
                'working_hours_en' => 'Open 24 hours',
                'location_ar'      => 'بولاق',
                'location_en'      => 'Boulaq',
                'latitude'         => 30.0566,
                'longitude'        => 31.2287,
                'rating_avg'       => 0,
                'total_bookings'   => 0,
                'activities_ar'    => [
                    'الإقامة في غرف مطلة على النيل',
                    'الاستمتاع بمركز اللياقة البدنية',
                    'حضور فعاليات الأعمال والمؤتمرات',
                ],
                'activities_en'    => [
                    'Stay in Nile-view rooms',
                    'Enjoy the fitness center',
                    'Attend business events and conferences',
                ],
                'is_active'        => true,
                'category'         => 'hotel',
            ],

            // ── Hotel 6: Kempinski Nile Hotel ─────────
            [
                'name_ar'          => 'فندق كمبينسكي نايل القاهرة',
                'name_en'          => 'Kempinski Nile Hotel Cairo',
                'description_ar'   => 'فندق فاخر يطل على النيل في جاردن سيتي، يتميز بديكوراته الأنيقة وخدماته المتميزة وموقعه المركزي المثالي',
                'description_en'   => 'Luxury hotel overlooking the Nile in Garden City, distinguished by its elegant decor, exceptional services, and ideal central location',
                'image_url'        => 'places/kempinski.jpg',
                'is_free'          => false,
                'price_ar'         => '٨٠٠٠ - ١٦٠٠٠ جنيه / ليلة',
                'price_en'         => '8000 - 16000 EGP / night',
                'price_number'     => 12000.00,
                'working_hours_ar' => 'مفتوح ٢٤ ساعة',
                'working_hours_en' => 'Open 24 hours',
                'location_ar'      => 'جاردن سيتي',
                'location_en'      => 'Garden City',
                'latitude'         => 30.0362,
                'longitude'        => 31.2298,
                'rating_avg'       => 0,
                'total_bookings'   => 0,
                'activities_ar'    => [
                    'الاسترخاء في سبا كمبينسكي الفاخر',
                    'تناول العشاء في المطعم المطل على النيل',
                    'الاستمتاع بالخدمات الشخصية المميزة',
                ],
                'activities_en'    => [
                    'Relax in the luxurious Kempinski spa',
                    'Dine at the Nile-view restaurant',
                    'Enjoy personalized distinguished services',
                ],
                'is_active'        => true,
                'category'         => 'hotel',
            ],

            // ── Hotel 7: Steigenberger El Tahrir ──────
            [
                'name_ar'          => 'فندق شتايجنبرجر التحرير',
                'name_en'          => 'Steigenberger Hotel El Tahrir',
                'description_ar'   => 'فندق فاخر في قلب القاهرة يطل على ميدان التحرير والنيل، يقدم تجربة إقامة فريدة في أكثر مناطق القاهرة حيوية',
                'description_en'   => 'Luxury hotel in the heart of Cairo overlooking Tahrir Square and the Nile, offering a unique stay experience in Cairo\'s most vibrant area',
                'image_url'        => 'places/steigenberger.jpg',
                'is_free'          => false,
                'price_ar'         => '٥٥٠٠ - ١٢٠٠٠ جنيه / ليلة',
                'price_en'         => '5500 - 12000 EGP / night',
                'price_number'     => 8500.00,
                'working_hours_ar' => 'مفتوح ٢٤ ساعة',
                'working_hours_en' => 'Open 24 hours',
                'location_ar'      => 'التحرير',
                'location_en'      => 'Tahrir',
                'latitude'         => 30.0444,
                'longitude'        => 31.2357,
                'rating_avg'       => 0,
                'total_bookings'   => 0,
                'activities_ar'    => [
                    'الإقامة بجوار ميدان التحرير التاريخي',
                    'الاستمتاع بإطلالة النيل من الأدوار العليا',
                    'الوصول السهل للمتحف المصري',
                ],
                'activities_en'    => [
                    'Stay next to the historic Tahrir Square',
                    'Enjoy Nile views from upper floors',
                    'Easy access to the Egyptian Museum',
                ],
                'is_active'        => true,
                'category'         => 'hotel',
            ],
        ];

        foreach ($places as $place) {
            Place::create($place);
        }

        $this->command->info('✅ 7 restaurants + 7 hotels seeded successfully!');
    }
}