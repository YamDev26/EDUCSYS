<?php

namespace App\Listeners;

use App\Models\Verify;
use App\Models\Section;
use App\Models\Payement;
use App\Events\GetActifSectionEvent;

class GetActifSection
{
    public function handle(GetActifSectionEvent $event): void
    {
        $this->updatepaiement($event->today);
        $section = Section::where('school_year_id', $event->year)->where('status', '!=', '2')->get();
        count($section) ? $this->updateSection($section, $event->today):null;
        $this->updateVerify($event->today);
    }


    private function updateSection($sections, $today){
        foreach($sections as $section){
            $state = compareToDate($today, $section['debut'], $section['fin']);
            if($section['status'] != $state){
               Section::where('id', $section['id'])->update([
                'status' => $state
               ]);

               Payement::where('section_id', $section['id'])->update([
                'status' => $state
               ]);
            }
        }
    }


    private function updatepaiement($today){
        Payement::where('section_id', null)->where('fin', '<', $today)->where('status', '1')->update([
            'status' => '2'
        ]);

        Payement::where('section_id', null)->where('debut', '<=', $today)->where('status', '0')->update([
            'status' => '1'
        ]);
    }


    private function updateVerify($today){
        $exist = Verify::where('date', $today)->first(); 
        $exist ?
        $exist->update(['date' => $today]):
        Verify::create(['date' => $today]);
    }
}
