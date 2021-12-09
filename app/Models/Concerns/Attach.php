<?php

namespace App\Models\Concerns;

trait Attach {

    public function AttactCompliancesIfNotExists($id, $values) {
        if ($this->allCompliances->contains($id)) {
            if(($this->singleCompliance($id)->check_type != $values['check_type']) || ($this->singleCompliance($id)->deleted_at != null)){
            $values['deleted_at'] = null;
            $this->compliance()->updateExistingPivot($id, $values);
            }
            return;
        }
        $this->compliance()->attach($id, $values);
    }

}
