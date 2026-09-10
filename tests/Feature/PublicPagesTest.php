<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\GalleryCategory;
use App\Models\GalleryImage;
use App\Models\Post;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_loads(): void
    {
        $this->get(route('home'))
            ->assertOk()
            ->assertSee('Joy In Zoe');
    }

    public function test_home_page_shows_homepage_sections(): void
    {
        Post::create([
            'title' => 'The Midnight Watch',
            'slug' => 'the-midnight-watch',
            'body' => '<p>Why do we gather at midnight to pray?</p>',
            'published_at' => CarbonImmutable::now()->subDay(),
            'is_featured' => true,
        ]);

        Event::create([
            'title' => 'Physical Fellowship',
            'description' => 'A gathering of intercessors.',
            'location' => 'Gudu, Abuja',
            'starts_at' => CarbonImmutable::now()->addWeek(),
            'link' => '#contact',
            'is_published' => true,
        ]);

        $this->get(route('home'))
            ->assertOk()
            ->assertSee('Join Our Prayer Sessions on YouTube')
            ->assertSee('Upcoming Events')
            ->assertSee('Physical Fellowship')
            ->assertSee('From the Blog')
            ->assertSee('The Midnight Watch')
            ->assertSee('Glimpses of the Ministry')
            ->assertSee('Testimonies');
    }

    public function test_about_page_loads(): void
    {
        $this->get(route('about'))
            ->assertOk()
            ->assertSee('Watchmen on the Wall')
            ->assertSee('Aims and Objectives')
            ->assertSee('Prayer Mountain')
            ->assertSee('An Altar That Never Goes Cold')
            ->assertSee('Women', false);
    }

    public function test_missions_page_loads(): void
    {
        $this->get(route('missions'))
            ->assertOk()
            ->assertSee('10/40 Window')
            ->assertSee('Weekly Prayer Schedule')
            ->assertSee('Midnight Watch')
            ->assertSee('People Groups', false);
    }

    public function test_gallery_page_shows_categories(): void
    {
        $category = GalleryCategory::create([
            'name' => 'Outreaches',
            'slug' => 'outreaches',
            'description' => 'Medical, food, and missionary outreaches across Nigeria.',
        ]);

        GalleryImage::create([
            'gallery_category_id' => $category->id,
            'title' => 'Gwagwalada outreach',
            'alt_text' => 'Community outreach in Gwagwalada, Abuja',
            'filename' => 'preview-7.jpg',
            'path' => 'gallery/preview-7.jpg',
            'mime_type' => 'image/jpeg',
            'size' => 1000,
            'is_published' => true,
        ]);

        $this->get(route('gallery.index'))
            ->assertOk()
            ->assertSee('Outreaches');

        $this->get(route('gallery.show', $category->slug))
            ->assertOk()
            ->assertSee('Gwagwalada outreach')
            ->assertSee('All categories');
    }

    public function test_contact_page_loads(): void
    {
        $this->get(route('contact'))
            ->assertOk()
            ->assertSee('We Would Love to Hear From You')
            ->assertSee('Abuja Headquarters');
    }

    public function test_blog_index_lists_posts(): void
    {
        Post::create([
            'title' => 'The Midnight Watch',
            'slug' => 'the-midnight-watch',
            'excerpt' => 'Standing in the gap at midnight.',
            'body' => '<p>Why do we gather at midnight to pray?</p>',
            'published_at' => CarbonImmutable::now()->subDay(),
            'is_featured' => true,
        ]);

        $this->get(route('blog.index'))
            ->assertOk()
            ->assertSee('The Midnight Watch');
    }

    public function test_blog_show_displays_post(): void
    {
        $post = Post::create([
            'title' => 'The Midnight Watch',
            'slug' => 'the-midnight-watch',
            'excerpt' => 'Standing in the gap at midnight.',
            'body' => '<p>Why do we gather at midnight to pray for the unreached?</p>',
            'published_at' => CarbonImmutable::now()->subDay(),
            'is_featured' => true,
        ]);

        $this->get(route('blog.show', $post->slug))
            ->assertOk()
            ->assertSee('The Midnight Watch')
            ->assertSee('All posts');
    }

    public function test_unpublished_post_is_not_public(): void
    {
        $post = Post::create([
            'title' => 'Draft Post',
            'slug' => 'draft-post',
            'body' => '<p>Not yet published.</p>',
        ]);

        $this->get(route('blog.show', $post->slug))
            ->assertNotFound();
    }
}
