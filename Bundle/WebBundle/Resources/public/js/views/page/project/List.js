/*
 * This file belongs to Kreta.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

import React from 'react';
import {Link, History} from 'react-router';
import $ from 'jquery';

import NavigableCollection from '../../../mixins/NavigableCollection.js';
import ProjectPreview from '../../component/ProjectPreview';

export default React.createClass({
  propTypes: {
    onProjectSelected: React.PropTypes.func
  },
  mixins: [History, NavigableCollection],
  getInitialState() {
    return {
      projects: App.collection.project.clone(),
      selectedShortcut: 0
    };
  },
  getDefaultProps() {
    return {
      shortcuts: [{
        'icon': 'list',
        'path': '/project/',
        'tooltip': 'Show full project'
      }, {
        'icon': 'add',
        'path': '/issue/new/',
        'tooltip': 'New task'
      }]
    };
  },
  onKeyUp(ev) {
    if (ev.which === 37) { // Left
      if (this.state.selectedShortcut > 0) {
        this.setState({
          selectedShortcut: this.state.selectedShortcut - 1
        });
      }
    } else if (ev.which === 39) { // Right
      if (this.state.selectedShortcut + 1 < this.props.shortcuts.length) {
        this.setState({
          selectedShortcut: this.state.selectedShortcut + 1
        });
      }
    } else if (ev.which === 13) { // Enter
      this.onShortcutClick();
    } else { // Filter
      this.setState({
        projects: App.collection.project.filter(this.refs.filter.value),
        selectedItem: 0
      });
    }
  },
  onMouseEnter(ev) {
    this.setState({
      selectedItem: $(ev.currentTarget).index()
    });
  },
  onShortcutSelected(ev) {
    this.setState({
      selectedShortcut: $(ev.currentTarget).index()
    });
  },
  onShortcutClick() {
    const projectId = this.state.projects.at(this.state.selectedItem).id;
    this.history.pushState(null, this.props.shortcuts[this.state.selectedShortcut].path + projectId);
    this.props.onProjectSelected();
  },
  render() {
    var projectItems = this.state.projects.map((project, index) => {
      return <ProjectPreview key={index}
                             onMouseEnter={this.onMouseEnter}
                             onShortcutClick={this.onShortcutClick}
                             onShortcutEnter={this.onShortcutSelected}
                             project={project}
                             selected={this.state.selectedItem === index}
                             selectedShortcut={this.state.selectedShortcut}
                             shortcuts={this.props.shortcuts}/>;
    });

    return (
      <div>
        <div className="simple-header">
          <div className="simple-header-filters">
            <span className="simple-header-filter">Sort by <strong>priority</strong></span>
          </div>
          <div className="simple-header-actions">
            <Link className="button green small" to="/project/new">New</Link>
          </div>
        </div>
        <input autoFocus
               className="project-list__filter"
               onKeyUp={this.onKeyUp}
               ref="filter"
               type="text"/>
        <ul className="project-preview__list" ref="navigableList">
          { projectItems }
        </ul>
      </div>
    );
  }
});
