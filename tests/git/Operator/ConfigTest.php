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

use SebastianFeldmann\Cli\Command\Result as CommandResult;
use SebastianFeldmann\Cli\Command\Runner\Result as RunnerResult;

/**
 * Class ConfigTest
 *
 * @package SebastianFeldmann\Git
 * @author  Sebastian Feldmann <sf@sebastian-feldmann.info>
 * @link    https://github.com/sebastianfeldmann/git
 * @since   Class available since Release 0.9.0
 */
class ConfigTest extends OperatorTest
{
    /**
     * Tests ::getChangedFilesSince
     */
    public function testHas()
    {
        $repo = $this->getRepoMock();
        $runner = $this->getRunnerMock();
        $cmd = new CommandResult('git ...', 0);
        $result = new RunnerResult($cmd);

        $repo->method('getRoot')->willReturn(realpath(__FILE__.'/../../..'));
        $runner->method('run')->willReturn($result);

        $config = new Config($runner, $repo);
        $hasKey = $config->has('core.commentchar');

        $this->assertEquals(true, $hasKey);
    }

    /**
     * Tests Log::getChangedFilesSince
     */
    public function testGetCommitsSince()
    {
        $repo = $this->getRepoMock();
        $runner = $this->getRunnerMock();
        $cmd = new CommandResult('git ...', 0);
        $result = new RunnerResult($cmd);

        $repo->method('getRoot')->willReturn(realpath(__FILE__.'/../../..'));
        $runner->method('run')->willReturn($result);

        $config = new Config($runner, $repo);
        $value = $config->get('core.commentchar');

        $this->assertEquals('#', $value);
    }
}
