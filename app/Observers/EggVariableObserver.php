<?php

namespace sneakypanel\Observers;

use sneakypanel\Models\EggVariable;

class EggVariableObserver
{
    public function creating(EggVariable $variable): void
    {
        if ($variable->field_type) {
            unset($variable->field_type);
        }
    }

    public function updating(EggVariable $variable): void
    {
        if ($variable->field_type) {
            unset($variable->field_type);
        }
    }
}
