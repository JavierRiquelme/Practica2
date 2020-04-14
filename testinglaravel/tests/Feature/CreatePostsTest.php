<?php

namespace Tests\Feature;

use App\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreatePostsTest extends TestCase
{
	use RefreshDatabase;

	/**
	 * @group create-post
	 * @return [type] [description] 
	 */
	public function testCanCreatePost(){
		//Arrange
		//Action
		$res=$this->post('/store-post', [
			'title' => 'new post title',
			'body' => 'new post body'
		]);
		//Assert
		$this->assertDatabaseHas('posts',[
			'title' => 'new post title',
			'body' => 'new post body'
		]);

		$post = Post::find(1);
		$this->assertEquals('new post title', $post->title);
		$this->assertEquals('new post body', $post->body);
	}

	/**
	 * @group title-req
	 * @return [type] [description]
	 */
	public function testTitleIsRequiredToCreatePost(){//comentar en Handler.php "throw $exception;"
		$resp=$this->post('/store-post',[
			'title' => null,
			'body' => 'new post body'
		]);

		$resp->assertSessionHasErrors('title');
	}

	/**
	 * @group body-req
	 * @return [type] [description]
	 */
	public function testBodyIsRequiredToCreatePost(){//comentar en Handler.php "throw $exception;"
		$resp=$this->post('/store-post',[
			'title' => 'new post title',
			'body' => null
		]);

		$resp->assertSessionHasErrors('body');
	}
}
