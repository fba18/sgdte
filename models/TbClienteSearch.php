<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TbCliente;

/**
 * TbClienteSearch represents the model behind the search form of `app\models\TbCliente`.
 */
class TbClienteSearch extends TbCliente
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cpf_cnpj', 'nome', 'data_nascimento', 'email', 'telefone', 'cep', 'rua', 'complemento', 'bairro', 'cidade', 'uf'], 'safe'],
            [['numero'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = TbCliente::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'data_nascimento' => $this->data_nascimento,
            'numero' => $this->numero,
        ]);

        $query->andFilterWhere(['like', 'cpf_cnpj', $this->cpf_cnpj])
            ->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'telefone', $this->telefone])
            ->andFilterWhere(['like', 'cep', $this->cep])
            ->andFilterWhere(['like', 'rua', $this->rua])
            ->andFilterWhere(['like', 'complemento', $this->complemento])
            ->andFilterWhere(['like', 'bairro', $this->bairro])
            ->andFilterWhere(['like', 'cidade', $this->cidade])
            ->andFilterWhere(['like', 'uf', $this->uf]);

        return $dataProvider;
    }
}
