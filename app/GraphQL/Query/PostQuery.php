<?php

namespace App\GraphQL\Query;

use App\Post;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;

class PostQuery extends Query
{
    protected $attributes = [
        'name' => 'PostQuery',
        'description' => 'posts related queries'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('PostType'));
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::string()],
            'user_id' => ['name' => 'user_id', 'type' => Type::string()],
            'title' => ['name' => 'title', 'type' => Type::string()]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        if (isset($args['id'])) {
            return Post::where('id', $args['id'])->get();
        } else if (isset($args['title'])) {
            return Post::where('title', $args['title'])->get();
        } else if (isset($args['user_id'])) {
            return Post::where('user_id', $args['user_id'])->get();
        } else {
            return Post::all();
        }
    }

}
