<?php

namespace App\GraphQL\Query;

use App\User;
use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\Type;
use GraphQL;

class UserQuery extends Query
{
    protected $attributes = [
        'name' => 'Users query',
        'description' => 'user related queries'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('UserType'));
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::string()],
            'email' => ['name' => 'email', 'type' => Type::string()],
            'posts' => [
                'args' => [
                    'id' => [
                        'type' => Type::string(),
                        'description' => 'id of the post',
                        'name' => 'id'
                    ]
                ],
                'type' => Type::listOf(GraphQL::type('PostType')),
                'description' => 'post description',
            ],
        ];
    }

    public function resolve($root, $args)
    {
        if (isset($args['id'])) {
            return User::where('id', $args['id'])->get();
        } else if (isset($args['email'])) {
            return User::where('email', $args['email'])->get();
        } else {
            return User::all();
        }
    }

    public function resolvePostsField($root, $args)
    {
        if (isset($args['id'])) {
            return $root->posts->where('id', $args['id']);
        }

        return $root->posts;
    }
}
