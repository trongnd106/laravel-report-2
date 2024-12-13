<?php
namespace App\Repositories\Post;

use App\Repositories\BaseRepository;
use App\Repositories\Post\PostRepositoryInterface;
use App\Models\Post;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return Post::class;
    }

    public function getPosts()
    {
        return $this->model->select('title')->take(5)->get();
    }
}
