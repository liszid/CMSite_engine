<?php

declare(strict_types=1);

namespace Queries;

use Toolkit\
{
    Log
    ,Check
    ,Valid
};

class qKnowledge
{
    public static function Get(): array
    {
        return array(
            'Insert' => self::Insert()
            ,'Select' => self::Select()
            ,'Update' => self::Update()
            ,'Delete' => self::Delete()
        );
    }

    private static function Insert()
    {
        return "
            INSERT INTO `Knowledge`(
                knowledgeTitle
                ,knowledgeTypeId
                ,knowledgeText
                ,knowledgeLabel
                ,userId
                ,companyId
            ) VALUES (
                :knowledgeTitle/**/
                ,:knowledgeTypeId/**/
                ,:knowledgeText/**/
                ,:knowledgeLabel/**/
                ,:userId/**/
                ,:companyId/**/
            );
        ";
    }

    private static function Select()
    {
        return array(
            'All' => "
                SELECT
                    *
                FROM `Knowledge`"
            ,'byKnowledgeId' => "
                SELECT
                    `Knowledge`.*
                    ,`User`.userName
                FROM `Knowledge`
                INNER JOIN `User` USING (userId)
                WHERE knowledgeId=:knowledgeId/**/"
            ,'byUserId' => "
                SELECT
                    userId
                FROM `Knowledge`
                WHERE userId=:userId/**/"
            ,'lastInsert' => "
                SELECT
                    knowledgeId
                FROM `Knowledge`
                WHERE userId=:userId/**/
                ORDER BY knowledgeId DESC
                LIMIT 1"
        );
    }

    private static function Update()
    {
        return "
            UPDATE
                `Knowledge`
            SET
                knowledgeTypeId=:knowledgeTypeId/**/
                ,knowledgeTitle=:knowledgeTitle/**/
                ,knowledgeText=:knowledgeText/**/
                ,knowledgeLabel=:knowledgeLabel/**/
                ,companyId=:companyId/**/
            WHERE
                knowledgeId=:knowledgeId/**/
            ";
    }

    private static function Delete()
    {
        return "DELETE FROM `Knowledge` WHERE knowledgeId=:knowledgeId/**/";
    }
}