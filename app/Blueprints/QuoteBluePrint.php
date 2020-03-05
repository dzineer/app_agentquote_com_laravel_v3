<?php

namespace App\Blueprints;

class QuoteBluePrint {


    private $obj;

    private $fields = [
        'affiliate_id',
        'user_id',
        'age',
        'age_or_date',
        'state',
        'month',
        'day',
        'year',
        'gender',
        'term',
        'tobacco',
        'benefit',
        'period',
        'category'
    ];

    private $data = [];

    private $affiliate_id;
    private $user_id;
    private $age;
    private $age_or_date;
    private $state;
    private $month;
    private $day;
    private $year;
    private $gender;
    private $term;
    private $tobacco;
    private $benefit;
    private $period;
    private $category;

    /**
     * QuoteBluePrint constructor.
     *
     * @param $affiliate_id
     * @param $user_id
     * @param $age
     * @param $age_or_date
     * @param $state
     * @param $month
     * @param $day
     * @param $year
     * @param $gender
     * @param $term
     * @param $tobacco
     * @param $benefit
     * @param $period
     * @param $category
     */

    public function __construct(
        $affiliate_id,
        $user_id,
        $age,
        $age_or_date,
        $state,
        $month,
        $day,
        $year,
        $gender,
        $term,
        $tobacco,
        $benefit,
        $period,
        $category) {

        $this->affiliate_id = $affiliate_id;
        $this->user_id = $user_id;
        $this->age = $age;
        $this->age_or_date = $age_or_date;
        $this->state = $state;
        $this->month = $month;
        $this->day = $day;
        $this->year = $year;
        $this->gender = $gender;
        $this->term = $term;
        $this->tobacco = $tobacco;
        $this->benefit = $benefit;
        $this->period = $period;
        $this->category = $category;

        $this->data = [];

        $this->data['affiliate_id'] = $affiliate_id;
        $this->data['user_id'] = $user_id;
        $this->data['age'] = $age;
        $this->data['age_or_date'] = $age_or_date;
        $this->data['state'] = $state;
        $this->data['month'] = $month;
        $this->data['day'] = $day;
        $this->data['year'] = $year;
        $this->data['gender'] = $gender;
        $this->data['term'] = $term;
        $this->data['tobacco'] = $tobacco;
        $this->data['benefit'] = $benefit;
        $this->data['period'] = $period;
        $this->data['category'] = $category;
    }

	/**
     * @return \stdClass
     */
	public function build() {
        $this->obj = new \stdClass();
        foreach($this->fields as $field) {
            $this->obj->$field = $this->$field;
        }
        return $this->obj;
    }

    public function toArray() {
	   // dump($this->data);
        return $this->data;
    }
}