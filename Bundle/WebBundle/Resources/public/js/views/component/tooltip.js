/*
 * This file belongs to Kreta.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

export class TooltipView {
  constructor() {
    $(document.body).on('mouseenter', '[data-tooltip-text]', this.onMouseEnter);
    $(document.body).on('mouseleave', '[data-tooltip-text]', this.onMouseLeave);
  }

  onMouseEnter() {
    if($(this).children('.tooltip').length == 0) {
      var tooltipPos = $(this).attr('data-tooltip-position') ? $(this).attr('data-tooltip-position') : 'left';
      $(this).append('<span class="tooltip ' + tooltipPos + '">' +  $(this).attr('data-tooltip-text') + '</span>');
    }

    $(this).find('.tooltip').addClass('visible');
  }

  onMouseLeave() {
    $(this).find('.tooltip').removeClass('visible');
  }
}