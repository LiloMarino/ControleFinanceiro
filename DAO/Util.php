<?php

class Util
{
    
    public static function codigoLogado(): int
    {
        return 1;
    }

    /**
     * Verifica se as variáveis estão vazias usando trim()
     * @param array $vars Variáveis para verificar se estão vazias
     * @return bool Retorna verdadeiro se estiver vazia e falso caso contrário
     */
    public static function isEmpty(...$vars): bool
    {
        foreach ($vars as $var) {
            if (trim($var) == '') {
                return true;
            }
        }
        return false;
    }
}
