# This file belongs to Kreta.
# The source code of application includes a LICENSE file
# with all information about license.
#
# @author benatespina <benatespina@gmail.com>
# @author gorkalaucirica <gorka.lauzirika@gmail.com>

@status
Feature: Manage status
  In order to manage statuses
  As an API status
  I want to be able to GET, POST, PUT and DELETE statuses

  Background:
    Given the following users exist:
      | id | firstName | lastName | email           | password | createdAt  |
      | 0  | Kreta     | User     | user@kreta.com  | 123456   | 2014-10-20 |
      | 1  | Kreta     | User2    | user2@kreta.com | 123456   | 2014-10-20 |
      | 2  | Kreta     | User3    | user3@kreta.com | 123456   | 2014-10-20 |
    And the following workflows exist:
      | id | name       | creator        |
      | 0  | Workflow 1 | user@kreta.com |
      | 1  | Workflow 2 | user@kreta.com |
    And the following projects exist:
      | id | name           | shortName | creator        | workflow   |
      | 0  | Test project 1 | TPR1      | user@kreta.com | Workflow 1 |
      | 1  | Test project 2 | TPR2      | user@kreta.com | Workflow 2 |
    And the following issue priorities exist:
      | id | name    | project        |
      | 0  | Low     | Test project 1 |
      | 1  | Medium  | Test project 1 |
      | 2  | High    | Test project 1 |
      | 3  | Blocker | Test project 1 |
      | 4  | Low     | Test project 2 |
      | 5  | Medium  | Test project 2 |
    And the following issue types exist:
      | id | name        | project        |
      | 0  | Bug         | Test project 1 |
      | 1  | Epic        | Test project 1 |
      | 2  | New feature | Test project 1 |
      | 3  | Bug         | Test project 2 |
      | 4  | Error       | Test project 2 |
      | 5  | Story       | Test project 2 |
    And the following statuses exist:
      | id | color   | name        | workflow   |
      | 0  | #27ae60 | Open        | Workflow 1 |
      | 1  | #2c3e50 | In progress | Workflow 1 |
      | 2  | #f1c40f | Resolved    | Workflow 1 |
      | 3  | #c0392b | Closed      | Workflow 1 |
      | 4  | #27ae60 | Reopened    | Workflow 1 |
      | 5  | #27ae60 | Reopened    | Workflow 1 |
    And the following participants exist:
      | project        | user            | role             |
      | Test project 1 | user3@kreta.com | ROLE_PARTICIPANT |
      | Test project 1 | user2@kreta.com | ROLE_PARTICIPANT |
      | Test project 2 | user2@kreta.com | ROLE_PARTICIPANT |
    And the following issues exist:
      | id | numericId | project        | title        | description | reporter       | assignee       | type | status   | priority | createdAt  |
      | 0  | 1         | Test project 1 | Test issue 1 | Description | user@kreta.com | user@kreta.com | 2    | Open     | 1        | 2014-10-21 |
      | 1  | 2         | Test project 1 | Test issue 2 | Description | user@kreta.com | user@kreta.com | 1    | Resolved | 1        | 2014-10-21 |
    And the following tokens exist:
      | token          | expiresAt | scope | user            |
      | access-token-0 | null      | user  | user@kreta.com  |
      | access-token-1 | null      | user  | user2@kreta.com |
      | access-token-2 | null      | user  | user3@kreta.com |

  Scenario: Getting all the statuses of workflow 0
    Given I am authenticating with "access-token-0" token
    When I send a GET request to "/app_test.php/api/workflows/0/statuses"
    Then the response code should be 200
    And the response should contain json:
    """
      [{
        "id": "0",
        "color": "#27ae60",
        "_links": {
          "self": {
            "href": "http://localhost/app_test.php/api/workflows/0/statuses/0"
          },
          "statuses": {
            "href": "http://localhost/app_test.php/api/workflows/0/statuses"
          },
          "workflow": {
            "href": "http://localhost/app_test.php/api/workflows/0"
          }
        },
        "type": "normal",
        "name": "Open"
      }, {
        "id": "1",
        "color": "#2c3e50",
        "_links": {
          "self": {
            "href": "http://localhost/app_test.php/api/workflows/0/statuses/1"
          },
          "statuses": {
            "href": "http://localhost/app_test.php/api/workflows/0/statuses"
          },
          "workflow": {
            "href": "http://localhost/app_test.php/api/workflows/0"
          }
        },
        "type": "normal",
        "name": "In progress"
      }, {
        "id": "2",
        "color": "#f1c40f",
        
        "_links": {
          "self": {
            "href": "http://localhost/app_test.php/api/workflows/0/statuses/2"
          },
          "statuses": {
            "href": "http://localhost/app_test.php/api/workflows/0/statuses"
          },
          "workflow": {
            "href": "http://localhost/app_test.php/api/workflows/0"
          }
        },
        "type": "normal",
        "name": "Resolved"
      }, {
        "id": "3",
        "color": "#c0392b",
        "_links": {
          "self": {
            "href": "http://localhost/app_test.php/api/workflows/0/statuses/3"
          },
          "statuses": {
            "href": "http://localhost/app_test.php/api/workflows/0/statuses"
          },
          "workflow": {
            "href": "http://localhost/app_test.php/api/workflows/0"
          }
        },
        "type": "normal",
        "name": "Closed"
      }, {
        "id": "4",
        "color": "#27ae60",
        "_links": {
          "self": {
            "href": "http://localhost/app_test.php/api/workflows/0/statuses/4"
          },
          "statuses": {
            "href": "http://localhost/app_test.php/api/workflows/0/statuses"
          },
          "workflow": {
            "href": "http://localhost/app_test.php/api/workflows/0"
          }
        },
        "type": "normal",
        "name": "Reopened"
      }]
    """

  Scenario: Getting the 0 status
    Given I am authenticating with "access-token-0" token
    When I send a GET request to "/app_test.php/api/workflows/0/statuses/0"
    Then the response code should be 200
    And the response should contain json:
    """
      {
        "id": "0",
        "color": "#27ae60",
        "_links": {
          "self": {
            "href": "http://localhost/app_test.php/api/workflows/0/statuses/0"
          },
          "statuses": {
            "href": "http://localhost/app_test.php/api/workflows/0/statuses"
          },
          "workflow": {
            "href": "http://localhost/app_test.php/api/workflows/0"
          }
        }
      }
    """

  Scenario: Getting the 0 status with user which is not a participant
    Given I am authenticating with "access-token-2" token
    When I send a GET request to "/app_test.php/api/workflows/1/statuses/0"
    Then the response code should be 403
    And the response should contain json:
    """
      {
        "error": "Not allowed to access this resource"
      }
    """

  Scenario: Getting the unknown status
    Given I am authenticating with "access-token-0" token
    When I send a GET request to "/app_test.php/api/workflows/0/statuses/unknown-status"
    Then the response code should be 404
    And the response should contain json:
    """
      {
        "error": "Does not exist any object with id passed"
      }
    """

  Scenario: Creating a status
    Given I am authenticating with "access-token-0" token
    Given I set header "content-type" with value "application/json"
    When I send a POST request to "/app_test.php/api/workflows/0/statuses" with body:
    """
      {
        "color": "#FFFFFF",
        "name": "New status",
        "type": "initial"
      }
    """
    Then the response code should be 201

  Scenario: Creating a status without parameters
    Given I am authenticating with "access-token-0" token
    Given I set header "content-type" with value "application/json"
    When I send a POST request to "/app_test.php/api/workflows/0/statuses" with body:
    """
      {}
    """
    Then the response code should be 400
    And the response should contain json:
    """
      {
        "color": [],
        "name": [],
        "type": []
      }
    """

  Scenario: Creating a status without some required parameters
    Given I am authenticating with "access-token-0" token
    Given I set header "content-type" with value "application/json"
    When I send a POST request to "/app_test.php/api/workflows/0/statuses" with body:
    """
      {
        "name": "New status"
      }
    """
    Then the response code should be 400
    And the response should contain json:
    """
      {
        "color": [
          "This value should not be blank."
        ],
        "type": [
          "This value should not be blank."
        ]
      }
    """

  Scenario: Creating a status with already exists name
    Given I am authenticating with "access-token-0" token
    Given I set header "content-type" with value "application/json"
    When I send a POST request to "/app_test.php/api/workflows/0/statuses" with body:
    """
      {
        "color": "#FFFFFF",
        "name": "Open",
        "type": "initial"
      }
    """
    Then the response code should be 400
    And the response should contain json:
    """
      {
        "name": [
          "A status with identical name is already exists in this workflow"
        ]
      } 
    """

  Scenario: Creating a status with user which is not a project admin
    Given I am authenticating with "access-token-1" token
    Given I set header "content-type" with value "application/json"
    When I send a POST request to "/app_test.php/api/workflows/0/statuses" with body:
    """
      {
        "color": "#FFFFFF",
        "name": "New status",
        "type": "initial"
      }
    """
    Then the response code should be 403
    And the response should contain json:
    """
      {
        "error": "Not allowed to access this resource"
      }
    """

  Scenario: Updating the 0 status
    Given I am authenticating with "access-token-0" token
    Given I set header "content-type" with value "application/json"
    When I send a PUT request to "/app_test.php/api/workflows/0/statuses/0" with body:
    """
      {
        "color": "#FFFFFF",
        "name": "New status",
        "type": "initial"
      }
    """
    Then the response code should be 200
    And the response should contain json:
    """
      {
        "id": "0",
        "color": "#FFFFFF",
        "_links": {
          "self": {
            "href": "http://localhost/app_test.php/api/workflows/0/statuses/0"
          },
          "statuses": {
            "href": "http://localhost/app_test.php/api/workflows/0/statuses"
          },
          "workflow": {
            "href": "http://localhost/app_test.php/api/workflows/0"
          }
        }
      }
    """

  Scenario: Updating the 0 status without parameters
    Given I am authenticating with "access-token-0" token
    Given I set header "content-type" with value "application/json"
    When I send a PUT request to "/app_test.php/api/workflows/0/statuses/0" with body:
    """
      {}
    """
    Then the response code should be 400
    And the response should contain json:
    """
      {
        "color": [],
        "name": [],
        "type": []
      }
    """

  Scenario: Updating the 0 status without some required parameters
    Given I am authenticating with "access-token-0" token
    Given I set header "content-type" with value "application/json"
    When I send a PUT request to "/app_test.php/api/workflows/0/statuses/0" with body:
    """
      {
        "name": "New status"
      }
    """
    Then the response code should be 400
    And the response should contain json:
    """
      {
        "color": [
          "This value should not be blank."
        ],
        "type": [
          "This value should not be blank."
        ]
      }
    """

  Scenario: Updating the unknown status
    Given I am authenticating with "access-token-0" token
    Given I set header "content-type" with value "application/json"
    When I send a PUT request to "/app_test.php/api/workflows/0/statuses/unknown-status" with body:
    """
      {
        "color": "#FFFFFF",
        "name": "New status",
        "type": "initial"
      }
    """
    Then the response code should be 404
    And the response should contain json:
    """
      {
        "error": "Does not exist any object with id passed"
      }
    """

  Scenario: Updating the 0 status with user which is not a project admin
    Given I am authenticating with "access-token-1" token
    Given I set header "content-type" with value "application/json"
    When I send a PUT request to "/app_test.php/api/workflows/0/statuses/0" with body:
    """
      {
        "color": "#FFFFFF",
        "name": "New status",
        "type": "initial"
      }
    """
    Then the response code should be 403
    And the response should contain json:
    """
      {
        "error": "Not allowed to access this resource"
      }
    """

  Scenario: Deleting the 1 status
    Given I am authenticating with "access-token-0" token
    Given I set header "content-type" with value "application/json"
    When I send a DELETE request to "/app_test.php/api/workflows/0/statuses/1"
    Then the response code should be 204
    And the response should contain json:
    """
      {}
    """

  Scenario: Deleting the 0 status
    Given I am authenticating with "access-token-0" token
    Given I set header "content-type" with value "application/json"
    When I send a DELETE request to "/app_test.php/api/workflows/0/statuses/0"
    Then the response code should be 409
    And the response should contain json:
    """
      {
        "error": "The resource is currently in use"
      }
    """

  Scenario: Deleting the unknown status
    Given I am authenticating with "access-token-0" token
    Given I set header "content-type" with value "application/json"
    When I send a DELETE request to "/app_test.php/api/workflows/0/statuses/unknown-status"
    Then the response code should be 404
    And the response should contain json:
    """
      {
        "error": "Does not exist any object with id passed"
      }
    """

  Scenario: Deleting the 0 status with user which is not a project admin
    Given I am authenticating with "access-token-1" token
    Given I set header "content-type" with value "application/json"
    When I send a DELETE request to "/app_test.php/api/workflows/0/statuses/0"
    Then the response code should be 403
    And the response should contain json:
    """
      {
        "error": "Not allowed to access this resource"
      }
    """
