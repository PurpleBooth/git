<?php
/**
 * This file is part of SebastianFeldmann\Git.
 *
 * (c) Sebastian Feldmann <sf@sebastian-feldmann.info>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace SebastianFeldmann\Git;

use SebastianFeldmann\Cli\Process\Runner;

/**
 * Class Repository
 *
 * @package SebastianFeldmann\Git
 * @author  Sebastian Feldmann <sf@sebastian-feldmann.info>
 * @link    https://github.com/sebastianfeldmann/git
 * @since   Class available since Release 0.9.0
 */
class Repository
{
    /**
     * Path to git repository root.
     *
     * @var string
     */
    private $root;

    /**
     * Path to .git directory
     *
     * @var string
     */
    private $dotGitDir;

    /**
     * Commit message.
     *
     * @var \SebastianFeldmann\Git\CommitMessage
     */
    private $commitMsg;

    /**
     * @var \SebastianFeldmann\Cli\Command\Runner
     */
    private $runner;

    /**
     * Map of operators
     *
     * @var array
     */
    private $operator = [];

    /**
     * Repository constructor.
     *
     * @param string                                $root
     * @param \SebastianFeldmann\Cli\Process\Runner $runner
     */
    public function __construct(string $root = '', Runner $runner = null)
    {
        $path = empty($root) ? getcwd() : realpath($root);
        // check for existing .git dir
        if (!is_dir($path . DIRECTORY_SEPARATOR . '.git')) {
            throw new \RuntimeException(sprintf('Invalid git repository: %s', $root));
        }
        $this->root      = $path;
        $this->dotGitDir = $this->root . DIRECTORY_SEPARATOR . '.git';
        $this->runner    = null == $runner ? new Runner\Simple() : $runner;
    }

    /**
     * Root path getter.
     *
     * @return string
     */
    public function getRoot() : string
    {
        return $this->root;
    }

    /**
     * Returns the path to the hooks directory.
     *
     * @return string
     */
    public function getHooksDir() : string
    {
        return $this->dotGitDir . DIRECTORY_SEPARATOR . 'hooks';
    }

    /**
     * Check for a hook file.
     *
     * @param  string $hook
     * @return bool
     */
    public function hookExists($hook) : bool
    {
        return file_exists($this->getHooksDir() . DIRECTORY_SEPARATOR . $hook);
    }

    /**
     * CommitMessage setter.
     *
     * @param \SebastianFeldmann\Git\CommitMessage $commitMsg
     */
    public function setCommitMsg(CommitMessage $commitMsg)
    {
        $this->commitMsg = $commitMsg;
    }

    /**
     * CommitMessage getter.
     *
     * @return \SebastianFeldmann\Git\CommitMessage
     */
    public function getCommitMsg() : CommitMessage
    {
        if (null === $this->commitMsg) {
            throw new \RuntimeException('No commit message available');
        }
        return $this->commitMsg;
    }

    /**
     * Get changed file resolver.
     *
     * @return \SebastianFeldmann\Git\Operator\Index
     */
    public function getIndexOperator()
    {
        return $this->getOperator('Index');
    }

    /**
     * Return requested operator.
     *
     * @param  string $name
     * @return mixed
     */
    private function getOperator(string $name)
    {
        if (!isset($this->operator[$name])) {
            $class                 = '\\SebastianFeldmann\\Git\\Operator\\' . $name;
            $this->operator[$name] = new $class($this->runner, $this);
        }
        return $this->operator[$name];
    }
}
