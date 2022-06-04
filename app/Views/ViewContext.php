<?php

namespace Edsp\Mvc\Views;

use Edsp\Mvc\Enums\EnumViewInstance;
use Exception;

final class ViewContext
{
    public function __construct(
        protected string $htmlString
    )
    {
    }

    public function getString(): string
    {
        return $this->htmlString;
    }

    public static function from(string $str, EnumViewInstance $enum): self
    {
        return (match ($enum) {
            EnumViewInstance::File => self::file(...),
            EnumViewInstance::String => self::htmlString(...),
            default => fn() => throw new Exception("O caso '$enum->name' não foi mapeado!")
        })($str);
    }

    public static function htmlString(string $html): self
    {
        return new self($html);
    }

    public static function file(string $path): self
    {
        if (!file_exists($path))
            throw new Exception(htmlspecialchars("O arquivo '$path' não foi encontrado!"));
        return new self(file_get_contents($path));
    }

    public static function viewFileName(string $fileName): self
    {
        return self::file(PROJECT_PATH . "/app/Views/Htmls/$fileName.php");
    }
}