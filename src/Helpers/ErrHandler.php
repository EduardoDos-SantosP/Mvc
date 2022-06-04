<?php

namespace Edsp\Mvc\Helpers;

use Edsp\Mvc\ExpandedObject;
use Throwable;

class ErrHandler extends ExpandedObject
{
    public static function renderHtml(Throwable $e): void
    {
        echo "<div class='container shadow'>" . self::getHtmlFrom($e) . "</div>";
    }

    private static function getHtmlFrom(Throwable $e): string
    {
        return "
        <div class='ms-5'>
            <h5>" . $e->getMessage() . "</h5>
            <details class='ms-1'>
                <summary>Pilha de rastros:</summary>
                <div class='ms-5'>" .
                collect($e->getTrace())->map(
                    fn($item) =>
                    "<div class='mb-2'>
                        <p class='mb-0'><b>Arquivo:</b> $item[file]</p>
                        <p class='mb-0'><b>Linha:</b> $item[line]</p>
                        <p class='mb-0'><b>Função:</b> $item[function]</p>
                    </div>"
                )->join('') . "
                </div>
            </details>" .
            (!$e->getPrevious() ? '' : "
            <details open class='ms-1'>
                <summary>Outros erros:</summary>" .
                self::getHtmlFrom($e->getPrevious()) . "
            </details>") . "            
        </div>";
    }
}