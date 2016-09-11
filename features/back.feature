Feature: Check that the back part of the Mowlkky website works as expected.

  Scenario: Create a user with the mowlkky:user:create command and check if there is no error.
    Given the fixtures file "standard_test.yml" is loaded
    When I run "mowlkky:user:create" interactive command with input "test@test.com|Test|Test|A2Jag90onZ|0"
    Then I should see "User was registered with id" in the command output

  Scenario: Create a user with an already registered email with the mowlkky:user:create command and check if there is an error.
    Given the fixtures file "standard_test.yml" is loaded
    When I run "mowlkky:user:create" interactive command with input "b.bobbinen@molkky.fr|Bobby|Bobbinen|m0lkKyR0ks|0"
    Then An exception should be thrown in the command with message "There is already another registered user with email b.bobbinen@molkky.fr"