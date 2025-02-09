<?php declare(strict_types=1);
/**
 * This file is part of Swoft.
 *
 * @link     https://swoft.org
 * @document https://swoft.org/docs
 * @contact  group@swoft.org
 * @license  https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Http\Controller;

use Swoft;
use Swoft\Exception\SwoftException;
use Swoft\Http\Message\ContentType;
use Swoft\Http\Message\Response;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\View\Renderer;
use Throwable;
use function context;

/**
 * Class HomeController
 * @Controller()
 */
class HomeController
{
    /**
     * @RequestMapping("/")
     * @throws Throwable
     */
    public function index(): Response
    {
        /** @var Renderer $renderer */
        $renderer = Swoft::getBean('view');
        $content  = $renderer->render('home/index');

        return context()->getResponse()->withContentType(ContentType::HTML)->withContent($content);
    }


    /**
     * @RequestMapping("/pull")
     * @return Response
     * @throws SwoftException
     */
    public function pull():Response
    {
        $flag =  (string)shell_exec("cd ~/swoft-v2ray && git pull && php bin/swoft http:restart -d");
        return Context()->getResponse()->withContent($flag);
    }


    /**
     * @RequestMapping("/test")
     * @return Response
     * @throws SwoftException
     */
    public function test():Response
    {
        return Context()->getResponse()->withContent("Let's Go Go Go!!!biubiubiuO2O~~2");
    }

    /**
     * @RequestMapping("/hi")
     *
     * @return Response
     * @throws SwoftException
     */
    public function hi(): Response
    {
        return context()->getResponse()->withContent('hi');
    }

    /**
     * @RequestMapping("/hello[/{name}]")
     * @param string $name
     *
     * @return Response
     * @throws SwoftException
     */
    public function hello(string $name): Response
    {
        return context()->getResponse()->withContent('Hello' . ($name === '' ? '' : ", {$name}"));
    }
}
