<?php

namespace App\Http\Controllers\Calc;

use App\Http\Controllers\Controller;

class Electre extends Controller
{
    private $data;
    private $weights;

    public $criteria;
    public $euclideanDistances;
    public $normalizedMatrix;
    public $weightedMatrix;
    public $concordanceMatrix;
    public $discordanceMatrix;
    public $mConcordanceMatrix;
    public $mDiscordanceMatrix;
    public $tConcordance;
    public $tDiscordance;
    public $mdConcordanceMatrix;
    public $mdDiscordanceMatrix;
    public $aggregatedMatrix;
    public $total;

    function __construct($data, $weights){
        $this->data = $data;
        $this->weights = $weights;

        $this->calculateEuclideanDistances();
        $this->normalizeMatrix();
        $this->calculateWeightedMatrix();
        $this->calculateConcordanceMatrix();
        $this->calculateDiscordanceMatrix();
        $this->calculateMConcordanceMatrix();
        $this->calculateMDiscordanceMatrix();

        $this->tConcordance = $this->calculateThreshold($this->mConcordanceMatrix);
        $this->tDiscordance = $this->calculateThreshold($this->mDiscordanceMatrix);

        $this->calculateMDConcordanceMatrix();
        $this->calculateMDDiscordanceMatrix();
        $this->calculateAggregatedMatrix();
        $this->calculateTotal();
    }

    /**
     * Calculate the Euclidean distance for each criteria in the data.
     *
     * @return void
     */
    function calculateEuclideanDistances(){
        $arr = array();
        foreach($this->data as $alternatives){
            foreach($alternatives as $criteriaCode => $score){
                $arr[$criteriaCode] += ($score * $score);
            }
        }
        foreach($arr as $criteriaCode => $score2){
            $this->criteria[$criteriaCode] = $criteriaCode;
            $this->euclideanDistances[$criteriaCode] = sqrt($score2);
        }
    }

    /**
     * Calculate the normalized matrix based on the data and distance matrix.
     *
     * @return void
     */
    function normalizeMatrix(){
        foreach($this->data as $alternative => $criteria){
            foreach($criteria as $criteriaCode => $score){
                $this->normalizedMatrix[$alternative][$criteriaCode] = $score / $this->euclideanDistances[$criteriaCode];
            }
        }
    }

    /**
     * Calculate the weighted score for each alternative and criteria.
     *
     * @return void
     */
    function calculateWeightedMatrix(){
        foreach($this->normalizedMatrix as $alternative => $criteria){
            foreach($criteria as $criteriaCode => $score){
                $this->weightedMatrix[$alternative][$criteriaCode] = $score * $this->weights[$criteriaCode];
            }
        }
    }

    /**
     * Calculate concordance index for each alternative
     *
     * @return void
     */
    function calculateConcordanceMatrix(){
        foreach($this->normalizedMatrix as $alternative => $criteria){
            foreach($this->normalizedMatrix as $_alternative => $_criteria){
                $this->concordanceMatrix[$alternative][$_alternative] = array();
                // Compare the weighted data
                foreach($this->criteria as $criteriaCode){
                    if($criteria[$criteriaCode] >= $_criteria[$criteriaCode])
                        $this->concordanceMatrix[$alternative][$_alternative][] = $criteriaCode;
                }
            }
        }
    }

    /**
     * Calculate discordance matrix based on the weighted data of alternatives and criteria.
     *
     * @return void
     */
    function calculateDiscordanceMatrix(){
        foreach($this->normalizedMatrix as $alternative => $criteria){
            foreach($this->normalizedMatrix as $_alternative => $_criteria){
                $this->discordanceMatrix[$alternative][$_alternative] = array();
                // Compare the weighted data
                foreach($this->criteria as $criteriaCode){
                    if($criteria[$criteriaCode] < $_criteria[$criteriaCode])
                        $this->discordanceMatrix[$alternative][$_alternative][] = $criteriaCode;
                }
            }
        }
    }

    /**
     * Calculate the concordance matrix based on the comparison matrix and criteria weights.
     *
     * @return void
     */
    function calculateMConcordanceMatrix(){
        foreach($this->concordanceMatrix as $alternative => $comparedAlternatives){
            foreach($comparedAlternatives as $comparedAlternative => $concordanceList){
                $this->mConcordanceMatrix[$alternative][$comparedAlternative] = 0;

                foreach($concordanceList as $criteriaCode){
                    $this->mConcordanceMatrix[$alternative][$comparedAlternative] += $this->weights[$criteriaCode];
                }
            }
        }
    }

    /**
     * Calculate the discordance matrix for the Electre method.
     *
     * @return void
     */
    function calculateMDiscordanceMatrix(){
        $arr = array();
        $arr2 = array();
        foreach($this->weightedMatrix as $alternative => $criteria){
            foreach($this->weightedMatrix as $_alternative => $_criteria){
                $arr[$alternative][$_alternative] = array();
                $arr2[$alternative][$_alternative] = array();
                foreach($this->criteria as $a => $b){
                    $selisih = abs($criteria[$a] - $_criteria[$a]);

                    if($criteria[$a] < $_criteria[$a])
                        $arr[$alternative][$_alternative][] = $selisih;

                    $arr2[$alternative][$_alternative][] = $selisih;
                }
            }
        }
        foreach($arr as $alternative => $comparedAlternative){
            foreach($comparedAlternative as $key => $selisih){
                $this->mDiscordanceMatrix[$alternative][$key] = !$selisih ? 0 : max($selisih) / max($arr2[$alternative][$key]);
            }
        }
    }

    /**
     * Calculate the threshold value of a given matrix.
     *
     * @param array $matrix The matrix to calculate the threshold value for.
     *
     * @return float The threshold value of the matrix.
     */
    function calculateThreshold($matrix){
        $pembilang = 0;
        $count = count($matrix);
        foreach($matrix as $key => $val){
            foreach($val as $k => $v){
                if($key!=$k){
                    $pembilang+=$v;
                }
            }
        }
        return $pembilang / ($count * ($count - 1));
    }

    /**
     * Calculate the dominant concordance data.
     *
     * @return void
     */
    function calculateMDConcordanceMatrix(){
        foreach($this->mConcordanceMatrix as $alternative => $comparedAlternatives){
            foreach($comparedAlternatives as $alternativeCode => $score){
                $this->mdConcordanceMatrix[$alternative][$alternativeCode] = $score >= $this->tConcordance ? 1 : 0;
            }
        }
    }

    /**
     * Calculate the dominant discordance data.
     *
     * @return void
     */
    function calculateMDDiscordanceMatrix(){
        foreach($this->mDiscordanceMatrix as $alternative => $comparedAlternatives){
            foreach($comparedAlternatives as $alternativeCode => $score){
                $this->mdDiscordanceMatrix[$alternative][$alternativeCode] = $score >= $this->tDiscordance ? 1 : 0;
            }
        }
    }

    /**
     * Calculates the aggregate values for each alternative and criterion pair
     *
     * @return void
     */
    function calculateAggregatedMatrix(){
        foreach($this->mdConcordanceMatrix as $key => $val){
            foreach($val as $k => $v){
                $this->aggregatedMatrix[$key][$k] = $v * $this->mdDiscordanceMatrix[$key][$k];
            }
        }
    }

    /** 
     * Calculates the total for each key in the $aggregatedMatrix array and stores the result in the $total array.
     *
     * @return void
     */
    function calculateTotal(){
        foreach($this->aggregatedMatrix as $key => $val){
            $this->total[$key] = array_sum($val);
        }
    }

}
