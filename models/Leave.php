<?php
/**
 * Created by PhpStorm.
 * User: HP ELITEBOOK 840 G5
 * Date: 3/9/2020
 * Time: 4:09 PM
 */

namespace frontend\models;
use common\models\User;
use Yii;
use yii\base\Model;


class Leave extends Model
{

    public $Key;
    public $Employee_No;
    public $Employee_Name;
    public $_x003C_Global_Dimension_1_Code_x003E_;
    public $Global_Dimension_2_Code;
    public $Application_No;
    public $Application_Date;
    public $User_ID;
    public $Leave_Code;
    public $Leave_Type_Decription;
    public $Start_Date;
    public $Days_To_Go_on_Leave;
    public $End_Date;
    public $Total_No_Of_Days;
    public $Leave_balance;
    public $Half_Day_on_Start_Date;
    public $Half_Day_on_End_Date;
    public $Holidays;
    public $Weekend_Days;
    public $Days;
    public $Balance_After;
    public $Return_Date;
    public $Reporting_Date;
    public $Comments;
    public $Reliever;
    public $Reliever_Name;
    public $Appointment_Date;
    public $Phone_No;
    public $E_Mail_Address;
    public $Grade;
    public $Status;
    public $Approval_Entries;
    public $Leave_Allowance;
    public $isNewRecord;

    /*public function __construct(array $config = [])
    {
        return $this->getLines($this->No);
    }*/

    public function rules()
    {
        return [
            [['Leave_Code','Start_Date','Days_To_Go_on_Leave','Reliever'], 'required'],
            ['Days_To_Go_on_Leave','integer','min'=> 1]
        ];
    }

    public function attributeLabels()
    {
        return [
            '_x003C_Global_Dimension_1_Code_x003E_' => 'Program',
            'Global_Dimension_2_Code' => 'Department',
        ];
    }



}