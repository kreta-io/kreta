/*
 * This file belongs to Kreta.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

export class Participant extends Backbone.Model {
  constructor(options) {
      super(options);
  }
  toString () {
    return this.get('user').first_name + ' ' + this.get('user').last_name;
  }
}
