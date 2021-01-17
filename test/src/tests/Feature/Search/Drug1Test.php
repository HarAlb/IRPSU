<?php

namespace Tests\Feature\Search;

use App\Models\Drug;
use Tests\TestCase;

/**
 * Class Drug1Test
 * @package Tests\Feature
 */
class Drug1Test extends TestCase
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
                    'substances' => [1, 2]
                ],
                [
                    'current_page' => 1,
                    'total'        => 10,
                    'per_page'     => 5,
                    'data'         => [
                        [
                            'id'               => 1,
                            'substances_count' => 2,
                            'substances'       => [
                                ['id' => 1],
                                ['id' => 2],
                            ]
                        ],
                        [
                            'id'               => 2,
                            'substances_count' => 2,
                            'substances'       => [
                                ['id' => 1],
                                ['id' => 2],
                            ]
                        ],
                        [
                            'id'               => 3,
                            'substances_count' => 2,
                            'substances'       => [
                                ['id' => 1],
                                ['id' => 2],
                            ]
                        ],
                        [
                            'id'               => 4,
                            'substances_count' => 2,
                            'substances'       => [
                                ['id' => 1],
                                ['id' => 2],
                            ]
                        ],
                        [
                            'id'               => 5,
                            'substances_count' => 2,
                            'substances'       => [
                                ['id' => 1],
                                ['id' => 2],
                            ]
                        ],
                    ]
                ]
            ],
            [
                function () {

                },
                [
                    'page'       => 2,
                    'substances' => [1, 2]
                ],
                [
                    'current_page' => 2,
                    'total'        => 10,
                    'per_page'     => 5,
                    'data'         => [
                        [
                            'id'               => 6,
                            'substances_count' => 2,
                            'substances'       => [
                                ['id' => 1],
                                ['id' => 2],
                            ]
                        ],
                        [
                            'id'               => 7,
                            'substances_count' => 2,
                            'substances'       => [
                                ['id' => 1],
                                ['id' => 2],
                            ]
                        ],
                        [
                            'id'               => 8,
                            'substances_count' => 2,
                            'substances'       => [
                                ['id' => 1],
                                ['id' => 2],
                            ]
                        ],
                        [
                            'id'               => 9,
                            'substances_count' => 2,
                            'substances'       => [
                                ['id' => 1],
                                ['id' => 2],
                            ]
                        ],
                        [
                            'id'               => 10,
                            'substances_count' => 2,
                            'substances'       => [
                                ['id' => 1],
                                ['id' => 2],
                            ]
                        ],
                    ]
                ]
            ],
            [
                function () {
                    Drug::destroy(1);
                },
                [
                    'page'       => 2,
                    'substances' => [1, 2]
                ],
                [
                    'current_page' => 2,
                    'total'        => 9,
                    'per_page'     => 5,
                    'data'         => [
                        [
                            'id'               => 7,
                            'substances_count' => 2,
                            'substances'       => [
                                ['id' => 1],
                                ['id' => 2],
                            ]
                        ],
                        [
                            'id'               => 8,
                            'substances_count' => 2,
                            'substances'       => [
                                ['id' => 1],
                                ['id' => 2],
                            ]
                        ],
                        [
                            'id'               => 9,
                            'substances_count' => 2,
                            'substances'       => [
                                ['id' => 1],
                                ['id' => 2],
                            ]
                        ],
                        [
                            'id'               => 10,
                            'substances_count' => 2,
                            'substances'       => [
                                ['id' => 1],
                                ['id' => 2],
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }
}
