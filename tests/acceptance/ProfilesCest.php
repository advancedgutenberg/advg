<?php


class ProfilesCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    public function deactivateProfileBlocks(AcceptanceTester $I)
    {
        $I->wantTo('Check if hidden profile blocks are not available in post edition anymore');

        $I->amOnPage('/wp-admin/post-new.php');

        // Click on + button
        $I->click('.editor-inserter button');

        // Search for Count Up block
        $I->fillField(['xpath'=>'//input[contains(@id, \'editor-inserter__search-\')]'], 'Count');

        // Search count up block
        $I->see("Count Up");

        // Advanced Gutenberg page
        $I->amOnPage('wp-admin/admin.php?page=advgb_main');

        // Profiles management page
        $I->click(['xpath' => '//ul[contains(@class, \'ju-menu-tabs\')]//a[contains(@href,\'#profiles\')]']);

        // Go to profiles management page
        $I->see('Advanced Gutenberg Profiles');

        // Edit default profile
        $I->click('.profile-title a');

        $I->see('Edit Profile');

        // Switch off Count Up block
        $I->click(['xpath'=>'//li[contains(@data-type, \'advgb/count-up\')]//label[contains(@class,\'switch\')]']);

        // Save
        $I->click('Save');

        $I->see('Profile saved successfully! ');

        // New post page
        $I->amOnPage('/wp-admin/post-new.php');

        // Click on + button
        $I->click('.editor-inserter button');

        // Search for Count up block
        $I->fillField(['xpath'=>'//input[contains(@id, \'editor-inserter__search-\')]'], 'Count');

        // I should not see count up anymore
        $I->dontSee("Count Up");
    }
}
