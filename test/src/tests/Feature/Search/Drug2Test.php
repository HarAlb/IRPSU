<?php

namespace Tests\Feature\Search;
use App\Models\Drug;
use Tests\TestCase;

/**
 * Class Drug2Test
 * @package Tests\Feature
 */
class Drug2Test extends TestCase
{
    /**
     * @dataProvider getData
     *
     * @param \Closure $function
     * @param array    $search
     * @param array    $result
     *
     * @throws \Throwable
     */
    public function testSearch(\Closure $function, array $search, array $result)
    {
        call_user_func($function);

        $search = http_build_query($search);
        $response = $this->getJson('/api/search-drugs?' . $search);

        $response->assertJson($result);
    }

    /**
     * @return array[]
     */
    public function getData()
    {
        return [
            [
                function () {
                },
                [
                    'page'       => 1,
                    'substances' => [1, 2, 3]
                ],
                [
                    'current_page' => 1,
                    'total'        => 10,
                    'per_page'     => 5,
                    'data'         => [
                        [
                            'id'               => 11,
                            'substances_count' => 3,
                            'substances'       => [
                                ['id' => 1],
                                ['id' => 2],
                                ['id' => 3],
                            ]
                        ],
                        [
                            'id'               => 12,
                            'substances_count' => 3,
                            'substances'       => [
                                ['id' => 1],
                                ['id' => 2],
                                ['id' => 3],
                            ]
                        ],
                        [
                            'id'               => 13,
                            'substances_count' => 3,
                            'substances'       => [
                                ['id' => 1],
                                ['id' => 2],
                                ['id' => 3],
                            ]
                        ],
                        [
                            'id'               => 14,
                            'substances_count' => 3,
                            'substances'       => [
                                ['id' => 1],
                                ['id' => 2],
                                ['id' => 3],
                            ]
                        ],
                        [
                            'id'               => 15,
                            'substances_count' => 3,
                            'substances'       => [
                                ['id' => 1],
                                ['id' => 2],
                                ['id' => 3],
                            ]
                        ],
                    ]
                ]
            ],
            [
                function () {
                    Drug::destroy([11, 13]);
                },
                [
                    'page'       => 1,
                    'substances' => [1, 2, 3]
                ],
                [
                    'current_page' => 1,
                    'total'        => 8,
                    'per_page'     => 5,
                    'data'         => [
                        [
                            'id'               => 12,
                            'substances_count' => 3,
                            'substances'       => [
                                ['id' => 1],
                                ['id' => 2],
                                ['id' => 3],
                            ]
                        ],
                        [
                            'id'               => 14,
                            'substances_count' => 3,
                            'substances'       => [
                                ['id' => 1],
                                ['id' => 2],
                                ['id' => 3],
                            ]
                        ],
                        [
                            'id'               => 15,
                            'substances_count' => 3,
                            'substances'       => [
                                ['id' => 1],
                                ['id' => 2],
                                ['id' => 3],
                            ]
                        ],
                        [
                            'id'               => 16,
                            'substances_count' => 3,
                            'substances'       => [
                                ['id' => 1],
                                ['id' => 2],
                                ['id' => 3],
                            ]
                        ],
                        [
                            'id'               => 17,
                            'substances_count' => 3,
                            'substances'       => [
                                ['id' => 1],
                                ['id' => 2],
                                ['id' => 3],
                            ]
                        ],
                    ]
                ]
            ],

        ];
    }
}
