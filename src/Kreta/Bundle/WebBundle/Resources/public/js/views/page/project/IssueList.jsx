/*
 * This file is part of the Kreta package.
 *
 * (c) Beñat Espiña <benatespina@gmail.com>
 * (c) Gorka Laucirica <gorka.lauzirika@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

import SettingsIcon from './../../../../svg/settings';

import React from 'react';
import {connect} from 'react-redux';

import ContentMiddleLayout from './../../layout/ContentMiddleLayout';
import ContentRightLayout from './../../layout/ContentRightLayout';
import CurrentProjectActions from './../../../actions/CurrentProject';
import Filter from './../../component/Filter';
import IssuePreview from './../../component/IssuePreview';
import IssueShow from './../issue/Show';
import LoadingSpinner from './../../component/LoadingSpinner';
import NavigableList from './../../component/NavigableList';
import PageHeader from './../../component/PageHeader';

class IssueList extends React.Component {
  filterIssues(filters) {
    this.props.dispatch(CurrentProjectActions.filterIssues(filters));
  }

  selectCurrentIssue(issue) {
    this.props.dispatch(CurrentProjectActions.selectCurrentIssue(issue));
  }

  selectCurrentIssueByIndex(index) {
    this.props.dispatch(CurrentProjectActions.selectCurrentIssue(this.props.currentProject.issues[index]));
  }

  hideIssue() {
    this.props.dispatch(CurrentProjectActions.selectCurrentIssue(null));
  }

  render() {
    if (this.props.currentProject.fetchingProjects || this.props.currentProject.fetchingIssues) {
      return <LoadingSpinner/>;
    }
    const issuesEl = this.props.currentProject.issues.map((issue, index) => {
        return <IssuePreview issue={issue}
                             key={index}
                             onClick={this.selectCurrentIssue.bind(this, issue)}
                             selected={this.props.currentProject.selectedIssue &&
                                       this.props.currentProject.selectedIssue.id === issue.id}/>;
      }),
      links = [{
        href: `/project/${this.props.currentProject.project.id}/settings`,
        icon: SettingsIcon,
        title: 'Settings',
        color: 'green'
      }],
      buttons = [{
        href: `/project/${this.props.currentProject.project.id}/issue/new`,
        title: 'New issue'
      }],
      project = this.props.currentProject.project;
    let issue = '';
    if (this.props.currentProject.selectedIssue) {
      issue = <IssueShow issue={this.props.currentProject.selectedIssue}
                         project={project}/>;
    }

    return (
      <div>
        <ContentMiddleLayout>
          <PageHeader buttons={buttons}
                      image={project.image ? project.image.name : ''}
                      links={links}
                      title={project.name}/>
          <Filter filters={this.props.currentProject.filters}
                  onFiltersChanged={this.filterIssues.bind(this)}/>

          <NavigableList className="issues"
                         onYChanged={this.selectCurrentIssueByIndex.bind(this)}
                         ref="navigableList"
                         yLength={issuesEl.length}>
            {issuesEl}
          </NavigableList>
        </ContentMiddleLayout>
        <ContentRightLayout isOpen={this.props.currentProject.selectedIssue ? true : false}
                            onRequestClose={this.hideIssue.bind(this)}>
          {issue}
        </ContentRightLayout>
      </div>
    );
  }
}

const mapStateToProps = (state) => {
  return {
    currentProject: state.currentProject
  };
};

export default connect(mapStateToProps)(IssueList);
