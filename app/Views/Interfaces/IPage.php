<?php

namespace Edsp\Mvc\Views\Interfaces;

use Edsp\Mvc\Views\AbstractView;

interface IPage extends IView
{
    public function getLang(): string;

    public function setLang(string $lang): static;

    public function getTitle(): string;

    public function setTitle(string $title): static;

    public function getBody(): AbstractView;

    public function setBody(AbstractView $content): static;

    public function getHead(): AbstractView;

    public function setHead(AbstractView $content): static;
}