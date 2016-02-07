/*
 * This file is part of the Kreta package.
 *
 * (c) Beñat Espiña <benatespina@gmail.com>
 * (c) Gorka Laucirica <gorka.lauzirika@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

import ActionTypes from './../constants/ActionTypes';

const initialState = {
  highlightedProject: null,
  projectsVisible: false
};

export default function reducer(state = initialState, action = {}) {
  switch (action.type) {
    case ActionTypes.MAIN_MENU_SHOW_PROJECTS:
      return {...state, projectsVisible: true};

    case ActionTypes.MAIN_MENU_HIDE_PROJECTS:
      return {...state, projectsVisible: false};

    case ActionTypes.MAIN_MENU_HIGHLIGHT_PROJECT:
      return {...state, highlightedProject: action.highlightedProject};

    case ActionTypes.PROJECTS_RECEIVED:
      if (action.projects.length > 0) {
        return {...state, highlightedProject: action.projects[0]};
      }
      return state;

    default:
      return state;
  }
}
