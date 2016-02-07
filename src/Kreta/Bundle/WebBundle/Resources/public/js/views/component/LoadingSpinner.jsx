/*
 * This file is part of the Kreta package.
 *
 * (c) Beñat Espiña <benatespina@gmail.com>
 * (c) Gorka Laucirica <gorka.lauzirika@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

import './../../../scss/components/_loading-spinner';

import React from 'react';

class LoadingSpinner extends React.Component {
  render() {
    return (
      <svg className="loading-spinner" viewBox="0 0 60 60">
        <path className="loading-spinner__item"
              d="M30,48.814c-0.864,0-1.565-0.701-1.565-1.565s0.7-1.565,1.565-1.565c8.648,0,15.684-7.036,15.684-15.684
                c0-0.864,0.7-1.565,1.565-1.565s1.565,0.701,1.565,1.565C48.814,40.374,40.374,48.814,30,48.814z"/>
        <path className="loading-spinner__item"
              d="M12.751,31.565c-0.864,0-1.565-0.701-1.565-1.565c0-10.374,8.44-18.815,18.814-18.815
                c0.864,0,1.565,0.7,1.565,1.565s-0.7,1.565-1.565,1.565c-8.648,0-15.684,7.036-15.684,15.685
                C14.316,30.864,13.615,31.565,12.751,31.565z"/>
        <path d="M28.02,36.033c-0.344,0-0.689-0.113-0.977-0.342l-4.971-3.971c-0.675-0.539-0.785-1.524-0.246-2.2
                c0.54-0.674,1.524-0.784,2.199-0.246l3.877,3.097l7.941-7.946c0.611-0.611,1.602-0.611,2.213-0.001
                c0.611,0.611,0.611,1.602,0.001,2.213l-8.931,8.936C28.823,35.878,28.422,36.033,28.02,36.033z"/>
      </svg>
    );
  }
}

export default LoadingSpinner;
