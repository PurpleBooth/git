<?php
/**
 * This file is part of SebastianFeldmann\Cli.
 *
 * (c) Sebastian Feldmann <sf@sebastian-feldmann.info>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace SebastianFeldmann\Git\Operator;

/**
 * Class OperatorTest
 *
 * @package SebastianFeldmann\Git
 */
abstract class OperatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Return repository mock.
     *
     * @return \SebastianFeldmann\Git\Repository
     */
    protected function getRepoMock()
    {
        $repo = $this->getMockBuilder('\\SebastianFeldmann\\Git\\Repository')
                     ->disableOriginalConstructor()
                     ->getMock();

        return $repo;
    }

    /**
     * Return runner mock.
     *
     * @return \SebastianFeldmann\Cli\Command\Runner
     */
    protected function getRunnerMock()
    {
        $runner = $this->getMockBuilder('\\SebastianFeldmann\\Cli\\Process\\Runner')
                       ->disableOriginalConstructor()
                       ->getMock();

        return $runner;
    }
}
