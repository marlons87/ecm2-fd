<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Niveles]].
 *
 * @see Niveles
 */
class NivelesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Niveles[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Niveles|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
