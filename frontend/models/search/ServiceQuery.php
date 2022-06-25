<?php

namespace frontend\models\search;

/**
 * This is the ActiveQuery class for [[\frontend\models\Service]].
 *
 * @see \frontend\models\Service
 */
class ServiceQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \frontend\models\Service[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \frontend\models\Service|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
