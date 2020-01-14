<?php

namespace Tests\Unit;

use App\Rules\SlugRule;
use PHPUnit\Framework\TestCase;

class SlugRuleTest extends TestCase
{
    protected $rule;

    public function setUp(): void
    {
        parent::setUp();

        $this->rule = new SlugRule();
    }

    /**
     * Check that the valid slugs passes
     *
     * @dataProvider validSlugs
     * @param string $slug
     * @return void
     * @test
     */
    public function it_accepts_valid_slugs($slug)
    {
        $this->assertEquals(1, $this->rule->passes('test', $slug));

    }

    /**
     * Check that the invalid slugs does not pass
     *
     * @dataProvider invalidSlugs
     * @param string $slug
     * @return void
     * @test
     */
    public function it_rejects_invalid_slugs($slug)
    {
        $this->assertEquals(0, $this->rule->passes('test', $slug));
    }

    public function validSlugs()
    {
        return [
            ['user-name'],
            ['user123-name-321'],
            ['username'],
            ['USER123-name'],
            ['user-name-2']
        ];
    }

    public function invalidSlugs()
    {
        return [
            ['-user-name'],
            ['user--name'],
            ['username-']
        ];
    }
}
