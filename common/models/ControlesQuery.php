<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Controles]].
 *
 * @see Controles
 */
class ControlesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Controles[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Controles|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
