<?php

declare(strict_types=1);

namespace LCPHP\Utils;

class Printer
{
    private static function valorATexto(mixed $valor): string
    {
        return match (true) {
            is_null($valor) => 'null',
            is_bool($valor) => $valor ? 'true' : 'false',
            is_array($valor) => json_encode($valor, JSON_UNESCAPED_UNICODE),
            is_object($valor) => get_class($valor),
            default => (string) $valor,
        };
    }

    public static function imprimirMatriz(array $matriz, string $titulo = ''): void
    {
        if ($titulo !== '') {
            echo $titulo . PHP_EOL;
        }

        if (empty($matriz)) {
            echo '[ matriz vacía ]' . PHP_EOL;
            return;
        }

        // Calcular el ancho máximo de cada columna
        $anchos = [];
        foreach ($matriz as $fila) {
            foreach (array_values((array) $fila) as $j => $valor) {
                $texto = self::valorATexto($valor);
                $anchos[$j] = max($anchos[$j] ?? 0, mb_strlen($texto));
            }
        }

        // Línea separadora tipo +-----+-----+
        $separador = '+';
        foreach ($anchos as $ancho) {
            $separador .= str_repeat('-', $ancho + 2) . '+';
        }

        echo $separador . PHP_EOL;
        foreach ($matriz as $fila) {
            $fila = array_values((array) $fila);
            $linea = '|';
            foreach ($anchos as $j => $ancho) {
                $texto = isset($fila[$j]) ? self::valorATexto($fila[$j]) : '';
                $relleno = $ancho - mb_strlen($texto);
                // Números a la derecha, texto a la izquierda
                $linea .= isset($fila[$j]) && is_numeric($fila[$j])
                    ? ' ' . str_repeat(' ', $relleno) . $texto . ' |'
                    : ' ' . $texto . str_repeat(' ', $relleno) . ' |';
            }
            echo $linea . PHP_EOL;
        }
        echo $separador . PHP_EOL;
    }

    static function imprimirDiccionario(array $dic, int $nivel = 0): void
    {
        if (empty($dic)) {
            echo str_repeat('    ', $nivel) . '{ vacío }' . PHP_EOL;
            return;
        }

        $sangria = str_repeat('    ', $nivel);
        $anchoClave = max(array_map(fn($k) => mb_strlen((string) $k), array_keys($dic)));

        foreach ($dic as $clave => $valor) {
            $claveTexto = str_pad(
                (string) $clave,
                $anchoClave + (strlen((string) $clave) - mb_strlen((string) $clave)),
            );

            if (is_array($valor)) {
                echo $sangria . $claveTexto . ' :' . PHP_EOL;
                self::imprimirDiccionario($valor, $nivel + 1);
            } else {
                echo $sangria . $claveTexto . ' : ' . self::valorATexto($valor) . PHP_EOL;
            }
        }
    }

    public static function clear()
    {
        echo "\033[2J\033[;H";
    }

    public static function pressToContinue()
    {
        echo "\n ================================ \n";
        echo 'Press Enter to continue...';
        fgets(STDIN);
    }
}
