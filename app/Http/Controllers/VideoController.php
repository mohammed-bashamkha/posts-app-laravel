<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\UploadFileTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    use UploadFileTrait;
    public function store(Request $request)
    {
        try
        {
            $request->validate([
            'description' => 'nullable|string|max:500',
            'url'   => 'required|array|min:1',
            'url.*' => 'mimetypes:video/mp4,video/avi,video/mov|max:40480',
        ]);
            $post = Post::create([
                'user_id' => Auth::id(),
                'type'    => 'video',
            ]);

            foreach ($request->file('url') as $url) 
            {
                $path = $this->uploadFile($url, 'posts/videos', 'public');

                $post->videos()->create([
                    'user_id' => Auth::id(),
                    'post_id' => $post->id,
                    'url'     => $path,
                    'description' => $request->description,
                ]);
            }

            return response()->json([
                'message' => 'Video post created successfully',
                'post' => $post,
                'videos' => $path,
                'description' => $request->description,
            ], 201);
        }
        catch(Exception $e)
        {
            return response()->json([
                'message' => 'Failed To Create Video Post',
                'error' => $e->getMessage()
            ]);
        }
    }
}
