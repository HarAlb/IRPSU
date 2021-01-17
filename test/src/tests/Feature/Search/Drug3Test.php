<?php

namespace Tests\Feature\Search;
use App\Models\Drug;
use App\Models\Substance;
use Tests\TestCase;

/**
 * Class Drug3Test
 * @package Tests\Feature
 */
class Drug3Test extends TestCase
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
                    Substance::find(1)->update([
                       'visible' => false
                    ]);
                },
                [
                    'page'       => 1,
                    'substances' => [1, 2]
                ],
                [
                    'current_page' => 1,
                    'total'        => 0,
                    'per_page'     => 5,
                    'data'         => []
                ]
            ],
            [
                function () {
                    Substance::find(1)->update([
                       'visible' => false
                    ]);
                },
                [
                    'page'       => 1,
                    'substances' => [1, 2, 3, 4]
                ],
                [
                    'current_page' => 1,
                    'total'        => 6,
                    'per_page'     => 5,
                    'data'         => [
                        [
                            'id'               => 23,
                            'substances_count' => 5,
                            'isset_substances' => 3,
                            'substances'       => [
                                ['id' => 2],
                                ['id' => 3],
                                ['id' => 4],
                                ['id' => 5],
                                ['id' => 6]
                            ]
                        ],
                        [
                            'id'               => 24,
                            'substances_count' => 5,
                            'isset_substances' => 3,
                            'substances'       => [
                                ['id' => 2],
                                ['id' => 3],
                                ['id' => 4],
                                ['id' => 5],
                                ['id' => 6]
                            ]
                        ],
                        [
                            'id'               => 29,
                            'substances_count' => 5,
                            'isset_substances' => 3,
                            'substances'       => [
                                ['id' => 2],
                                ['id' => 3],
                                ['id' => 4],
                                ['id' => 5],
                                ['id' => 6]
                            ]
                        ],
                        [
                            'id'               => 30,
                            'substances_count' => 5,
                            'isset_substances' => 3,
                            'substances'       => [
                                ['id' => 2],
                                ['id' => 3],
                                ['id' => 4],
                                ['id' => 5],
                                ['id' => 6]
                            ]
                        ],
                        [
                            'id'               => 25,
                            'substances_count' => 5,
                            'isset_substances' => 2,
                            'substances'       => [
                                ['id' => 3],
                                ['id' => 4],
                                ['id' => 5],
                                ['id' => 6],
                                ['id' => 7]
                            ]
                        ],
                    ]
                ]
            ],
            [
                function () {
                    Substance::find(1)->update([
                       'visible' => false
                    ]);
                },
                [
                    'page'       => 2,
                    'substances' => [1, 2, 3, 4]
                ],
                [
                    'current_page' => 2,
                    'total'        => 6,
                    'per_page'     => 5,
                    'data'         => [
                        [
                            'id'               => 26,
                            'substances_count' => 5,
                            'isset_substances' => 2,
                            'substances'       => [
                                ['id' => 3],
                                ['id' => 4],
                                ['id' => 5],
                                ['id' => 6],
                                ['id' => 7]
                            ]
                        ]
                    ]
                ]
            ],
        ];
    }
}
