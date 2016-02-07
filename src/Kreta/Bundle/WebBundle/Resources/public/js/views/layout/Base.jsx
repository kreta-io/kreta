/*
 * This file is part of the Kreta package.
 *
 * (c) Beñat Espiña <benatespina@gmail.com>
 * (c) Gorka Laucirica <gorka.lauzirika@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

import './../../../scss/layout/_base';

import {connect} from 'react-redux';
import React from 'react';

import ContentLayout from './ContentLayout';
import MainMenu from './MainMenu';
import NotificationLayout from './NotificationLayout';

import LoadingSpinner from './../component/LoadingSpinner';
import ProfileActions from './../../actions/Profile';
import ProjectActions from './../../actions/Projects';

class Base extends React.Component {
  componentDidMount() {
    const {dispatch} = this.props;
    dispatch(ProjectActions.fetchProjects());
    dispatch(ProfileActions.fetchProfile());
  }

  render() {
    if (this.props.fetching) {
      return <LoadingSpinner/>
    }

    return (
      <div className="base-layout">
        <NotificationLayout/>
        <MainMenu/>
        <ContentLayout>
          {this.props.children}
        </ContentLayout>
      </div>
    );
  }
}

const mapStateToProps = (state) => {
  return {
    fetching: state.projects.fetching || state.profile.fetching
  };
};

export default connect(mapStateToProps)(Base);
