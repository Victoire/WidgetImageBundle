@mink:selenium2 @alice(Page)  @reset-schema
Feature: Create a Image widget

    Background:
        Given I maximize the window
        And I am on homepage

    Scenario: I create a new Image widget
        When I switch to "layout" mode
        Then I should see "New content"
        When I select "Image" from the "1" select of "main_content" slot
        Then I should see "Widget  (Image)"