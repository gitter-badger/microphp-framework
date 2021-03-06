<?php /** MicroLogger */

namespace Micro\Logger;

/**
 * Logger manager
 *
 * @author Oleg Lunegov <testuser@mail.linpax.org>
 * @link https://github.com/lugnsk/micro
 * @copyright Copyright &copy; 2013 Oleg Lunegov
 * @license /LICENSE
 * @package Micro
 * @subpackage Logger
 * @version 1.0
 * @since 1.0
 */
class Logger
{
    /** @var array $supportedLevels supported logger levels */
    public static $supportedLevels = [
        'emergency',
        'alert',
        'critical',
        'error',
        'warning',
        'notice',
        'info',
        'debug'
    ];

    /** @var ILogger[] $loggers defined loggers */
    protected $loggers = array();


    /**
     * Export loggers
     *
     * @access public
     *
     * @param array $params configuration array
     *
     * @result void
     */
    public function __construct(array $params = [])
    {
        foreach ($params['loggers'] AS $name => $log) {
            if (empty($log['class']) || !class_exists($log['class'])) {
                continue;
            }

            if (empty($log['levels'])) {
                continue;
            }

            $this->loggers[$name] = new $log['class']($params['container'], $log);
        }
    }

    /**
     * Send message to loggers
     *
     * @access public
     *
     * @param string $level logger level
     * @param string $message message to write
     *
     * @result void
     * @throws \Micro\Base\Exception
     */
    public function send($level, $message)
    {
        foreach ($this->loggers AS $log) {
            /** @var ILogger $log logger */
            if ($log->isSupportedLevel($level)) {
                $log->sendMessage($level, $message);
            }
        }
    }
}
