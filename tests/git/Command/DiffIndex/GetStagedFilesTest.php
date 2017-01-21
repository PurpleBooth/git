<?php
/**
 * This file is part of SebastianFeldmann\Git.
 *
 * (c) Sebastian Feldmann <sf@sebastian-feldmann.info>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace SebastianFeldmann\Git\Command\DiffIndex;

/**
 * Class GetStagedFilesTest
 *
 * @package SebastianFeldmann\Git
 */
class GetStagedFilesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests GetStagedFiles::getGitCommand
     */
    public function testGetGitCommand()
    {
        $cmd = new GetStagedFiles();
        $exe = $cmd->getCommand();

        $this->assertEquals('git diff-index --cached --name-status HEAD', $exe);
    }
}
