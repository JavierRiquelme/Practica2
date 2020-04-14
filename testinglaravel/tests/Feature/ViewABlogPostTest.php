<?php

namespace Tests\Feature;

use App\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ViewABlogPostTest extends TestCase
{
	use DatabaseMigrations;

	public function testCanViewABlogPost(){
		//Arrengement
	    //creting a blog post
	    $post=Post::create([
	    	'tittle' => 'Asimple tittle',
	    	'body' => 'A simply body',
	    ]);

	    //Action
	    //visiting a route
	    $resp=$this->get("/post/{$post->id}");

	    //Assert
	    //assert statuscode 200
	    $resp->assertStatus(200);
	    //assert thet we see post tittle
	    $resp->assertSee($post->tittle);
	    //assert that we see post body
	    $resp->assertSee($post->body);
	    //assert that we see published date
	    $resp->assertSee($post->created_at->toFormattedDateString());
	}

	/**
	 * @group post-not-found
	 * @return [type] [description] 
	 */
	public function testViewsA404PageWhePostIsNotFound(){
		//Action
		$resp=$this->get('post/INVALID_ID');

		//Assert
		$resp->assertStatus(404);
		$resp->assertSee("The page you are looking for could not be found");
	}
}
