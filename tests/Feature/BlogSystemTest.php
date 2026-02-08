<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogSystemTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['role' => 'admin']);
    }

    /** @test */
    public function it_generates_slug_automatically()
    {
        $blog = Blog::create([
            'user_id' => $this->admin->id,
            'blog_title' => 'Minimalist Design 101',
            'blog_tags' => 'design, minimalism',
            'blog_image' => 'test-image.jpg',
            'blog_long_description' => 'Content here...',
        ]);

        $this->assertEquals('minimalist-design-101', $blog->blog_slug);
    }

    /** @test */
    public function it_can_be_associated_with_a_category()
    {
        $category = BlogCategory::create(['name' => 'Trends']);
        
        $blog = Blog::create([
            'user_id' => $this->admin->id,
            'blog_category_id' => $category->category_id,
            'blog_title' => '2026 Trends',
            'blog_tags' => 'trends',
            'blog_image' => 'test-image.jpg',
            'blog_long_description' => 'Content...',
        ]);

        $this->assertEquals($category->category_id, $blog->category->category_id);
    }

    /** @test */
    public function it_can_store_related_products_for_shop_the_look()
    {
        $product1 = Product::factory()->create(['product_name' => 'Oak Table']);
        $product2 = Product::factory()->create(['product_name' => 'Linen Sofa']);

        $blog = Blog::create([
            'user_id' => $this->admin->id,
            'blog_title' => 'Living Room Inspiration',
            'blog_tags' => 'living room',
            'blog_image' => 'test-image.jpg',
            'blog_long_description' => 'Content...',
            'related_products' => [$product1->product_id, $product2->product_id]
        ]);

        $this->assertCount(2, $blog->related_products);
        $this->assertContains($product1->product_id, $blog->related_products);
    }

    /** @test */
    public function it_resolves_blog_by_slug_in_detail_page()
    {
        $blog = Blog::create([
            'user_id' => $this->admin->id,
            'blog_title' => 'SEO Adventure',
            'blog_tags' => 'seo',
            'blog_image' => 'test-image.jpg',
            'blog_long_description' => 'SEO Content',
        ]);

        $response = $this->get(route('blog-detail', $blog->blog_slug));
        $response->assertStatus(200);
        $response->assertSee('SEO Adventure');
    }
}
