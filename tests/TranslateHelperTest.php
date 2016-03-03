<?php
namespace app\Helpers\Translate;

use TestCase;
use App\Helpers\Translate\TranslateHelper;

class TranslateHelperTest  extends TestCase {

    /**
     * @test
     */
    public function translate() {
        $testJson = '{"id":"1234","title":[{"da":""},{"en":""}],"variable":[{"id":"vari-317815ca-10f4-4f8e-b35e-4b11ffd28d70:1.0.0","label":{"da":"AMB. ALDER"},"concept":{"id":"conc-0a88b340-5da9-4b63-90d7-e53d85198be2:1.0.0","label":{"da":"Ambulante patienter."},"description":{"da":"Ambulante patienter."}},"question":{"id":"quei-f8af32ac-bd2b-45fb-8f61-5d446ca3e2a4:1.0.0","label":{"da":"Spm. 1.4: Hvor mange personer bor normalt i lejligheden/huset? (Medregnet IP)"}},"representation":"CODE","categories":[{"da":"0 til 15 år"},{"da":"16 til 30 år"},{"da":"31 til 45 år"},{"da":"46 til 60 år"},{"da":"61 til 75 år"},{"da":"Over 75 år"},{"da":"Deltager ikke"}]},{"id":"vari-846830ac-2f41-47ad-b943-10000dafc6f8:1.0.0","label":{"en":"ANTAL I FAMILIE"},"concept":{"id":"conc-f244be00-e77d-49b7-875c-6242844f0291:1.0.0","label":{"da":"Baggrundsspørgsmål, skema"},"description":{"da":"Baggrundsspørgsmål, skema 1"}},"question":{"id":"quei-53389a29-1f8c-4677-8bc5-ca6f43273f2b:1.0.0","label":{"da":"Spm. 1.5: Hvor mange af dem hører til Deres familie? (Hvis andre end IP selv) (Minus IP)"}},"representation":"CODE","categories":[{"da":"Ingen personer"},{"da":"1 person"},{"da":"2 personer"},{"da":"3 personer"},{"da":"4 personer"},{"da":"5 personer"},{"da":"6 personer"},{"da":"7 personer"}]}]}';
        $testDoc = json_decode($testJson, true);

        $app = require __DIR__.'/../bootstrap/app.php';
        $translator = $app['App\Helpers\Translate\MyMemoryTranslate'];

        $translateHelper = new TranslateHelper();
        $result = $translateHelper->translate($testDoc, $translator);

        echo json_encode($result);
    }
}