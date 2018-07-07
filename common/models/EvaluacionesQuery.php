<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Evaluaciones]].
 *
 * @see Evaluaciones
 */
class EvaluacionesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Evaluaciones[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Evaluaciones|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
