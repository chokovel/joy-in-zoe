<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\Post;
use Carbon\CarbonImmutable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Seed the blog with ministry-themed posts.
     */
    public function run(): void
    {
        $posts = [
            [
                'title' => 'The Midnight Watch: Standing in the Gap at Midnight',
                'excerpt' => 'Why do we gather at midnight to pray for the unreached? Discover the biblical foundation of the midnight watch.',
                'body' => '<p>The midnight watch is one of the oldest disciplines of the Church. It is a time set apart when the noise of the day has quieted and heaven is attentive to the cry of intercessors.</p><p>At JIZIM, we gather Monday to Friday at midnight on Telegram — a women-only prayer community — to stand in the gap for the unreached, the unsaved, and the nations.</p><p>Scripture is full of midnight encounters: Paul and Silas prayed and praised at midnight and the prison doors were opened. The bridegroom came at midnight. It is a season when God does His deepest work in praying hearts.</p><p>If you carry the heart of an intercessor, we invite you to join this sacred hour.</p>',
                'author' => 'Faith Alugbue',
                'is_featured' => true,
                'days_ago' => 3,
                'category' => 'Prayer',
                'tags' => ['Midnight Watch', 'Intercession'],
            ],
            [
                'title' => 'What Does It Mean to Reach the Unreached?',
                'excerpt' => 'Over three billion people have yet to hear the Gospel in a meaningful way. Here is what it means to reach the unreached.',
                'body' => "<p>An unreached people group has no indigenous community of believing Christians with the resources to evangelize their own people.</p><p>The majority of the world's unreached peoples live in what missions researchers call the 10/40 Window — the region between 10 and 40 degrees north latitude.</p><p>We do not merely pray for these nations from afar; we also carry out medical, food, and gospel outreaches, and we teach our members to understand the nations they pray for.</p><p>Will you join us in praying for and reaching the unreached?</p>",
                'author' => 'Joy In Zoe Intercessory Ministries',
                'is_featured' => false,
                'days_ago' => 9,
                'category' => 'Teaching',
                'tags' => ['Unreached', 'Missions'],
            ],
            [
                'title' => 'A Testimony of Divine Connection',
                'excerpt' => 'Sisters who were long delayed in marriage have received divine connections after prayer interventions.',
                'body' => '<p>The Lord continues to confirm His Word through signs, wonders, and miracles.</p><p>Over the years, JIZIM has become a fertile ground where destinies are unlocked. We have seen miracle marriages, miracle babies, career breakthroughs, and deliverances through midnight prayers and altar sessions.</p><p>Our testimonies are not about us — they are about the faithfulness of God to those who call on Him day and night.</p><p>Has God done something in your life through JIZIM? We would love to hear your testimony.</p>',
                'author' => 'Joy In Zoe Intercessory Ministries',
                'is_featured' => false,
                'days_ago' => 16,
                'category' => 'Testimony',
                'tags' => ['Divine Connection', 'Testimony'],
            ],
            [
                'title' => 'The Watchman’s Posture: How to Pray Through the Night',
                'excerpt' => 'Intercession is not merely a schedule — it is a posture. Learn how to stay watchful, focused, and effective through the midnight hour.',
                'body' => '<p>To pray well through the night, an intercessor must first settle their posture before God.</p><p>The watchman does not sleep at his post. In the same way, an intercessor learns to stay spiritually alert — guarding thoughts, silencing distractions, and keeping the Word on the lips.</p><p>Practical helps: prepare your petitions before you begin, keep a journal for the Spirit’s impressions, worship before you ask, and pray in the Spirit as you are led.</p><p>Above all, remember that the midnight hour is not about how long you pray, but how near you draw. Draw near to God, and He will draw near to you.</p>',
                'author' => 'Faith Alugbue',
                'is_featured' => false,
                'days_ago' => 1,
                'category' => 'Prayer',
                'tags' => ['Midnight Watch', 'Watchman', 'Prayer'],
            ],
            [
                'title' => 'When God Moved: Reflections From Our Last Outreach',
                'excerpt' => 'Medical care, warm meals, and the Gospel — here is what happened when we took the altar to the streets in Ada-Irri.',
                'body' => '<p>There is a special grace that surrounds an altar that leaves the four walls of the church and meets people where they are.</p><p>During our recent outreach in Ada-Irri, Delta State, we brought medical checks, food, clothing, and the preaching of the Word to a community that had rarely heard the name of Jesus in a meaningful way.</p><p>The Gospel is not complete until it has hands and feet. When we meet physical need, we earn the right to speak into the soul.</p><p>We thank every partner who made this possible — your prayers and giving are reaching unreached lives.</p>',
                'author' => 'Joy In Zoe Intercessory Ministries',
                'is_featured' => true,
                'days_ago' => 5,
                'category' => 'Outreach',
                'tags' => ['Outreach', 'Missions', 'Unreached'],
            ],
            [
                'title' => 'Praying for the 10/40 Window: A Simple Guide for Families',
                'excerpt' => 'You do not need to travel to reach the nations. Bring the 10/40 Window into your family’s prayer time with this simple guide.',
                'body' => '<p>The 10/40 Window is home to the largest concentration of unreached people on earth — and you can reach it from your own prayer corner.</p><p>Each week, pick one nation inside the Window as a family. Learn its name, its people group, and one or two specific prayer requests. Pray for open doors for missionaries, receptive hearts, and protection over local believers.</p><p>When children learn to pray for distant nations, they grow into adults who care about the world God loves.</p><p>Let us raise a generation of intercessors who know that the nations belong to God.</p>',
                'author' => 'Joy In Zoe Intercessory Ministries',
                'is_featured' => false,
                'days_ago' => 12,
                'category' => 'Teaching',
                'tags' => ['Unreached', 'Missions', 'Prayer'],
            ],
            [
                'title' => 'Five Ways to Partner With Joy In Zoe This Season',
                'excerpt' => 'Beyond giving, there are practical ways to stand with us — in prayer, in the field, and in your local community.',
                'body' => '<p>The work of intercession and outreach is carried by a community of partners. Here are five ways you can stand with us this season.</p><p><strong>1. Pray.</strong> Commit to the Monday–Friday 9:00 PM prayer for the unreached, or join the midnight watch. <strong>2. Give.</strong> Your gifts fund medical, food, and gospel outreaches. <strong>3. Volunteer.</strong> Come with us into the field. <strong>4. Spread the word.</strong> Share our posts and invite a friend to fellowship. <strong>5. Stay.</strong> Consistency in a praying community changes everything.</p><p>Whatever you bring, bring it with a willing heart — God multiplies what is offered in faith.</p>',
                'author' => 'Joy In Zoe Intercessory Ministries',
                'is_featured' => false,
                'days_ago' => 20,
                'category' => 'Outreach',
                'tags' => ['Outreach', 'Missions', 'Breakthrough'],
            ],
        ];

        foreach ($posts as $post) {
            $publishedAt = CarbonImmutable::now()->subDays($post['days_ago']);

            $model = Post::updateOrCreate(
                ['slug' => Str::slug($post['title'])],
                [
                    'title' => $post['title'],
                    'excerpt' => $post['excerpt'],
                    'body' => $post['body'],
                    'author' => $post['author'],
                    'category_id' => BlogCategory::where('slug', Str::slug($post['category']))->value('id'),
                    'published_at' => $publishedAt,
                    'is_featured' => $post['is_featured'],
                ]
            );

            $tagIds = BlogTag::whereIn('slug', collect($post['tags'])->map(fn ($t) => Str::slug($t)))->pluck('id');
            $model->tags()->sync($tagIds);
        }
    }
}
