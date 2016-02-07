# This file is part of the Kreta package.
#
# (c) Beñat Espiña <benatespina@gmail.com>
# (c) Gorka Laucirica <gorka.lauzirika@gmail.com>
#
# For the full copyright and license information, please view the LICENSE
# file that was distributed with this source code.

@authentication
Feature: Manage authentication
  In order to manage authentication
  As a logged user
  I want to be able to register, login and logout

  Background:
    Given the following users exist:
      | username | firstName | lastName | email          | password |
      | user     | Kreta     | User     | user@kreta.com | 123456   |
    And the OAuth client is loaded

  Scenario: Login successfully
    Given I am on "/login"
    When I fill in the following:
      | username | user@kreta.com |
      | password | 123456         |
    And I press "_submit"
    Then I should be on the dashboard
    And I should see an access_token inside cookie

  Scenario: Login with invalid credentials
    Given I am on "/login"
    When I fill in the following:
      | username | invalid@kreta.com |
      | password | invalid           |
    And I press "_submit"
    Then I should see "Invalid credentials."
