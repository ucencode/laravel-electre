<?php

namespace App\Http\Controllers\Calc;

use App\Http\Controllers\Controller;

class Electre extends Controller
{
    private $data;
	private $bobot;

	public $kriteria;
	public $x_jarak;
	public $normal;
	public $terbobot;
	public $concordance;
	public $discordance;
	public $m_concordance;
	public $m_discordance;
	public $t_concordance;
	public $t_discordance;
	public $md_concordance;
	public $md_discordance;
	public $agregate;
	public $total;

	function __construct($data, $bobot){
		// $debug = true;
		// if($debug)
		// 	echo "<pre>";
		$this->data = $data;
		$this->bobot = $bobot;

		$this->x_jarak();
		$this->normal();
		$this->terbobot();
		$this->concordance();
		$this->discordance();
		$this->m_concordance();
		$this->m_discordance();

		$this->t_concordance = $this->treshold($this->m_concordance);
		$this->t_discordance = $this->treshold($this->m_discordance);
		$this->md_concordance();
		$this->md_discordance();
		$this->agregate();
		$this->total();
		// if($debug) {
		// 	print_r($this);die;
		// }
	}

    /**
     * Calculate the Euclidean distance for each criteria.
     *
     * @return void
     */
    function x_jarak(){
		$arr = array();
		foreach($this->data as $criterias){
			foreach($criterias as $crit_code => $score){
				$arr[$crit_code] += ($score * $score);
			}
		}
		foreach($arr as $crit_code => $score2){
			$this->kriteria[$crit_code] = $crit_code;
			$this->x_jarak[$crit_code] = sqrt($score2);
		}
	}

    /**
     * Calculate the normalized data by dividing the data with the Euclidean distance.
     *
     * @return void
     */
    function normal(){
		foreach($this->data as $alt => $criterias){
			foreach($criterias as $crit_code => $score){
				$this->normal[$alt][$crit_code] = $score / $this->x_jarak[$crit_code];
			}
		}
	}

    /**
     * Calculate the weighted data by multiplying the normalized data with the weight.
     *
     * @return void
     */
    function terbobot(){
		foreach($this->normal as $alt => $criterias){
			foreach($criterias as $crit_code => $score){
				$this->terbobot[$alt][$crit_code] = $score * $this->bobot[$crit_code];
			}
		}
	}

    /**
     * Calculate the concordance data by comparing the normalized weighted data.
     *
     * @return void
     */
    function concordance(){
		foreach($this->normal as $alt => $criterias){
			foreach($this->normal as $_alt => $_criterias){
				$this->concordance[$alt][$_alt] = array();
                // Compare the weighted data
				foreach($this->kriteria as $crit_code){
					if($criterias[$crit_code] >= $_criterias[$crit_code])
						$this->concordance[$alt][$_alt][] = $crit_code;
				}
			}
		}
	}

    /**
     * Calculate the discordance data by comparing the normalized weighted data.
     *
     * @return void
     */
	function discordance(){
		foreach($this->normal as $alt => $criterias){
            foreach($this->normal as $_alt => $_criterias){
                $this->discordance[$alt][$_alt] = array();
                // Compare the weighted data
                foreach($this->kriteria as $crit_code){
                    if($criterias[$crit_code] < $_criterias[$crit_code])
                        $this->discordance[$alt][$_alt][] = $crit_code;
                }
            }
        }
	}

    /**
     * Calculate the concordance data.
     *
     * @return void
     */
	function m_concordance(){
		foreach($this->concordance as $alt => $alt_compares){
			foreach($alt_compares as $compared_alt => $concordanced_list){
				$this->m_concordance[$alt][$compared_alt] = 0;

				foreach($concordanced_list as $criteria_code){
					$this->m_concordance[$alt][$compared_alt]+=$this->bobot[$criteria_code];
				}
			}
		}
	}

    function m_discordance(){
		$arr = array();
		$arr2 = array();
		foreach($this->terbobot as $key => $val){
			foreach($this->terbobot as $k => $v){
				$arr[$key][$k] = array();
				$arr2[$key][$k] = array();
				foreach($this->kriteria as $a => $b){
					$selisih = abs($val[$a] - $v[$a]);

					if($val[$a] < $v[$a])
						$arr[$key][$k][] = $selisih;

					$arr2[$key][$k][] = $selisih;
				}
			}
		}
		foreach($arr as $key => $val){
			foreach($val as $k => $v){
				$this->m_discordance[$key][$k] = !$v ? 0 : max($v) / max($arr2[$key][$k]);
			}
		}
	}

    function treshold($matriks){
		$pembilang = 0;
		$count = count($matriks);
		foreach($matriks as $key => $val){
			foreach($val as $k => $v){
				if($key!=$k){
					$pembilang+=$v;
				}
			}
		}
		return $pembilang / ($count * ($count - 1));
	}

    function md_concordance(){
		foreach($this->m_concordance as $key => $val){
			foreach($val as $k => $v){
				$this->md_concordance[$key][$k] = $v >= $this->t_concordance ? 1 : 0;
			}
		}
	}

    function md_discordance(){
		foreach($this->m_discordance as $key => $val){
			foreach($val as $k => $v){
				$this->md_discordance[$key][$k] = $v >= $this->t_discordance ? 1 : 0;
			}
		}
	}

    function agregate(){
		foreach($this->md_concordance as $key => $val){
			foreach($val as $k => $v){
				$this->agregate[$key][$k] = $v * $this->md_discordance[$key][$k];
			}
		}
	}

	function total(){
		foreach($this->agregate as $key => $val){
			$this->total[$key] = array_sum($val);
		}
	}

}
