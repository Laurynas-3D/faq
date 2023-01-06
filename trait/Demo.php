<?php

trait Demo
{
    public function demoData(): void
    {
        $questions = array(
            array(
                'q' => 'Kokio dydžio yra visata?',
                'a' => 'Manoma, kad stebimos visatos skersmuo yra apie 93 milijardai šviesmečių, joje yra daugiau nei 
                100 milijardų galaktikų. Tačiau tikrasis Visatos dydis nežinomas ir gali būti begalinis.',
            ),
            array(
                'q' => 'Ar tiesa, kad mes naudojame tik 10% savo smegenų?',
                'a' => 'Nėra jokių mokslinių įrodymų, patvirtinančių mintį, kad mes naudojame tik 10% savo smegenų. 
                Tiesą sakant, smegenų skenavimas parodė, kad visos smegenys yra aktyvios ir atlieka įvairias funkcijas, 
                net kai mes ilsimės.'
            ),
            array(
                'q' => 'Kodėl seni troleibusai turi tris pedalus, o nauji – tik du?',
                'a' => 'Troleibusai, kaip ir beveik visos kitos elektrinės transporto priemonės, neturi pavarų dėžių. 
                Tai kam jiems trys pedalai? Du iš jų yra stabdžiai – vienas stabdo elektriniu varikliu ir yra naudojamas 
                norint prilėtinti, o kitas stabdo būgnais, kaip įprastame autobuse. Šiuolaikiniuose troleibusuose abi 
                šios stabdymo funkcijos yra sudėtos į vieną pedalą ir veikia priklausomai nuo to, kaip stipriai 
                vairuotojas pedalą spaudžia.'
            ),
        );

        foreach ($questions as $qa) {
            $qaObj = new LfaqQuestion();
            $qaObj->question = $qa['q'];
            $qaObj->answer = $qa['a'];
            $qaObj->active = true;

            $qaObj->save();
        }
    }
}
