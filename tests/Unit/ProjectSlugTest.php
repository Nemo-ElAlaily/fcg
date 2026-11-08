<?php

namespace Tests\Unit;

use Tests\TestCase;

class ProjectSlugTest extends TestCase
{
    /**
     * The Store/Update requests derive the slug with str_replace(characters(), '-', title),
     * and the unique:projects,slug rule is validated against exactly that value. If this
     * derivation drifts, two titles can collapse to one slug again and a project becomes
     * unreachable on the public site (FrontController::singleProject looks up by slug).
     */
    public function test_slug_is_derived_from_title_by_replacing_unsafe_characters()
    {
        $derive = fn (string $title) => str_replace(characters(), '-', $title);

        $this->assertSame('The-Heritage-Village', $derive('The Heritage Village'));
        $this->assertSame('A-B', $derive('A/B'));
        $this->assertSame('wow-', $derive('wow!'));
        $this->assertSame('a-b', $derive('a\\b'));
    }

    public function test_titles_that_differ_only_by_unsafe_characters_collide_so_slug_must_be_unique()
    {
        $derive = fn (string $title) => str_replace(characters(), '-', $title);

        // Both titles produce the same slug; the unique rule is what stops the second save.
        $this->assertSame($derive('A/B'), $derive('A B'));
    }
}
