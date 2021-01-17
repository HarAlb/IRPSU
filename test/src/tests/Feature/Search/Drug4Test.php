<?php

namespace Tests\Feature\Search;
use App\Models\Drug;
use App\Models\Substance;
use Tests\TestCase;

/**
 * Class Drug4Test
 * @package Tests\Feature
 */
class Drug4Test extends TestCase
{
    /**
     * @dataProvider getData
     *
     * @param array    $search
     * @param array    $result
     *
     * @throws \Throwable
     */
    public function testSearch(array $search, array $result)
    {
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
                [
                    'substances' => [1]
                ],
                [
                    'errors'         => [
                        'substances' => [
                            'не ленись, добавь веществ'
                        ]
                    ]
                ]
            ]
        ];
    }
}
