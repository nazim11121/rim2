<?php

namespace Database\Seeders;

use App\Models\Admin\Faq;
use App\Models\Admin\Gallery;
use App\Models\Admin\JournalPost;
use App\Models\Admin\Promo;
use App\Models\Admin\Setting;
use App\Models\Admin\Stay;
use Illuminate\Database\Seeder;

class BonomaliContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Seeds real brand copy for Bonomali Mangrove Resort, extracted verbatim
     * from the resort's reference-design project
     * (D:\wamp64\www\Bonomali full website build). Not fabricated.
     */
    public function run(): void
    {
        $this->seedFaqs();
        $this->seedGallery();
        $this->seedJournal();
        $this->seedStays();
        $this->seedPromos();
        $this->seedSettings();
    }

    /**
     * Real, currently-published rates and copy for the 5 stays (4 cottages plus
     * the Pod). Not fabricated — this is the resort's own live pricing, carried
     * over from the reference project (D:\wamp64\www\bonomali-backend).
     *
     * weekday_rate = weekend_rate x 0.85, rounded to whole taka, pre-computed
     * here rather than at seed time (see QuoteService's rounding-order comment
     * for why every money figure is rounded once and never re-derived).
     */
    protected function seedStays(): void
    {
        if (Stay::count() > 0) {
            return;
        }

        $stays = [
            [
                'slug' => 'golpata', 'name' => 'Golpata', 'meaning' => 'the thatch palm',
                'min_guests' => 1, 'max_guests' => 3, 'pricing_mode' => 'per_person_occupancy', 'whole_unit_only' => false,
                'sort_order' => 1, 'hero_image' => 'assets/bonomali/imagery/cottage-canal-dusk.jpg',
                'description' => 'The shelter of the Sundarbans, made domestic. A balcony, a swing, and the canal at first light.',
                'tiers' => [
                    ['from_guests' => 1, 'weekday_rate' => 7225, 'weekend_rate' => 8500],
                    ['from_guests' => 2, 'weekday_rate' => 5100, 'weekend_rate' => 6000],
                    ['from_guests' => 3, 'weekday_rate' => 4038, 'weekend_rate' => 4750],
                ],
            ],
            [
                'slug' => 'moual', 'name' => 'Moual', 'meaning' => 'the honey-gatherer',
                'min_guests' => 1, 'max_guests' => 3, 'pricing_mode' => 'per_person_occupancy', 'whole_unit_only' => false,
                'sort_order' => 2, 'hero_image' => 'assets/bonomali/imagery/balcony-desk-canal.jpg',
                'description' => 'Warm wood and honey light. For the ones who came to slow down, not to stop.',
                'tiers' => [
                    ['from_guests' => 1, 'weekday_rate' => 7225, 'weekend_rate' => 8500],
                    ['from_guests' => 2, 'weekday_rate' => 5100, 'weekend_rate' => 6000],
                    ['from_guests' => 3, 'weekday_rate' => 4038, 'weekend_rate' => 4750],
                ],
            ],
            [
                'slug' => 'arronyok', 'name' => 'Arronyok', 'meaning' => 'of the forest',
                'min_guests' => 1, 'max_guests' => 3, 'pricing_mode' => 'per_person_occupancy', 'whole_unit_only' => false,
                'sort_order' => 3, 'hero_image' => 'assets/bonomali/imagery/walkway-palms.jpg',
                'description' => 'The forest at your doorstep, and a path that leads only to quiet.',
                'tiers' => [
                    ['from_guests' => 1, 'weekday_rate' => 7225, 'weekend_rate' => 8500],
                    ['from_guests' => 2, 'weekday_rate' => 5100, 'weekend_rate' => 6000],
                    ['from_guests' => 3, 'weekday_rate' => 4038, 'weekend_rate' => 4750],
                ],
            ],
            [
                'slug' => 'chitra', 'name' => 'Chitra', 'meaning' => 'the spotted deer',
                'min_guests' => 1, 'max_guests' => 3, 'pricing_mode' => 'per_person_occupancy', 'whole_unit_only' => false,
                'sort_order' => 4, 'hero_image' => 'assets/bonomali/imagery/cottage-interior.jpg',
                'description' => 'Quiet as the deer at the water\'s edge. Two cups, two chairs, one forest, just for you.',
                'tiers' => [
                    ['from_guests' => 1, 'weekday_rate' => 7225, 'weekend_rate' => 8500],
                    ['from_guests' => 2, 'weekday_rate' => 5100, 'weekend_rate' => 6000],
                    ['from_guests' => 3, 'weekday_rate' => 4038, 'weekend_rate' => 4750],
                ],
            ],
            [
                'slug' => 'pod', 'name' => 'The Pod', 'meaning' => 'three rooms, one roof',
                'min_guests' => 6, 'max_guests' => 10, 'pricing_mode' => 'per_person_group', 'whole_unit_only' => true,
                'sort_order' => 5, 'hero_image' => 'assets/bonomali/imagery/cottages-night.jpg',
                'description' => 'For the whole party: six to ten, under one roof, with one long table by the canal.',
                'tiers' => [
                    ['from_guests' => 6, 'weekday_rate' => 2450, 'weekend_rate' => 2750],
                    ['from_guests' => 8, 'weekday_rate' => 2250, 'weekend_rate' => 2450],
                    ['from_guests' => 10, 'weekday_rate' => 2150, 'weekend_rate' => 2350],
                ],
            ],
        ];

        foreach ($stays as $row) {
            $tiers = $row['tiers'];
            unset($row['tiers']);

            $stay = Stay::create(array_merge($row, ['is_published' => true]));

            foreach ($tiers as $tier) {
                $stay->rateTiers()->create($tier);
            }
        }
    }

    /**
     * 10 real promo codes carried over from the resort's reference project
     * (D:\wamp64\www\bonomali-backend).
     */
    protected function seedPromos(): void
    {
        if (Promo::count() > 0) {
            return;
        }

        $promos = [
            ['code' => 'BONOMALI10', 'type' => 'pct', 'value' => 0.10, 'label' => '10% off', 'starts_on' => null, 'ends_on' => '2026-12-31', 'min_nights' => null, 'stay_slugs' => null],
            ['code' => 'MONSOON15', 'type' => 'pct', 'value' => 0.15, 'label' => 'Monsoon offer: 15% off', 'starts_on' => '2026-06-01', 'ends_on' => '2026-09-30', 'min_nights' => null, 'stay_slugs' => null],
            ['code' => 'FIRSTLIGHT', 'type' => 'flat', 'value' => 1000, 'label' => '৳1,000 off', 'starts_on' => null, 'ends_on' => '2026-12-31', 'min_nights' => null, 'stay_slugs' => null],
            ['code' => 'STAY3', 'type' => 'pct', 'value' => 0.12, 'label' => '12% off, 3 nights or more', 'starts_on' => null, 'ends_on' => null, 'min_nights' => 3, 'stay_slugs' => null],
            ['code' => 'WEEKDAY20', 'type' => 'pct', 'value' => 0.20, 'label' => '20% off midweek stays', 'starts_on' => null, 'ends_on' => null, 'min_nights' => 2, 'stay_slugs' => null],
            ['code' => 'GROUPPOD', 'type' => 'pct', 'value' => 0.10, 'label' => '10% off the Pod', 'starts_on' => null, 'ends_on' => null, 'min_nights' => null, 'stay_slugs' => ['pod']],
            ['code' => 'HONEYMOON', 'type' => 'flat', 'value' => 1500, 'label' => '৳1,500 honeymoon gift', 'starts_on' => null, 'ends_on' => null, 'min_nights' => null, 'stay_slugs' => null],
            ['code' => 'DHAKA500', 'type' => 'flat', 'value' => 500, 'label' => '৳500 off', 'starts_on' => null, 'ends_on' => null, 'min_nights' => null, 'stay_slugs' => null],
            ['code' => 'WINTER26', 'type' => 'pct', 'value' => 0.10, 'label' => 'Winter season: 10% off', 'starts_on' => '2026-11-01', 'ends_on' => '2027-02-28', 'min_nights' => null, 'stay_slugs' => null],
            ['code' => 'RETURNGUEST', 'type' => 'pct', 'value' => 0.15, 'label' => 'Returning guest: 15% off', 'starts_on' => null, 'ends_on' => null, 'min_nights' => null, 'stay_slugs' => null],
        ];

        foreach ($promos as $promo) {
            Promo::create(array_merge($promo, ['is_active' => true]));
        }
    }

    protected function seedSettings(): void
    {
        Setting::put('vat_rate', 0.15);
        Setting::put('weekday_discount', 0.15);
        Setting::put('weekend_days', [5, 6]);
        Setting::put('property_max_guests', 20);
    }

    protected function seedFaqs(): void
    {
        if (Faq::count() > 0) {
            return;
        }

        $faqs = [
            // booking
            ['category' => 'booking', 'priority' => 1, 'question' => 'How do we book?', 'answer' => 'Use the booking bar on any page, send the enquiry form, message us on WhatsApp, or call 01991 505070. We reply ourselves within a day. There is no call centre.'],
            ['category' => 'booking', 'priority' => 2, 'question' => 'What does a cottage cost?', 'answer' => 'For Friday, Saturday and holidays: ৳8,500 for one guest alone, ৳6,000 per person with two sharing, or ৳4,750 per person with three. Sunday to Thursday is 15% less. VAT of 15% is added at checkout.'],
            ['category' => 'booking', 'priority' => 3, 'question' => 'Is VAT included in the price I see?', 'answer' => 'No. Rates are shown before VAT, and 15% VAT is added at checkout so you always see both numbers before you confirm.'],
            ['category' => 'booking', 'priority' => 4, 'question' => 'What is included in the rate?', 'answer' => 'Three meals a day from the village kitchen, the boat transfer between Mongla and the resort both ways, and a canal cruise. Stays here are packages, not room-only.'],
            ['category' => 'booking', 'priority' => 5, 'question' => 'How do we pay?', 'answer' => 'We confirm your dates first, then send payment details for a deposit. The balance is settled with us directly. There is no ATM on this side of the water, so bring some cash for the village.'],
            ['category' => 'booking', 'priority' => 6, 'question' => 'What is the cancellation policy?', 'answer' => 'Write to us as early as you can and we will do what we reasonably can, including moving your dates. Because the property is small, a late cancellation is a room we cannot refill, so please tell us as soon as your plans change.'],
            ['category' => 'booking', 'priority' => 7, 'question' => 'Do you have discount codes?', 'answer' => 'Sometimes, usually seasonal. If you have one, enter it at checkout and the saving is shown before you confirm. Sunday to Thursday is already 15% below the weekend rate.'],

            // journey
            ['category' => 'journey', 'priority' => 1, 'question' => 'How do we get there from Dhaka?', 'answer' => 'Bus from Dhaka to Katakhali, CNG from Katakhali to Mongla, then our own boat from Mongla jetty. Plan a half-day door to door. Send us your bus times when you book and we will time the boat to them.'],
            ['category' => 'journey', 'priority' => 2, 'question' => 'How far is it from Khulna?', 'answer' => 'Roughly two hours by road to Mongla, then about thirty minutes on the water. Some guests take a night in Khulna first, which turns a half-day of travel into a gentler two.'],
            ['category' => 'journey', 'priority' => 3, 'question' => 'Can we drive all the way to the resort?', 'answer' => 'No. The road ends at Mongla and the last leg is on the water. Aim for the jetty, not the ferry ghat, which is a different place and a common mistake.'],
            ['category' => 'journey', 'priority' => 4, 'question' => 'When should we reach Mongla?', 'answer' => 'With daylight left, so you cross in the light and arrive in the golden hour. Check-in is at one in the afternoon.'],

            // stays
            ['category' => 'stays', 'priority' => 1, 'question' => 'What time is check-in and check-out?', 'answer' => 'Check in at one in the afternoon, check out at eleven in the morning. Everything between those hours is yours.'],
            ['category' => 'stays', 'priority' => 2, 'question' => 'How many cottages are there?', 'answer' => 'Four air-conditioned couple cottages, Golpata, Moual, Arronyok and Chitra, each for one to three guests, plus the pod, three rooms for six to ten. Twenty guests at most on the whole property.'],
            ['category' => 'stays', 'priority' => 3, 'question' => 'Can we bring children? Are extra beds available?', 'answer' => 'Yes. A cottage takes up to three guests, so a couple with one child fits. For a family, the pod is the better choice since everybody is under one roof. Tell us ages when you book, and note the canal is unfenced.'],
            ['category' => 'stays', 'priority' => 4, 'question' => 'Is there electricity and wifi?', 'answer' => 'Electricity yes, and the rooms are air-conditioned. Mobile data is workable but not fast, and we do not promise reliable wifi. Most guests find the second day easier than the first.'],
            ['category' => 'stays', 'priority' => 5, 'question' => 'Are the paths lit at night?', 'answer' => 'No, deliberately, so the night sky stays the night sky. Bring a torch. This is the one thing guests most often forget.'],

            // food
            ['category' => 'food', 'priority' => 1, 'question' => 'Are meals included?', 'answer' => 'Yes, three a day, from the village kitchen. Lunch at two, barbecue dinner by the canal at nine, breakfast at half past eight.'],
            ['category' => 'food', 'priority' => 2, 'question' => 'Can you cook vegetarian, or for allergies?', 'answer' => 'Yes, with notice. Tell us when you book rather than on arrival. The kitchen is small and cooks from what the fields and the morning boats brought, so a day of warning makes all the difference.'],
            ['category' => 'food', 'priority' => 3, 'question' => 'Is there a menu to choose from?', 'answer' => 'No. Each meal is two or three dishes decided by the day. No buffet, no menu of forty things. If something does not suit you, say so and we will cook around it.'],

            // forest
            ['category' => 'forest', 'priority' => 1, 'question' => 'Will we see a tiger?', 'answer' => 'Almost certainly not, and we do not sell the possibility. Bonomali is on the edge of the forest, not inside it. What you will see is first light, kingfishers, herons, monkeys, and often spotted deer at the water.'],
            ['category' => 'forest', 'priority' => 2, 'question' => 'Is this a Sundarbans tour?', 'answer' => 'No. It is a private resort with cottages, meals and a canal cruise. Deep forest entry is a separate thing, booked with a licensed operator. Many guests do both.'],
            ['category' => 'forest', 'priority' => 3, 'question' => 'What is there to do?', 'answer' => 'Less than you would plan, on purpose. Arrival at one, lunch at two, the canal cruise at four, barbecue at nine. Then the grey half-hour just after five in the morning, breakfast at half past eight, and check-out at eleven.'],
            ['category' => 'forest', 'priority' => 4, 'question' => 'When is the best time to visit?', 'answer' => 'November to February is gentlest: cool, dry and clear. March to May is hot and quietest. The monsoon is greenest and nothing is cancelled for rain.'],

            // practical
            ['category' => 'practical', 'priority' => 1, 'question' => 'What should we bring?', 'answer' => 'A torch, long sleeves and repellent for dusk, shoes you can wet at the jetty, a light layer for the boat in the cool months, a photo ID, and some cash. Meals are included, so leave the snacks.'],
            ['category' => 'practical', 'priority' => 2, 'question' => 'Are there mosquitoes?', 'answer' => 'Yes, more in the wet months and mostly around dusk. The cottages are screened and air-conditioned so nights are comfortable. Long sleeves and repellent handle the sunset hour.'],
            ['category' => 'practical', 'priority' => 3, 'question' => 'Is it safe?', 'answer' => 'Yes. You are in a working village with staff on site through the night, not alone in the forest. The two things to respect are the water, since the canal is unfenced and tidal, and the dark, which is why you want a torch.'],
            ['category' => 'practical', 'priority' => 4, 'question' => 'Is there a doctor or pharmacy nearby?', 'answer' => 'Basic help is available in the village and Mongla is about thirty minutes by boat. Bring any regular medication with you, and tell us at check-in if you have a condition we should know about.'],
            ['category' => 'practical', 'priority' => 5, 'question' => 'Can we bring alcohol?', 'answer' => 'We do not serve it. Please respect that this is a village on the edge of a protected forest, and keep the evening in the spirit of the place.'],
        ];

        foreach ($faqs as $faq) {
            Faq::create(array_merge($faq, ['status' => 1]));
        }
    }

    protected function seedGallery(): void
    {
        if (Gallery::count() > 0) {
            return;
        }

        $items = [
            ['title' => 'First light, from the deck', 'image' => 'assets/bonomali/imagery/swing-deck-wide.jpg', 'category' => 'canal', 'caption' => 'A swing on the deck, first light'],
            ['title' => 'Golpata at dusk', 'image' => 'assets/bonomali/imagery/cottage-canal-dusk.jpg', 'category' => 'cottage', 'caption' => 'Golpata, canal-side at dusk'],
            ['title' => 'A desk at the window', 'image' => 'assets/bonomali/imagery/balcony-desk-canal.jpg', 'category' => 'cottage', 'caption' => 'A desk at the window, Moual cottage'],
            ['title' => 'The cottages after dark', 'image' => 'assets/bonomali/imagery/cottages-night.jpg', 'category' => 'night', 'caption' => 'The cottages after dark'],
            ['title' => 'The jetty', 'image' => 'assets/bonomali/imagery/jetty-deck.jpg', 'category' => 'canal', 'caption' => 'The jetty reaching into the canal'],
            ['title' => 'Warm wood, quiet light', 'image' => 'assets/bonomali/imagery/cottage-interior.jpg', 'category' => 'cottage', 'caption' => 'Chitra cottage, interior'],
            ['title' => 'An evening table', 'image' => 'assets/bonomali/imagery/hariken-lantern.jpg', 'category' => 'night', 'caption' => 'An evening table by the canal'],
            ['title' => 'The path through the palms', 'image' => 'assets/bonomali/imagery/walkway-palms.jpg', 'category' => 'forest', 'caption' => 'The path through the palms, Dangmari'],
            ['title' => 'A chair that faces the forest', 'image' => 'assets/bonomali/imagery/swing-chair.jpg', 'category' => 'forest', 'caption' => 'A swing chair facing the mangrove forest'],
            ['title' => 'The deck after dark', 'image' => 'assets/bonomali/imagery/deck-night.jpg', 'category' => 'night', 'caption' => 'The deck, looking over the canal after dark'],
        ];

        foreach ($items as $i => $item) {
            Gallery::create(array_merge($item, ['priority' => $i + 1, 'status' => 1]));
        }
    }

    protected function seedJournal(): void
    {
        if (JournalPost::count() > 0) {
            return;
        }

        $posts = [
            [
                'slug' => 'how-to-get-here',
                'title' => 'How to get to the Sundarbans from Dhaka.',
                'category' => 'Guides',
                'image' => 'assets/bonomali/imagery/jetty-deck.jpg',
                'published_at' => '2026-06-18',
                'excerpt' => 'Bus to Katakhali, CNG to Mongla, then our own boat. Here is every leg in order, with honest timings, and why the last one is the leg you remember.',
                'body' => <<<'HTML'
<p><em>Bus to Katakhali. CNG to Mongla. Then our boat. Plan a half-day, and let the last leg be the one you remember.</em></p>
<p>Bonomali Mangrove Resort sits in the village of Dangmari, West Dhangmari, Banishanta, in Dacope upazila of Khulna, on the edge of the world's largest mangrove forest. You cannot drive to the door. The road ends at Mongla, and the river is the corridor from there. Three legs, in order.</p>
<h2>Leg one: Dhaka to Katakhali, by bus</h2>
<p>The long leg, and the easy one to arrange. Buses run south from Dhaka through the day and overnight; an overnight departure buys you a full first day at the resort, which is the better trade if you can sleep sitting up. Tell us your bus and we will time the boat to it.</p>
<h2>Leg two: Katakhali to Mongla, by CNG</h2>
<p>A short hop. Mongla is a working port town, and you are aiming for the jetty, not the ferry ghat, which is a different place and a common mistake. This is where the road ends.</p>
<h2>Leg three: Mongla to Bonomali, by our boat</h2>
<p>From Mongla jetty, Bonomali's own boat brings you in. We arrange the timing with your booking, and the transfer is included in every package. There is nothing to negotiate at the jetty and no separate fare to pay.</p>
<p>Do not treat this leg as transit. The banks narrow, the noise of the port falls away, and somewhere in the middle of it the trip changes character. Most guests stop talking without deciding to. The boat is part of the welcome. Bring a book you don't mind not reading.</p>
<div class="bm-callout"><p>Plan a half-day, door to door. Aim to reach Mongla jetty with daylight left: you cross in the light, arrive in the golden hour, and have tea on the balcony before dark.</p></div>
<h2>Coming from Khulna instead</h2>
<p>If you are starting from Khulna rather than Dhaka, make for Mongla and the same jetty; the boat leg is unchanged. Guests who arrive by road often build in a night in Khulna first. It turns a half-day of travel into a gentler two.</p>
<h2>Why the journey is the point</h2>
<p>It is a real journey, and we say so plainly rather than shortening it in the telling. It is also exactly why the place is quiet when you arrive: why there are four cottages and not forty, set far enough apart that none looks into another, and twenty guests at most on the whole property.</p>
<p class="bm-article-close">Bus from Dhaka to Katakhali, CNG to Mongla, then Bonomali's own boat from the jetty. Allow half a day door to door. That last stretch of water is the real welcome.</p>
HTML,
            ],
            [
                'slug' => 'when-to-visit',
                'title' => 'When to visit the Sundarbans.',
                'category' => 'Guides',
                'image' => 'assets/bonomali/imagery/balcony-desk-canal.jpg',
                'published_at' => '2026-06-02',
                'excerpt' => 'There is no closed season here, only different ones. A month-by-month read of the weather, the light and the water.',
                'body' => <<<'HTML'
<p><em>There is no closed season here, only different ones. A month-by-month read of the weather, the light and the water.</em></p>
<p>The honest answer is that it depends what you came for. If you came to sit still and watch light move on water, every month delivers that. What changes is the temperature, the sky, and how the canal behaves.</p>
<h2>November to February, the gentlest months</h2>
<p>Cool, dry and clear. Mornings carry mist off the water, the middle of the day is warm without being heavy, and the nights are cool enough for a light layer on the balcony. This is when most people come, and if you only visit once, come now.</p>
<p>It is also the busiest window, which for us means four cottages booked rather than two. Reserve earlier for December and January, particularly for a Friday or Saturday.</p>
<h2>March to May, the warm months</h2>
<p>Hot and bright, and the forest goes quieter in the middle of the day. Plan around it rather than through it: the dawn boat, then shade and the swing until the light softens. The compensation is that these are the emptiest weeks of the year.</p>
<h2>June to September, the monsoon</h2>
<p>The season people avoid, and the one we would choose. The forest is at its greenest, the canal is full, and rain on a thatch roof from under a dry balcony is the closest thing to silence we can offer. Bring a layer, expect an afternoon indoors, and take the swing anyway.</p>
<div class="bm-callout"><p>Rain does not cancel anything here. The canal cruise moves with the weather rather than against it, and the kitchen keeps its hours whatever the sky is doing.</p></div>
<h2>October, the turn</h2>
<p>The rain thins out, the air loses its weight, and the light starts to go gold in the evenings. A short window, and quietly one of the best. If you want the cool-season light without the cool-season company, this is it.</p>
<h2>What does not change</h2>
<p>The half-hour just after five, when the canal is still grey and the forest has not decided to wake. That is on offer every single morning of the year, and it is the reason we tell people the season matters less than they think.</p>
<p class="bm-article-close">November to February is the gentlest season in the Sundarbans, March to May the warmest and quietest, and the monsoon the greenest. The dawn half-hour is there every month of the year.</p>
HTML,
            ],
            [
                'slug' => 'the-grey-half-hour',
                'title' => 'The grey half-hour.',
                'category' => 'The forest',
                'image' => 'assets/bonomali/imagery/cottage-canal-dusk.jpg',
                'published_at' => '2026-05-30',
                'excerpt' => 'There is a half-hour, just after five, when the canal is still grey and the forest has not decided to wake.',
                'body' => <<<'HTML'
<p><em>There is a half-hour, just after five, when the canal is still grey and the forest has not decided to wake.</em></p>
<p>Nobody books a resort for a half-hour. But if you asked us to name the one thing we built this place around, it would be this one, and we would not have to think about it.</p>
<h2>What it looks like</h2>
<p>The light arrives before the sun does. For about thirty minutes the water holds no colour at all, just a flat pewter, and the far bank is a suggestion rather than a line. Nothing is golden yet. It is the least photogenic and the most affecting part of the day.</p>
<h2>What it sounds like</h2>
<p>This is the part people are not ready for. Not silence, but a very particular kind of ordered noise: one bird starting, then a second answering from further off, then the water moving against the bank because something went into it. No engines. No road. No other guests, because they are asleep.</p>
<div class="bm-callout"><p>You do not need to book anything for this. Set an alarm for a quarter to five, take the blanket off the bed, and sit on your own balcony. Two cups, two chairs, one forest.</p></div>
<h2>Why the cottages are placed the way they are</h2>
<p>Every cottage is set far enough from the next that none looks into another, and every balcony faces the water. That is not a view decision, it is a half-hour decision. If you could see another balcony from yours, you would be aware of other people, and the whole thing would be worth less.</p>
<h2>Then it ends</h2>
<p>The sun clears the treeline, everything turns gold, and it becomes a beautiful morning like beautiful mornings elsewhere. Breakfast is at half past eight and nobody will hurry you to it. But the grey part does not come back until tomorrow, and it is the part you will describe when you get home.</p>
<p class="bm-article-close">Just after five in the Sundarbans the canal holds no colour and the forest has not woken. It lasts about half an hour, it happens from your own balcony, and it is the reason to come.</p>
HTML,
            ],
            [
                'slug' => 'village-kitchen',
                'title' => 'What we cook, and who grows it.',
                'category' => 'The village',
                'image' => 'assets/bonomali/imagery/hariken-lantern.jpg',
                'published_at' => '2026-05-12',
                'excerpt' => 'No buffet. No menu of forty things. Two or three dishes, made well, eaten slowly by the canal.',
                'body' => <<<'HTML'
<p><em>No buffet. No menu of forty things. Two or three dishes, made well, eaten slowly by the canal.</em></p>
<p>Three meals a day are included in every stay, which means we are cooking for you whether or not you thought about it. Here is what that actually looks like, because it is not what a resort buffet looks like and we would rather you knew before you arrived.</p>
<h2>Two or three dishes, not forty</h2>
<p>A meal here is rice, a fish or a vegetable done properly, a dal, and something sharp on the side. That is it. The kitchen is small and the cook is from the village, and both of those facts are on purpose. Choice is not the luxury we are selling.</p>
<h2>Where it comes from</h2>
<p>The fish comes off the morning boats. The rice and the greens come from Dangmari's fields and the plot behind the kitchen. Nothing is trucked in from Khulna because it does not need to be. What that means in practice is that the menu is decided by the day rather than by us.</p>
<div class="bm-callout"><p>Tell us about allergies, dietary needs or a child who eats plainly when you book, not on arrival. A small kitchen can accommodate almost anything with a day of notice and very little on the spot.</p></div>
<h2>The barbecue at nine</h2>
<p>Dinner is a barbecue by the canal, and it is the one meal that is an event rather than a meal. The grill goes on at nine, there is one long table, and the forest has gone entirely to sound by then. Whether you sit with the other guests or take a plate back to your own balcony is genuinely up to you.</p>
<h2>Breakfast, unhurried</h2>
<p>Half past eight, hot and simple, and served when you surface rather than at a bell. If you were up for the grey half-hour and went back to sleep, that is the correct way to use the morning and the kitchen will not mind.</p>
<h2>Why it matters who cooks</h2>
<p>The staff and the boatmen are neighbours, and the kitchen buys from the fields around it. When you stay, the village stays too. That is not a line for the website, it is the arrangement, and it is the difference between being built with a village and being built beside one.</p>
<p class="bm-article-close">Meals at Bonomali are two or three dishes from Dangmari's fields and morning boats, three times a day, included in every package. Dinner is a barbecue by the canal at nine.</p>
HTML,
            ],
            [
                'slug' => 'no-tiger-sightings',
                'title' => "Why we don't sell tiger sightings.",
                'category' => 'The forest',
                'image' => 'assets/bonomali/imagery/swing-chair.jpg',
                'published_at' => '2026-04-24',
                'excerpt' => 'Most Sundarbans tourism sells the chase. We sell presence, and we think it is the better trip.',
                'body' => <<<'HTML'
<p><em>Most Sundarbans tourism sells the chase. We sell presence, and we think it is the better trip.</em></p>
<p>If you are choosing between Sundarbans options, you have seen the promise: deep forest entry, a tiger if you are lucky, three days on a boat with forty other people looking in the same direction. We do not offer that, and this is the honest explanation rather than a polite one.</p>
<h2>The arithmetic of a tiger</h2>
<p>A Bengal tiger in the Sundarbans is a genuinely rare sighting. Anyone selling you one is selling you a probability dressed as an itinerary, and the usual outcome is three days of looking hard and a slightly disappointed flight home. We would rather promise you something we can actually deliver every single morning.</p>
<h2>What presence means here</h2>
<p>You do not enter the Sundarbans at Bonomali. You wake up to it. The forest is the view from your balcony, the canal is at your door, and the whole experience is available while sitting still with a cup of tea. Nothing to chase, nothing to be lucky about.</p>
<div class="bm-callout"><p>The category is different, not cheaper. Bonomali is a private resort on the edge of the forest, not a package boat tour into it. If you want deep forest entry, book that separately with a licensed operator, and stay here either side of it.</p></div>
<h2>What you will actually see</h2>
<p>Kingfishers, constantly. Herons working the shallows. Monkeys in the treeline. Spotted deer at the water in the early morning if the canal is quiet, which it usually is. Mudskippers and crabs on the bank at low water. And the light doing four completely different things between five in the morning and dusk.</p>
<h2>The canal cruise, in that spirit</h2>
<p>Every package includes a boat on the canal at four in the afternoon. It is a slow ride with the engine down more often than up, and the point of it is the banks closing in and the sound changing, not covering distance. If a deer is there, wonderful. If not, the ride was still the ride.</p>
<h2>Who this suits</h2>
<p>Couples and quiet travellers who want privacy, slowness, and a story that does not look like everyone else's. If your idea of a good trip is a full itinerary and a checklist, we will be the wrong choice, and we would rather say that now than have you find out from your own balcony.</p>
<p class="bm-article-close">Bonomali does not sell tiger sightings. It sells the forest as the view from your own balcony: first light, birds, deer at the water, and a canal cruise that is not in a hurry.</p>
HTML,
            ],
            [
                'slug' => 'dangmari',
                'title' => 'Dangmari, the village that hosts you.',
                'category' => 'The village',
                'image' => 'assets/bonomali/imagery/walkway-palms.jpg',
                'published_at' => '2026-04-08',
                'excerpt' => 'The kitchen is fed by local boats and fields. The boatmen are neighbours. This is what building with a village rather than beside it means.',
                'body' => <<<'HTML'
<p><em>The kitchen is fed by local boats and fields. The boatmen are neighbours. This is what building with a village rather than beside it means.</em></p>
<p>Bonomali is in West Dhangmari, in the union of Banishanta, in Dacope upazila of Khulna district. That string of names matters, because it is a real place with people in it, and we are guests here in a way that the word resort does not usually imply.</p>
<h2>What the village does</h2>
<p>Fishing and farming, mostly, on the last habitable strip before the forest takes over. The boats go out early and come back with what the water gave. The fields behind the houses do rice and greens. Both of those feed our kitchen, which is the simplest possible arrangement and also the whole point.</p>
<h2>Who you will meet</h2>
<p>The staff and the boatmen are from here. The person steering your boat in from Mongla lives a few minutes from where you will sleep. That has practical consequences: they know the water at every stage of the tide, and they know which bank the deer use.</p>
<h2>Walking out</h2>
<p>You can walk into the village, and you are welcome to. It is a working place rather than an attraction, so the right way to do it is the way you would walk anywhere people live: slowly, without a camera in anyone's face, and greeting people. Ask us and someone will happily walk with you.</p>
<div class="bm-callout"><p>The paths between the cottages are deliberately unlit, and so are the village paths. Bring a torch. After dark the darkness is one of the things we are keeping.</p></div>
<h2>What staying here does</h2>
<p>The money for your fish went to a boat from here. The money for your rice went to a field here. The wages went to neighbours. Twenty guests at most on the whole property is a small number, but it is a steady one, and a steady small number is worth more to a village than an occasional large one.</p>
<h2>The name, again</h2>
<p>Bonomali means boner mali, the one who tends the forest. Not a visitor, not an extractor. A keeper. The village has been doing that job for generations without needing a word for it, and the resort is named after the job rather than after itself.</p>
<p class="bm-article-close">Bonomali sits in Dangmari, a fishing and farming village in Banishanta, Dacope, Khulna. The staff are neighbours, the kitchen buys locally, and staying here keeps that steady.</p>
HTML,
            ],
            [
                'slug' => 'why-the-swing-faces-the-canal',
                'title' => 'Why the swing faces the canal.',
                'category' => 'Design',
                'image' => 'assets/bonomali/imagery/cottage-interior.jpg',
                'published_at' => '2026-03-22',
                'excerpt' => 'Every cottage is set so none looks into another, and every swing points one way. A note on the decisions you feel but do not see.',
                'body' => <<<'HTML'
<p><em>Every cottage is set so none looks into another, and every swing points one way. A note on the decisions you feel but do not see.</em></p>
<p>There are four couple cottages and one pod on this property, and it could comfortably have held three times that. The reason it does not is the same reason the swing faces where it faces. Everything here was decided against a single question: what does the morning feel like from inside it.</p>
<h2>Sightlines before square footage</h2>
<p>The cottages are set far apart, and the angles are chosen so that no balcony can see another balcony. That costs land, and land is the expensive part. But privacy is the thing we are actually selling, and privacy that you have to remember to maintain is not privacy.</p>
<h2>The swing</h2>
<p>Every balcony has one, and every one of them points at the water. Not at the path, not at the next cottage, not at the pretty tree. The swing is where you will spend the hours between the dawn boat and lunch, and it is aimed at the thing worth looking at for that long.</p>
<div class="bm-callout"><p>Nothing here is generic. Even the swing has a reason for being where it is. If something looks like an accident, ask us, because it probably is not one.</p></div>
<h2>Why the paths are dark</h2>
<p>We do not light the paths between the cottages. It would be easy and it would be safer in the shallowest sense, and it would also erase the sky. A torch solves the problem for you personally without taking the night away from everybody else. Bring one.</p>
<h2>Materials that belong here</h2>
<p>Warm wood, thatch, and honest finishes that will age rather than chip. The cottages are named for the forest that keeps them: Golpata for the thatch palm, Moual for the honey gatherer, Arronyok for of the forest, Chitra for the spotted deer. The names came from the place, not from a brand exercise.</p>
<h2>The pod, deliberately different</h2>
<p>Groups need something the couple cottages cannot give them: one roof, three rooms, and a long table. So the pod is a separate building with its own logic, placed so that a party of eight does not become everybody else's evening.</p>
<p class="bm-article-close">The cottages at Bonomali are placed so no balcony sees another, every swing faces the canal, and the paths are left unlit on purpose. Privacy is the design brief, not a feature.</p>
HTML,
            ],
            [
                'slug' => 'monsoon',
                'title' => 'Monsoon, on your own balcony.',
                'category' => 'Guides',
                'image' => 'assets/bonomali/imagery/swing-deck-wide.jpg',
                'published_at' => '2026-03-06',
                'excerpt' => 'The season everyone avoids, and the one we would choose. Rain on a thatch roof, from under a dry balcony.',
                'body' => <<<'HTML'
<p><em>The season everyone avoids, and the one we would choose. Rain on a thatch roof, from under a dry balcony.</em></p>
<p>Every year we get the same question in June: is it worth coming in the rain. The answer is that the monsoon is the most beautiful the forest gets, and the least crowded, and if you can accept one lost afternoon it is the best value week of the year.</p>
<h2>What the forest does</h2>
<p>It gets loud and it gets green. The canal fills and widens, the banks lose their edges, and everything that was dusty in April is washed. The light goes silver instead of gold, which photographs badly and looks extraordinary in person.</p>
<h2>What you do all day</h2>
<p>The same as any other month, with better sound. The dawn half-hour still happens and rain makes it better. The swing is under cover. The barbecue moves under the roof when it needs to. Nothing is cancelled for weather, and the canal cruise goes out between the heavy hours rather than through them.</p>
<div class="bm-callout"><p>What to bring in the monsoon: a light waterproof layer, sandals you can wet, one dry set of clothes sealed in a bag for the boat, and a torch. Everything else we have.</p></div>
<h2>The boat leg in the rain</h2>
<p>Mongla to Bonomali is about thirty minutes on the water, and our boat is covered. In heavy rain we may hold you at the jetty for twenty minutes rather than cross in it, which is the boatman's call and always the right one. Tell us your arrival time and we plan around the sky.</p>
<h2>Mosquitoes, honestly</h2>
<p>There are more of them in the wet months, particularly at dusk. The cottages are screened and the rooms are air-conditioned, so nights are fine. For the hour around sunset, long sleeves and repellent are the answer, and we would rather tell you that than pretend.</p>
<h2>The trade you are making</h2>
<p>You lose some certainty about your afternoons. You gain the greenest version of the forest, a canal at its fullest, the lowest rates of the year, and a decent chance of having the place close to yourselves. We think that is a good trade, and we would say so even if it were not our quiet season.</p>
<p class="bm-article-close">The Sundarbans in monsoon is greenest, fullest and quietest. Bonomali stays open, nothing is cancelled for rain, and a light waterproof layer plus a torch is most of what you need.</p>
HTML,
            ],
            [
                'slug' => 'what-to-pack',
                'title' => 'What to pack, and what to leave.',
                'category' => 'Guides',
                'image' => 'assets/bonomali/imagery/cottages-night.jpg',
                'published_at' => '2026-02-18',
                'excerpt' => 'Less than you think. Here is the short list that actually matters, including the one thing everybody forgets.',
                'body' => <<<'HTML'
<p><em>Less than you think. Here is the short list that actually matters, including the one thing everybody forgets.</em></p>
<p>Guests routinely arrive with twice what they need and without the one thing they will actually want on the first night. The list is short because meals, the boat and the cruise are all included, so you are packing for yourself and not for the trip.</p>
<h2>A torch. This is the one.</h2>
<p>The paths between the cottages are deliberately unlit, so that the night sky stays the night sky. A phone works, a proper torch works better, and a head torch is the answer if you want a hand free for a cup of tea.</p>
<h2>For dusk</h2>
<p>Long sleeves and something for mosquitoes, for roughly the hour around sunset. The cottages are screened and air-conditioned so the nights are comfortable; it is the transition hour outdoors that wants covering.</p>
<h2>For the water</h2>
<p>Shoes or sandals you do not mind getting wet at the jetty, and in the cool months a light layer for the boat, because thirty minutes of moving air on the water is colder than the same air on land. In the monsoon add a thin waterproof and seal one dry set of clothes in a bag.</p>
<div class="bm-callout"><p>Leave at home: snacks, a hair dryer, and a plan. Three meals a day are included, the rooms have what they need, and the day here works better without an itinerary.</p></div>
<h2>Worth bringing</h2>
<p>A book you do not mind not reading. Binoculars if you own a pair, because the far bank rewards them at dawn. A power bank, since you will be outdoors more than you plan. And a swimsuit only if you like the idea of the deck, not the canal.</p>
<h2>Documents and money</h2>
<p>A photo ID for check-in, and some cash, because the village runs on it and there is no ATM on this side of the water. Your stay itself is settled with us directly.</p>
<p class="bm-article-close">Pack a torch, long sleeves for dusk, shoes you can wet, a light layer for the boat, ID and cash. Meals, the boat and the canal cruise are already included.</p>
HTML,
            ],
            [
                'slug' => 'birds-of-the-canal',
                'title' => "What you'll actually see on the canal.",
                'category' => 'The forest',
                'image' => 'assets/bonomali/imagery/deck-night.jpg',
                'published_at' => '2026-02-02',
                'excerpt' => 'Not a tiger. But sit still for twenty minutes with a cup of tea and the canal gets busy.',
                'body' => <<<'HTML'
<p><em>Not a tiger. But sit still for twenty minutes with a cup of tea and the canal gets busy.</em></p>
<p>We are honest about not selling tiger sightings, which sometimes lands as though there is nothing to see. There is a great deal to see. It simply arrives on its own schedule and rewards sitting still rather than moving fast.</p>
<h2>Kingfishers, all day</h2>
<p>The most reliable sight here and the one guests photograph most. They work the same stretches of bank repeatedly, so once you have noticed a perch you can watch the same bird return to it for an hour. The flash of them going in is the thing.</p>
<h2>Herons and egrets in the shallows</h2>
<p>Standing still for so long that people miss them entirely, then moving once, fast. Low water is when the shallows are worth watching, so ask us about the tide rather than the clock.</p>
<h2>Spotted deer at first light</h2>
<p>Chitra, which one of the cottages is named after. They come to the water early, when the canal is quiet, which is most mornings. This is the sighting most worth being awake for, and it happens from a balcony rather than a boat.</p>
<div class="bm-callout"><p>The rule for all of it: stay still, stay quiet, and give it twenty minutes. Every guest who says they saw nothing was walking around.</p></div>
<h2>Monkeys in the treeline</h2>
<p>Rhesus macaques, and they are the one animal here that will notice you back. Keep food indoors and do not feed them, for the ordinary reason that a fed monkey becomes somebody else's problem next week.</p>
<h2>On the bank at low water</h2>
<p>Mudskippers, which are worth ten minutes of anyone's attention, and fiddler crabs in numbers. This is the layer of the Sundarbans nobody photographs and children like most.</p>
<h2>The afternoon cruise</h2>
<p>Four in the afternoon, included in every stay, and the engine spends more of it off than on. Tell the boatman you care about birds and he will take the narrower channel, because he grew up on this water and knows which bank is working.</p>
<p class="bm-article-close">On the canal at Bonomali you will reliably see kingfishers, herons and egrets, monkeys in the treeline, mudskippers and crabs at low water, and spotted deer at first light.</p>
HTML,
            ],
            [
                'slug' => 'the-pod-for-groups',
                'title' => 'The pod, and how groups stay here.',
                'category' => 'Design',
                'image' => 'assets/bonomali/imagery/cottages-night.jpg',
                'published_at' => '2026-01-16',
                'excerpt' => 'Three rooms under one roof, six to ten guests, and one long table by the canal.',
                'body' => <<<'HTML'
<p><em>Three rooms under one roof, six to ten guests, and one long table by the canal.</em></p>
<p>Four of the five stays here are couple cottages, built around two people and a swing. The pod exists because a group of eight wants the opposite of that: to be in the same building, at the same table, without four separate front doors between them.</p>
<h2>What it is</h2>
<p>One building, three rooms, for six to ten guests. It has its own canal frontage and its own long table, and it is placed deliberately away from the couple cottages so that a lively evening in the pod is not everybody else's evening.</p>
<h2>How the price works</h2>
<p>Per person, per night, and it falls as the group grows, because the building costs the same to run whether six or ten of you are in it. Ten guests pay the least each; six pay the most. The Sunday to Thursday rate is fifteen percent below Friday, Saturday and holidays, as it is everywhere on the property.</p>
<div class="bm-callout"><p>The pod takes six guests minimum. Two or four people are better off, and usually happier, in one of the couple cottages.</p></div>
<h2>What groups actually do here</h2>
<p>Less than they plan. The pattern is a big barbecue dinner at nine, everybody up far too early for the grey half-hour because one person set an alarm and it spread, and then a long slow day in which the group quietly disperses to different corners and finds each other again at meals.</p>
<h2>Whole-property bookings</h2>
<p>Twenty guests is the ceiling for the entire resort, four cottages plus the pod. Wedding parties and company groups do sometimes take everything, and that is the one arrangement worth writing to us about directly rather than booking online.</p>
<h2>What it is not</h2>
<p>It is not a dormitory and it is not a party venue. There is no sound system, the paths are unlit, and the couple cottages nearby are occupied by people who came for the quiet. Groups who understand that have a very good time here.</p>
<p class="bm-article-close">The pod at Bonomali is three rooms under one roof for six to ten guests, priced per person with the rate falling as the group grows. The whole property tops out at twenty.</p>
HTML,
            ],
        ];

        foreach ($posts as $post) {
            JournalPost::create(array_merge($post, [
                'author' => 'Bonomali Mangrove Resort',
                'status' => 1,
            ]));
        }
    }
}
