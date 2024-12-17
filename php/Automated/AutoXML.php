<?php
declare(strict_types=1);
namespace Automated;

class AutoXML {
    
    public function __construct() {
        $xmlRead = '';
        $dirPath='../Import/';
        $array2Import = scandir($dirPath);
        foreach($array2Import as $file) {
            $filePath = $dirPath . '/' . $file;
            if (is_file($filePath)) {
                $xmlRead = file_get_contents($filePath);
                
            }
        }
    }
    
    public function parse($xml) {
        $xmlObject = simplexml_load_string($xml);
        return $this->convertToArray($xmlObject);
    }
    
    private function convertToArray($xmlObject) {
        $array = [];

        foreach ($xmlObject as $key => $value) {
            if ($value->count() > 0) {
                $array[$key] = $this->convertToArray($value);
            } else {
                $array[$key] = (string) $value;
            }
        }

        return $array;
    }

    public function transform($array) {
        $result = [];
        $result['Symmetrix'] = [
            'Symm_Info' => $array['Symmetrix']['Symm_Info'],
            'SRP' => []
        ];

        foreach ($array['Symmetrix']['SRP'] as $srp) {
            $srpInfo = $srp['SRP_Info'];
            $srpArray = [
                'name' => $srpInfo['name'],
                'physical_capacity_gigabytes' => $srpInfo['physical_capacity_gigabytes'],
                'usable_capacity_gigabytes' => $srpInfo['usable_capacity_gigabytes'],
                'compression_state' => $srpInfo['compression_state'],
                'compression_ratio' => $srpInfo['compression_ratio'],
                'data_reduction_ratio' => $srpInfo['data_reduction_ratio'],
                'srdf_dse_allocated_gigabytes' => $srpInfo['srdf_dse_allocated_gigabytes'],
                'snapshot_effective_capacity_gigabytes' => $srpInfo['snapshot_effective_capacity_gigabytes'],
                'snapshots_allocated_gigabytes' => $srpInfo['snapshots_allocated_gigabytes'],
                'total_subscribed_pct' => $srpInfo['total_subscribed_pct'],
                'input_date' => $srpInfo['input_date'],
                'SG_Info' => [],
                'Total_SG' => $srpInfo['Total_SG']
            ];

            foreach ($srpInfo['SG_Info'] as $sg) {
                $srpArray['SG_Info'][] = $sg;
            }

            $result['Symmetrix']['SRP'][] = $srpArray;
        }

        return $result;
    }
}

// Használat
$xml = '...'; // Az XML tartalma
$xmlToArray = new XMLToArray();
$array = $xmlToArray->parse($xml);
$transformedArray = $xmlToArray->transform($array);