<?php

class NewsletterBlockCest
{
    public function _before(AcceptanceTester $I)
    {
        try {
            // Back to edit post
            $I->click('Edit Post');
            $I->waitForElement('#editor');
            $I->waitForElement('.advgb-newsletter-wrapper');
            $I->clickWithLeftButton('.advgb-newsletter-wrapper');
        } catch(Exception $e) {
            // do stuff
        }
    }

    public function _after(AcceptanceTester $I)
    {
    }

    public function createNewsletterBlock(AcceptanceTester $I)
    {
        $I->loginAsAdmin('admin', 'password');

        $I->wantTo('Create a Newsletter block');

        $I->amOnPage('/wp-admin/post-new.php');

        // Hide the Tips popup
        $I->executeJS('wp.data.dispatch( "core/nux" ).disableTips()');

        $I->fillField('.editor-post-title__input', 'Newsletter Block');

        // Insert some headings
        $I->insertBlock('Newsletter');
        $I->waitForElement('.advgb-newsletter-wrapper');

        // Publish post
        $I->click('Publish…');
        $I->waitForElementVisible('.editor-post-publish-button');

        $I->click('Publish');
        $I->waitForText('Post published.');

        $I->click('//div[@class="post-publish-panel__postpublish-buttons"]/a[text()="View Post"]');
        $I->waitForElement('.wp-block-advgb-newsletter');

        // Check
        $I->seeElement('//div[contains(@class, "advgb-newsletter")]/form/div[@class="advgb-form-field"]/input[contains(@class, "advgb-form-input-email")]');
    }

    public function changeNewsletterStyles(AcceptanceTester $I)
    {
        $I->wantTo('Change newsletter form styles');

        // Change
        $I->selectOption('//label[text()="Form style"]/following-sibling::node()', array('text' => 'Alternative'));
        $I->fillField('//label[text()="Form width (px)"]/following-sibling::node()/following-sibling::node()', 500);

        $I->updatePost();
        $I->waitForElement('.wp-block-advgb-newsletter');

        // Check
        $I->seeElement('//div[contains(@class, "advgb-newsletter")][contains(@class, "style-alt")][contains(@style, "max-width:500px")]');
        $I->seeElement('//div[contains(@class, "advgb-newsletter")]//input[contains(@class, "advgb-form-input-fname")]');
        $I->seeElement('//div[contains(@class, "advgb-newsletter")]//input[contains(@class, "advgb-form-input-lname")]');
        $I->seeElement('//div[contains(@class, "advgb-newsletter")]//input[contains(@class, "advgb-form-input-email")]');
    }

    public function changeTextHolder(AcceptanceTester $I)
    {
        $I->wantTo('Change newsletter form input placeholder');

        // Change
        $I->fillField('//label[text()="First Name input placeholder"]/following-sibling::node()', 'Your Name');
        $I->fillField('//label[text()="Last Name input placeholder"]/following-sibling::node()', 'Your Nickname');
        $I->fillField('//label[text()="Email input placeholder"]/following-sibling::node()', 'Your Email');
        $I->fillField('//label[text()="Submit text"]/following-sibling::node()', 'Subscribe');
        $I->fillField('//label[text()="Empty field warning text"]/following-sibling::node()', 'Not allow empty field!');
        $I->fillField('//label[text()="Submit success text"]/following-sibling::node()', 'Thanks for subscribe!');

        $I->updatePost();
        $I->waitForElement('.wp-block-advgb-newsletter');

        // Check
        $I->seeElement('//div[contains(@class, "advgb-newsletter")]//input[contains(@class, "advgb-form-input-fname")][@placeholder="Your Name"]');
        $I->seeElement('//div[contains(@class, "advgb-newsletter")]//input[contains(@class, "advgb-form-input-lname")][@placeholder="Your Nickname"]');
        $I->seeElement('//div[contains(@class, "advgb-newsletter")]//input[contains(@class, "advgb-form-input-email")][@placeholder="Your Email"]');
        $I->seeElement('//div[contains(@class, "advgb-newsletter")]//button[contains(@class, "advgb-form-submit")][@data-alert="Not allow empty field!"]');
        $I->seeElement('//div[contains(@class, "advgb-newsletter")]//button[contains(@class, "advgb-form-submit")][@data-success="Thanks for subscribe!"]');
    }
}