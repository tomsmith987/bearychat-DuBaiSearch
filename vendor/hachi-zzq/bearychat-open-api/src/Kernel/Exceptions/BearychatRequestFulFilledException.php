<?php
/**
 * Created by PhpStorm.
 * User: hachi
 * Date: 2018/9/29
 * Time: 15:10.
 */

namespace Hachi\Bearychat\Kernel\Exceptions;

use Throwable;

/**
 * bearychat 异常
 * Class BearychatRequestException.
 */
class BearychatRequestFulFilledException extends \Exception
{
    protected $bearychatErrorCode;

    protected $message;

    public function __construct(string $message = '', $bearychatErrorCode, $code = 0, Throwable $previous = null)
    {
        $this->bearychatErrorCode = $bearychatErrorCode;
        $this->message = $message;
        parent::__construct($message, $code, $previous = null);
    }

    /**
     * 返回 bearychat 的错误码
     *
     * @return mixed
     *
     * @author zhuzhengqian <hachi.zzq@gmail.com>
     */
    public function getBearychatErrorCode()
    {
        return $this->bearychatErrorCode;
    }

    /**
     * 返回 bearychat 的错误信息.
     *
     * @return string
     *
     * @author zhuzhengqian <hachi.zzq@gmail.com>
     */
    public function getBearychatErrorMessage()
    {
        return $this->message;
    }
}
