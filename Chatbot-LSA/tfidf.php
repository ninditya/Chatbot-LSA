<?php
// require 'vendor/autoload.php';
class tfidf
{
    public function proses($data1, $data2)
    {
        //Output_txt - Hasil Preprocessing
        $this->original_data  = $data2;
        //Input_txt - Hasil Data Base
        $this->dokumen=array_filter(explode("?"|"!"|".", $data1), function ($value) {
            return $value !== '';
        });
        $this->pembobotan_kata();
        $this->pembobotan_kalimat();
    }

    public function pembobotan_kalimat()
    {
        $bobot_dokumen=array();
        $y=0;
        foreach ($this->dokumen as $key1) {
            $bobot_dokumen[$y]=array();
            foreach ($this->table1 as $key2) {
                //   echo $key2['dok'][$y] ;
                if ($key2['dok'][$y]>0) {
                    array_push($bobot_dokumen[$y], $key2['dok'][$y]*$key2['idf']);
                } else {
                    array_push($bobot_dokumen[$y], 0);
                }
            }
            //$bobot_dokumen[$y]['jml']=round(array_sum($bobot_dokumen[$y]['a']), 3);
            ++$y;
        }
        $this->table2=$bobot_dokumen;
    }
    public function pembobotan_kata()
    {
        $l=0;       
        $table1=array();
        $search=array();
        foreach ($this->original_data as $key) {
            if (array_search(trim(strtolower($key)), $search)===false) {
                $dok=0;
                $table1[$l]['term']=trim(strtolower($key));
                $table1[$l]['dok']=array();

                foreach ($this->dokumen as $key1) {
                    array_push($table1[$l]['dok'], substr_count(trim(strtolower($key1)), trim(strtolower($key))));
                    ++$dok;
                }

                $table1[$l]['df']=array_sum($table1[$l]['dok']);
                $table1[$l]['Ddf']=count($table1[$l]['dok'])/$table1[$l]['df'];
                $table1[$l]['idf']=round(log10($table1[$l]['Ddf']), 3);
                //$table1[$l]['idf1']= round($table1[$l]['idf']+1, 3);
                // $table1[$l]['idf1']= round($table1[$l]['idf'], 3);
                ++$l;
            }
            array_push($search, trim(strtolower($key)));
        }
        $this->table1=$table1;
    }

    // public function query() {
    // $p=0;
    // foreach ($table1 as $kunci) {
    //     $query[$p]= $kunci['term'];
    // ++$p;
    // }
    // }    
    
    // public function query()
    // {
    //     $l=0;       
    //     $query=array();
    //     $search=array();
    //     foreach ($this->original_data as $key) {
    //         if (array_search(trim(strtolower($key)), $search)===false) {
    //             $dok=0;
    //             $query[$l]['term']=trim(strtolower($key));
    //             $query[$l]['dok']=array();

    //             foreach ($this->query as $key1) {
    //                 array_push($query[$l]['dok'], substr_count(trim(strtolower($key1)), trim(strtolower($key))));
    //                 ++$dok;
    //             }
    //             ++$l;
    //         }
    //         array_push($search, trim(strtolower($key)));
    //     }
    //     $this->table1=$table1;
    // }

}
