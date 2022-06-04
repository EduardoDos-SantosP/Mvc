<?php

namespace Edsp\Mvc\Views;

use Edsp\Mvc\Views\Interfaces\IPage;

class Page extends AbstractView implements IPage
{
    protected string $lang = 'pt-br';
    protected string $title;
    protected AbstractView $head;
    protected AbstractView $body;

    public function getLang(): string
    {
        return $this->lang;
    }

    public function setLang(string $lang): static
    {
        $this->lang = $lang;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;
        $this->children->put('title', $title);

        return $this;
    }

    public function getBody(): AbstractView
    {
        return $this->body;
    }

    public function setBody(AbstractView $content): static
    {
        $this->body = $content;
        $this->children->put('body', $content);
        $this->mount();

        return $this;
    }

    public function getHead(): AbstractView
    {
        return $this->head;
    }

    public function setHead(AbstractView $content): static
    {
        $this->body = $content;
        $this->children->put('head', $content);
        $this->mount();

        return $this;
    }
}