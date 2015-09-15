<?php

/*
 * This file belongs to Kreta.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

$finder = Symfony\CS\Finder\DefaultFinder::create()
    ->in(__DIR__)
    ->notName('*.yml')
    ->notName('*.xml')
    ->notName('*Spec.php');

return Symfony\CS\Config\Config::create()
    ->finder($finder)
    ->level(Symfony\CS\FixerInterface::SYMFONY_LEVEL)
    ->fixers([
        '-unalign_double_arrow',
        '-concat_without_spaces',
        'align_double_arrow',
        'concat_with_spaces',
        'multiline_spaces_before_semicolon',
        'newline_after_open_tag',
        'ordered_use',
        'php4_constructor',
        'phpdoc_order',
        'short_array_syntax',
        'short_echo_tag',
        'strict',
        'strict_param'
    ]);
