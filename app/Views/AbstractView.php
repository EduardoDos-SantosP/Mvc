<?php

namespace Edsp\Mvc\Views;

use Edsp\Mvc\Enums\EnumViewInstance;
use Edsp\Mvc\ExpandedObject;
use Edsp\Mvc\Views\Interfaces\IChildView;
use Edsp\Mvc\Views\Interfaces\IView;
use Exception;
use Illuminate\Support\Collection;

class AbstractView extends ExpandedObject implements IView
{
    protected Collection $children;
    protected string $html;
    protected string $mountedHtml;
    public array $statics = [];

    public function __construct(string|ViewContext $html)
    {
        $this->html = is_string($html) ? $html : $html->getString();
        $this->children = new Collection();
    }

    public function toString(): string
    {
        $this->mount();
        return $this->mountedHtml;
    }

    public function render(): void
    {
        echo $this->toString();
    }

    protected function mount(): self
    {
        $this->mountedHtml = $this->html;

        foreach ($this->children as $child) $child->mount();

        $this->insertStatics();
        $this->insertChildren();

        return $this;
    }

    private function insertChildren(): void
    {
        $replace = fn(string $index, string $replacement) => preg_replace(
            "/@\[$index]/",
            $replacement,
            $this->mountedHtml
        );
        /*** @var AbstractView $child */
        foreach ($this->children as $slot => $child) {
            $childHtml = $child->toString();
            $replaced = $replace($slot, $childHtml);
            if ($childHtml && $replaced === $this->mountedHtml) {
                throw new Exception(
                    "Não existe um slot com índice '$slot' na View de conteúdo '"
                    . htmlspecialchars(substr($this->html, 0, 20)) . "...'"
                );
            }
            $this->mountedHtml = $replaced;
        }
        $this->mountedHtml = $replace('.*', '');
    }

    private function insertStatics(): void
    {
        $pattern = "/@\{(.+)}/";
        while (preg_match($pattern, $this->mountedHtml, $matches)) {
            $props = explode('.', $matches[1]);
            $obj = $this->statics;
            foreach ($props as $prop) {
                $value = match (get_debug_type($obj)) {
                    'array' => $obj[$prop],
                    'string' => $obj::{$prop}(),
                    default => $obj->{$prop}
                };
                $obj = $value;
            }
            if (!isset($value)) continue;
            $this->mountedHtml = str_replace($matches[0], $value, $this->mountedHtml);
        }
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}