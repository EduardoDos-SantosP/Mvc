<?php

namespace Edsp\Mvc\Http;

use Edsp\Mvc\Controllers\Controller;
use Edsp\Mvc\ExpandedObject;
use Edsp\Mvc\Throwables\InvalidRouteException;
use Exception;

class Router extends ExpandedObject
{
    public const CONTROLLER_DEFAULT = 'Home';
    public const ACTION_DEFAULT = 'view';

    private string $uri;
    private array $explodedUriCache;
    private Controller $controller;
    private string $action;
    private array $arguments;


    public function __construct(?string $uri = null)
    {
        try {
            $this->setUri($uri);
        } catch (InvalidRouteException $e) {
            throw new InvalidRouteException("A rota '$this->uri' é inválida", previous: $e);
        }
    }
    public function getUri(): string
    {
        return $this->uri;
    }

    /*** @throws InvalidRouteException */
    private function setUri(?string $uri = null): void
    {
        if (is_null($uri)) $uri = rtrim($_GET['uri'] ?? '', '/');

        if (!preg_match('/^[A-z\d\/]*$/', $uri))
            throw new InvalidRouteException("O formato da url é inválido!");

        $this->uri = $uri;
        $this->explodedUriCache = explode('/', $uri);

        $this->setController()->setAction()->setArguments();
    }

    private function setController(): self
    {
        $controllerName = array_shift($this->explodedUriCache);
        if (!$controllerName) $controllerName = self::CONTROLLER_DEFAULT;

        $controllerClass = CONTROLLERS_NAMESPACE . "\\$controllerName" . 'Controller';

        if (!class_exists($controllerClass))
            throw new InvalidRouteException("O controlador '$controllerName' não foi encontrado!");

        if (!is_subclass_of($controllerClass, Controller::class))
            throw new InvalidRouteException(
                "O controlador '$controllerName' precisa herdar a classe '" . Controller::class . "'!"
            );

        $this->controller = new $controllerClass;

        return $this;
    }

    private function setAction(): self
    {
        $actionName = array_shift($this->explodedUriCache) ?? self::ACTION_DEFAULT;

        if (!method_exists($this->controller, $actionName))
            throw new InvalidRouteException(
                "O método '$actionName' não existe no controlador '" . get_class($this->controller) . "'!"
            );
        $this->action = $actionName;

        return $this;
    }

    private function setArguments(): void
    {
        // TODO: Implementar o método setArguments() no Router
        $this->arguments = [];
    }

    public function run(): void
    {
        $this->invoke();
    }

    private function invoke(): void
    {
        echo $this->controller->{$this->action}(...$this->arguments);
    }
}