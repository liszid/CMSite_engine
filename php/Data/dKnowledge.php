<?php

declare(strict_types=1);

namespace Data;

use Database\dbKnowledge;

use Toolkit\{
    Log
    ,Check
    ,Valid
};

class dKnowledge implements iData
{
    private static $dbKnowledge;
    private static $dKnowledge_File;

    public function __construct()
    {
        self::$dbKnowledge = new dbKnowledge();
        self::$dKnowledge_File = new dKnowledge_File();
    }

    public static function Insert(array $array = array()): bool
    {
        return self::$dbKnowledge->Insert($array);
    }

    public static function Select(array $array = array(), string $type = ''): array
    {
        return self::$dbKnowledge->Select($array, $type);
    }

    public static function Update(array $array = array(), string $type = ''): bool
    {
        return self::$dbKnowledge->Update($array, $type);
    }

    public static function Delete(array $array = array(), string $type = ''): bool
    {
        foreach ((self::$dKnowledge_File->Select($array,'byKnowledgeId')) as $item) {
            if (file_exists('/app'.$item['knowledgeFilePath'])) {
                unlink('/app'.$item['knowledgeFilePath']);
            }
        }

        return self::$dbKnowledge->Delete($array, $type);
    }

    public static function Check( ): bool
    {
        return (self::$dbKnowledge->Check());
    }

    public static function Class_Id(): int
    {
        return self::$dbKnowledge->Class_Id();
    }
}
