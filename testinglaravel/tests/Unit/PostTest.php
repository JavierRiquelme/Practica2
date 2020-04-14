<?php

namespace Tests\Unit;

use App\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostTest extends TestCase
{
	use DatabaseMigrations;
	
	/**
	 * @group formatted-date
	 * @return [type] [description] 
	 */
    public function testCanGetCreatedAtFormattedDate(){
    	//Arrange
    	//create a post
    	$post=Post::create([
	    	'title' => 'A simple title',
	    	'body' => 'A simply body',
	    ]);
    	//Action
    	//get the value by calling the method
    	$formattedDate=$post->createdAt();
    	//Assert
    	//assert that returnes value is as we expect
    	$this->assertEquals(
    		$post->created_at->toFormattedDateString(), $formattedDate
    	);
    }
}
