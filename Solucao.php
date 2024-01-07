<?php

class Solucao
{
    public function melhorPar(array $duracaoComerciais, int $intervalo): array
    {
        $resultado = [];
        $intervalo -= 1;
        $somaMaxima = PHP_INT_MIN;

        foreach ($duracaoComerciais as $i => $tempo1) {
            if ($tempo1 > $intervalo)
                continue;

            foreach (array_slice($duracaoComerciais, $i + 1) as $j => $tempo2) {
                if ($tempo2 > $intervalo)
                    continue;

                $somaAtual = $tempo1 + $tempo2;

                if ($somaAtual === $intervalo) {
                    return [$i, $i + 1 + $j];
                } elseif ($somaAtual > $somaMaxima && $somaAtual <= $intervalo) {
                    $somaMaxima = $somaAtual;
                    $resultado = [$i, $i + 1 + $j];
                }
            }
        }

        return $resultado;
    }

    public function fundirSegmentos(array $segmentos): array
    {
        $resultado = [];

        if (empty($segmentos))
            return $resultado;

        usort($segmentos, function ($i, $j) {
            return $i[0] - $j[0];
        });

        $segmentoAtual = $segmentos[0];

        foreach ($segmentos as $segmento) {
            if ($segmento[0] <= $segmentoAtual[1]) {
                $segmentoAtual[1] = max($segmentoAtual[1], $segmento[1]);
            } else {
                $resultado[] = $segmentoAtual;
                $segmentoAtual = $segmento;
            }
        }

        $resultado[] = $segmentoAtual;

        return $resultado;
    }

}