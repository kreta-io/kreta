/*
 * This file is part of the Kreta package.
 *
 * (c) Beñat Espiña <benatespina@gmail.com>
 * (c) Gorka Laucirica <gorka.lauzirika@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

import {routeActions} from 'react-router-redux';

import ActionTypes from './../constants/ActionTypes';
import IssueApi from './../api/Issue';
import ProjectApi from './../api/Project';

const Actions = {
  fetchProject: (projectId) => {
    return (dispatch) => {
      dispatch({
        type: ActionTypes.CURRENT_PROJECT_FETCHING
      });
      ProjectApi.getProject(projectId)
        .then((project) => {
          dispatch({
            type: ActionTypes.CURRENT_PROJECT_RECEIVED,
            project
          });
        });
      IssueApi.getIssues({project: projectId})
        .then((issues) => {
          dispatch({
            type: ActionTypes.CURRENT_PROJECT_ISSUES_RECEIVED,
            issues
          });
        });
    };
  },
  selectCurrentIssue: (issue) => {
    if (typeof issue === 'object' || issue === null) {
      return {
        type: ActionTypes.CURRENT_PROJECT_SELECTED_ISSUE_CHANGED,
        selectedIssue: issue
      };
    }

    return (dispatch) => {
      dispatch({
        type: ActionTypes.CURRENT_PROJECT_SELECTED_ISSUE_FETCHING
      });
      IssueApi.getIssue(issue)
        .then((receivedIssue) => {
          dispatch({
            type: ActionTypes.CURRENT_PROJECT_SELECTED_ISSUE_CHANGED,
            selectedIssue: receivedIssue
          });
        });
    };
  },
  createIssue: (issueData) => {
    return (dispatch) => {
      dispatch({
        type: ActionTypes.CURRENT_PROJECT_ISSUE_CREATING
      });
      IssueApi.postIssue(issueData)
        .then((createdIssue) => {
          dispatch({
            type: ActionTypes.CURRENT_PROJECT_ISSUE_CREATED,
            issue: createdIssue
          });
          dispatch(
            routeActions.push(`/project/${issueData.project}/issue/${createdIssue.id}`)
          );
        })
        .catch((errorData) => {
          errorData.then((errors) => {
            dispatch({
              type: ActionTypes.CURRENT_PROJECT_ISSUE_CREATE_ERROR,
              errors
            });
          });
        });
    };
  },
  updateIssue: (issueData, issueId) => {
    return (dispatch) => {
      dispatch({
        type: ActionTypes.CURRENT_PROJECT_ISSUE_UPDATE
      });
      IssueApi.putIssue(issueId, issueData)
        .then((updatedIssue) => {
          dispatch({
            type: ActionTypes.CURRENT_PROJECT_ISSUE_UPDATED,
            issue: updatedIssue
          });
        })
        .catch((errorData) => {
          errorData.then((errors) => {
            dispatch({
              type: ActionTypes.CURRENT_PROJECT_ISSUE_UPDATE_ERROR,
              errors
            });
          });
        });
    };
  },
  filterIssues: (filters) => {
    return (dispatch) => {
      dispatch({
        type: ActionTypes.CURRENT_PROJECT_ISSUE_FILTERING,
        filters
      });
      IssueApi.getIssues(filters)
        .then((filteredIssues) => {
          dispatch({
            type: ActionTypes.CURRENT_PROJECT_ISSUE_FILTERED,
            issues: filteredIssues
          });
        });
    };
  },
  addParticipant: (user) => {
    return (dispatch) => {
      const participant = {
        role: 'ROLE_PARTICIPANT',
        user
      };

      setTimeout(() => {
        dispatch({
          type: ActionTypes.CURRENT_PROJECT_PARTICIPANT_ADDED,
          participant
        });
      });
    };
  }
};

export default Actions;
