<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Patient;

/**
 * Class PatientTransformer.
 *
 * @package namespace App\Transformers;
 */
class PatientTransformer extends TransformerAbstract
{
    /**
     * Transform the Patient entity.
     *
     * @param \App\Entities\Patient $model
     *
     * @return array
     */
    public function transform(Patient $model)
    {
        return [
            'id'         => (int) $model->id,
            'full_name'       => $model->full_name,
            'full_name_mom'       => $model->full_name_mom,
            'cpf'       => $model->cpf,
            'cns'       => $model->cns,
            'date_of_birth'       => $model->date_of_birth,
            'created_at' => $model->created_at->toDateTimeString(),
            'updated_at' => $model->updated_at->toDateTimeString()
        ];
    }
}
