@mink:selenium2 @alice(Page) @alice(MediaFile) @reset-schema
Feature: Manage an Image widget

    Background:
        Given I am on homepage

    Scenario: I can create a new Image widget
        When I switch to "layout" mode
        Then I should see "New content"
        When I select "Image" from the "1" select of "main_content" slot
        Then I should see "Widget (Image)"
        And I should see "1" quantum
        When I attach image with id "1" to victoire field "a_static_widget_image_image_widget"
        And I fill in "_a_static_widget_image[alt]" with "My alternative text"
        And I fill in "_a_static_widget_image[legend]" with "My legend"
        And I submit the widget
        Then I should see "My legend"
        And I should see an image with url "/uploads/55953304833d5.jpg" and alternative text "My alternative text"

    Scenario: I can update an Image widget
        Given the following WidgetMap:
            | view | action | slot         |
            | home | create | main_content |
        And the following WidgetImage:
            | widgetMap | alt                        | image    | legend           |
            | home      | Alternative text to modify | victoire | Legend to modify |
        When I reload the page
        Then I should see "Legend to modify"
        And I should see an image with url "/uploads/55dc8d8a4c9d3.jpg" and alternative text "Alternative text to modify"
        When I switch to "edit" mode
        And I edit the "Image" widget
        And I should see "Widget #1 (Image)"
        And I should see "1" quantum
        When I attach image with id "1" to victoire field "a_static_widget_image_image_widget"
        And I fill in "_a_static_widget_image[alt]" with "Alternative text modified"
        And I fill in "_a_static_widget_image[legend]" with "Legend modified"
        And I submit the widget
        Then I should see "Legend modified"
        And I should see an image with url "/uploads/55953304833d5.jpg" and alternative text "Alternative text modified"