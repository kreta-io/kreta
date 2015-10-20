/*
 * This file belongs to Kreta.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

import React from 'react';
import classnames from 'classnames';

export default React.createClass({
  propTypes: {
    open: React.PropTypes.bool
  },
  render() {
    const classes = classnames({
      'content__right': true,
      'content__right--visible': this.props.open
    });
    return (
      <div className={classes}>
        {this.props.children}
      </div>
    );
  }
});
