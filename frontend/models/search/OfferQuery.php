<?php

namespace frontend\models\search;

/**
 * This is the ActiveQuery class for [[\frontend\models\Offer]].
 *
 * @see \frontend\models\Offer
 */
class OfferQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \frontend\models\Offer[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \frontend\models\Offer|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
