<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Sedes]].
 *
 * @see Sedes
 */
class SedesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Sedes[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Sedes|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
