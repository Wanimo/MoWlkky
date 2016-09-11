Feature: Check that the back part of the Mowlkky website works as expected.

  Scenario: Create a user with the mowlkky:user:create command and check if there is no error.
    Given the fixtures file "standard_test.yml" is loaded
    When I run "mowlkky:user:create" interactive command with input "test@test.com|Test|Test|A2Jag90onZ|0"
    Then I should see "User was registered with id" in the command output

  Scenario: Create a user with an already registered email with the mowlkky:user:create command and check if there is an error.
    Given the fixtures file "standard_test.yml" is loaded
    When I run "mowlkky:user:create" interactive command with input "b.bobbinen@molkky.fi|Bobby|Bobbinen|m0lkKyR0ks|0"
    Then An exception should be thrown in the command with message "There is already another registered user with email b.bobbinen@molkky.fi"

  Scenario: Go to the management zone without being authenticated
    When I am on "/gestion"
    Then I should not see "Accueil zone de gestion"
    And I should see "Veuillez vous connecter"
    And I should be on "/connexion"

  Scenario: Go to the connection page, signin and be redirected and authorized in the management zone.
    Given the fixtures file "standard_test.yml" is loaded
    And I am on "/connexion"
    When I fill in "username" with "b.bobbinen@molkky.fi"
    And I fill in "password" with "molkkyrocks"
    And I press "login"
    Then I should not see "Identifiants invalides"
    And I should see "Accueil zone de gestion"
    And I should be on "/gestion/"

  Scenario: Go to the connection page, signin with bad credentials and be rejected.
    Given the fixtures file "standard_test.yml" is loaded
    And I am on "/connexion"
    When I fill in "username" with "unknown@unknown.com"
    And I fill in "password" with "123456"
    And I press "login"
    Then I should see "Identifiants invalides"
    And I should not see "Accueil zone de gestion"
    And I should be on "/connexion"