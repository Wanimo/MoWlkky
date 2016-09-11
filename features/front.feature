Feature: Check that the front part of the Mowlkky website works as expected.

  Scenario: Check the home page
    Given the fixtures file "standard_test.yml" is loaded
    When I am on "/"
    Then I should see "MoWlkky"
    And I should see "Préparez, organisez, visualisez vos tournois de Molkky !"
    And the response status code should be 200
