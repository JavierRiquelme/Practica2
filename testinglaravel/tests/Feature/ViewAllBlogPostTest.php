<?php

namespace Tests\Feature;

use App\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewAllBlogPostTest extends TestCase
{
	use RefreshDatabase;

	/**
	 * @group posts
	 *@return [type] [description]
	 */
	public function testCanViewAllBlogPosts(){
		//Arrange
		$post1=factory(Post::class)->create();
		$post2=factory(Post::class)->create();

		//Action
		$resp=$this->get('/posts');
		//Assert
		$resp->assertStatus(200);
		$resp->assertSee($post1->title);
		$resp->assertSee($post2->title);
		$resp->assertSee(str_limit($post1->body));
		$resp->assertSee(str_limit($post2->body));
	}
}
