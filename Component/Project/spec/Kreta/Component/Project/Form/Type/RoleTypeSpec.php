<?php

/*
 * This file belongs to Kreta.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace spec\Kreta\Component\Project\Form\Type;

use Kreta\Component\Project\Model\Interfaces\ParticipantInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class RoleTypeSpec.
 *
 * @package spec\Kreta\Bundle\ProjectBundle\Form\Type
 */
class RoleTypeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Kreta\Component\Project\Form\Type\RoleType');
    }

    function it_extends_abstract_type()
    {
        $this->shouldHaveType('Symfony\Component\Form\AbstractType');
    }

    function it_sets_default_options(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'choices' => [
                ParticipantInterface::ADMIN       => 'ROLE_ADMIN',
                ParticipantInterface::PARTICIPANT => 'ROLE_PARTICIPANT'
            ]
        ])->shouldBeCalled()->willReturn($resolver);

        $this->setDefaultOptions($resolver);
    }

    function it_gets_parent()
    {
        $this->getParent()->shouldReturn('choice');
    }

    function it_gets_name()
    {
        $this->getName()->shouldReturn('kreta_project_role_type');
    }
}
