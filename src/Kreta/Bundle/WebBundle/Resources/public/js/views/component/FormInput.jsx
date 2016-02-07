/*
 * This file is part of the Kreta package.
 *
 * (c) Beñat Espiña <benatespina@gmail.com>
 * (c) Gorka Laucirica <gorka.lauzirika@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

import '../../../scss/components/_form.scss';

import React from 'react';
import classnames from 'classnames';

class FormInput extends React.Component {
  static propTypes = {
    error: React.PropTypes.bool,
    multiline: React.PropTypes.bool,
    success: React.PropTypes.bool
  };

  componentWillMount() {
    this.setState({value: this.props.value ? this.props.value : ''});
  }

  onChange(event) {
    this.setState({value: event.target.value});
  }

  getLabel() {
    const {label, ...props} = this.props;

    return (
      <label className="form-input__label">{label}</label>
    );
  }

  getBar() {
    const {label, ...props} = this.props;

    if (typeof label === 'undefined') {
      return;
    }

    return (
      <div className="form-input__bar"></div>
    );
  }

  getInputField() {
    const {label, value, ...props} = this.props,
      inputClasses = classnames('form-input__input', {
        'form-input__input--filled': this.state.value.length > 0
      });

    if (this.props.multiline) {
      return (
        <textarea className={inputClasses}
                  onChange={this.onChange.bind(this)}
                  ref="input"
                  value={this.state.value}
          {...props}>
        </textarea>
      );
    }

    return (
      <input className={inputClasses}
             onChange={this.onChange.bind(this)}
             ref="input"
             value={this.state.value}
        {...props}/>
    );
  }

  render() {
    const {label, ...props} = this.props,
      rootClasses = classnames('form-input', {
        'form-input--error': this.props.error,
        'form-input--success': this.props.success
      });

    return (
      <div className={rootClasses} onClick={this.focus.bind(this)}>
        {this.getInputField()}
        {this.getLabel()}
        {this.getBar()}
      </div>
    );
  }

  blur() {
    this.refs.input.blur();
  }

  focus() {
    this.refs.input.focus();
  }
}

export default FormInput;
