<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Conner\Tagging\Model\Tag;
use Illuminate\Http\Request;


class UpdateController extends Controller
{
    public function index(){
        // PostTags && PublicationTags

        //dd(Post::existingTagsInGroups('PostTags'));
        // dd(Tag::all());
        // $tags = Tag::all();
        // foreach($tags as $tag){
        //     $tag->setGroup('PostTags');
        // }

        // $publicationTags = array("Scopus", "National", "Internaltional", "Web of Science", "Conference Proceedings");
        // foreach($publicationTags as $tag){
            
        // }
        
        // $newTags = Tag::inGroup('PublicationTags')->get();
        // dd($newTags);


    }
}
