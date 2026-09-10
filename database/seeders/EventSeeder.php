<?php

namespace Database\Seeders;

use App\Models\Event;
use Carbon\CarbonImmutable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EventSeeder extends Seeder
{
    /**
     * Seed upcoming events drawn from the ministry schedule.
     */
    public function run(): void
    {
        $now = CarbonImmutable::now()->startOfDay();

        $events = [
            [
                'title' => 'Physical Fellowship',
                'description' => '<p>A gathering of intercessors in the presence of God for worship, teaching, and prayer.</p><p>Join us as we raise our voices together, build community, and wait on the Lord at the altar.</p>',
                'location' => 'Gudu, Abuja',
                'starts_at' => self::nthWeekdayOccurrence($now, CarbonImmutable::SATURDAY, 1),
                'ends_at' => null,
                'link_text' => 'Find out more',
            ],
            [
                'title' => 'Bible Study',
                'description' => '<p>Studying the Word together as we grow as prophetic intercessors.</p><p>Open to all — come with an open heart and a ready Bible.</p>',
                'location' => 'WhatsApp Live',
                'starts_at' => self::nthWeekdayOccurrence($now, CarbonImmutable::SATURDAY, 3),
                'ends_at' => null,
                'link_text' => 'Join on WhatsApp',
            ],
            [
                'title' => 'Night of Intercession (Midnight Watch)',
                'description' => '<p>A special gathering of the Midnight Watch for the unreached.</p><p>We stand in the gap through the night, praying for the nations, the lost, and breakthroughs over lives and destinies.</p>',
                'location' => 'Telegram · Women only',
                'starts_at' => self::nthWeekdayOccurrence($now, CarbonImmutable::SATURDAY, 2)->addHours(24),
                'ends_at' => null,
                'link_text' => 'Request an invitation',
            ],
            [
                'title' => 'Missionary Outreach',
                'description' => '<p>Medical, food, and gospel outreach reaching communities in need.</p><p>We bring the love of Christ to the unreached through practical compassion and the preaching of the Word.</p>',
                'location' => 'Ada-Irri, Delta State',
                'starts_at' => self::nthWeekdayOccurrence($now->addMonth(), CarbonImmutable::SATURDAY, 2)->setTime(8, 0),
                'ends_at' => null,
                'link_text' => 'Find out more',
            ],
        ];

        foreach ($events as $event) {
            Event::updateOrCreate(
                [
                    'title' => $event['title'],
                    'starts_at' => $event['starts_at'],
                ],
                [
                    'slug' => Str::slug($event['title']),
                    'description' => $event['description'],
                    'location' => $event['location'],
                    'ends_at' => $event['ends_at'],
                    'link' => '#contact',
                    'link_text' => $event['link_text'],
                    'is_published' => true,
                ]
            );
        }
    }

    /**
     * Return the date of the $occurrence-th (1-based) weekday within a month,
     * rolling forward into following months if that occurrence has already
     * passed for the current month.
     */
    protected static function nthWeekdayOccurrence(CarbonImmutable $reference, int $weekday, int $occurrence): CarbonImmutable
    {
        $month = $reference->startOfMonth();
        $count = 0;

        // Iterate through days of the month counting matching weekdays, then
        // roll into following months until the requested occurrence is found
        // on or after the reference date.
        do {
            $daysInMonth = $month->daysInMonth;

            for ($day = 1; $day <= $daysInMonth; $day++) {
                $date = $month->setDay($day);

                if ($date->dayOfWeek === $weekday) {
                    $count++;
                }

                if ($count === $occurrence) {
                    $date = $date->setTime(9, 0);

                    if ($date->gte($reference)) {
                        return $date;
                    }

                    break;
                }
            }

            $count = 0;
            $month = $month->addMonth()->startOfMonth();
        } while (true);
    }
}
