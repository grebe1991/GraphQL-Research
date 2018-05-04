<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;

class PostType extends BaseType
{
    protected $attributes = [
        'name' => 'PostType',
        'description' => 'a post template for graphQL'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int())
            ],
            'user_id' => [
                'type' => Type::nonNull(Type::int())
            ],
            'title' => [
                'type' => Type::nonNull(Type::string()),
            ],
            'body' => [
                'type' => Type::nonNull(Type::string()),
            ],
            'created_at' => [
                'type' => Type::string(),
            ],
            'updated_at' => [
                'type' => Type::string(),
            ]
        ];
    }
}
